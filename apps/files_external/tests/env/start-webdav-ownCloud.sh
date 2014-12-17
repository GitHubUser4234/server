#!/bin/bash
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
thisFolder=`echo $0 | replace "env/start-webdav-ownCloud.sh" ""`

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

# TODO find a way to determine the successful initialization inside the docker container
echo "Waiting 30 seconds for ownCloud initialization ... "
sleep 30

# get mapped port on host for internal port 80 - output is IP:PORT - we need to extract the port with 'cut'
port=`docker port $container 80 | cut -f 2 -d :`


cat > $thisFolder/config.webdav.php <<DELIM
<?php

return array(
    'run'=>true,
    'host'=>'localhost:$port/owncloud/remote.php/webdav/',
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
    echo $thisFolder/config.webdav.php
fi
