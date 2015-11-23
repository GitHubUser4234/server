#!/usr/bin/env bash
#
# ownCloud
#
# This script start a docker container to test the files_external tests
# against. It will also change the files_external config to use the docker
# container as testing environment. This is reverted in the stop step.
#
# If the environment variable RUN_DOCKER_MYSQL is set the ownCloud will
# be set up using MySQL instead of SQLite.
#
# Set environment variable DEBUG to print config file
#
# @author Morris Jobke
# @copyright 2014 Morris Jobke <hey@morrisjobke.de>
#

if ! command -v docker >/dev/null 2>&1; then
    echo "No docker executable found - skipped docker setup"
    exit 0;
fi

echo "Docker executable found - setup docker"

echo "Fetch recent morrisjobke/owncloud docker image"
docker pull morrisjobke/owncloud

# retrieve current folder to place the config in the parent folder
thisFolder=`echo $0 | sed 's#env/start-webdav-ownCloud\.sh##'`

if [ -z "$thisFolder" ]; then
    thisFolder="."
fi;

if [ -n "$RUN_DOCKER_MYSQL" ]; then
    echo "Fetch recent mysql docker image"
    docker pull mysql

    echo "Setup MySQL ..."
    # user/password will be read by ENV variables in owncloud container (they are generated by docker)
    databaseContainer=`docker run -e MYSQL_ROOT_PASSWORD=mysupersecretpassword -d mysql`
    containerName=`docker inspect $databaseContainer | grep Name | grep _ | cut -d \" -f 4 | cut -d / -f 2`

    parameter="--link $containerName:db"
fi

container=`docker run -P $parameter -d -e ADMINLOGIN=test -e ADMINPWD=test morrisjobke/owncloud`

host=`docker inspect $container | grep IPAddress | cut -d '"' -f 4`

echo -n "Waiting for ownCloud initialization"
starttime=$(date +%s)
# support for GNU netcat and BSD netcat
while ! (nc -c -w 1 ${host} 80 </dev/null >&/dev/null \
    || nc -w 1 ${host} 80 </dev/null >&/dev/null); do
    sleep 1
    echo -n '.'
    if (( $(date +%s) > starttime + 60 )); then
	echo
	echo "[ERROR] Waited 60 seconds, no response" >&2
	exit 1
    fi
done
echo

# wait at least 5 more seconds - sometimes the webserver still needs some additional time
sleep 5

cat > $thisFolder/config.webdav.php <<DELIM
<?php

return array(
    'run'=>true,
    'host'=>'${host}:80/owncloud/remote.php/webdav/',
    'user'=>'test',
    'password'=>'test',
    'root'=>'',
    // wait delay in seconds after write operations
    // (only in tests)
    // set to higher value for lighttpd webdav
    'wait'=> 0
);

DELIM

echo "ownCloud container: $container"

# put container IDs into a file to drop them after the test run (keep in mind that multiple tests run in parallel on the same host)
echo $container >> $thisFolder/dockerContainerOwnCloud.$EXECUTOR_NUMBER.webdav

if [ -n "$databaseContainer" ]; then
    echo "Database container: $databaseContainer"
    echo $databaseContainer >> $thisFolder/dockerContainerOwnCloud.$EXECUTOR_NUMBER.webdav
fi

if [ -n "$DEBUG" ]; then
    cat $thisFolder/config.webdav.php
    cat $thisFolder/dockerContainerOwnCloud.$EXECUTOR_NUMBER.webdav
fi
