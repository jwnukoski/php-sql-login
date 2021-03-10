<?php
    // Temp for debug development:
    error_reporting(E_ALL & E_STRICT);
    ini_set('display_errors', '1');
    ini_set('log_errors', '0');
    ini_set('error_log', './');
?>

<?php require_once('header.php'); ?>  
    <?php if (isset($_SESSION['username'])) { ?>
        <a href="logout.php">Logout</a>
    <?php } else { ?>
        <a href="login.php">Login</a>
    <?php } ?>
<?php require_once('footer.php'); ?>