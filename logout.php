<?php require_once('header.php'); ?>
    <span class="status">logging out...</span>
<?php 
    require_once('footer.php');

    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-86400, '/');
    }

    session_destroy();

    header("Location: index.php");
?>