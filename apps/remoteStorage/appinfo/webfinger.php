<?php if(OC_User::userExists(WF_USER)) { ?>
    <Link
        rel="remoteStorage"
        template="<?php echo WF_BASEURL; ?>/apps/remoteStorage/WebDAV.php/<?php echo WF_USER; ?>/remoteStorage/{category}/"
        api="WebDAV"
        auth="<?php echo WF_BASEURL; ?>/?app=remoteStorage&getfile=auth.php/<?php echo WF_USER; ?>">
    </Link>
<?php } ?>
