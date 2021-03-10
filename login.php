<?php require_once('header.php'); ?>
<?php
    if ($_POST && isset($_POST['username']) && isset($_POST['password'])) {
        $_SESSION['username'] = 'logged';
        header("Location: index.php");
    } elseif (isset($_SESSION['username'])) {
        header("Location: index.php");
    } else {
?>
    <form method="post" action="login.php">
        <div class="form-element">
            <label>Username:</label>
            <input type="text" name="username" required />
        </div>
        <div class="form-element">
            <label>Password:</label>
            <input type="password" name="password" require />
        </div>
        <button type="submit" name="login">Log In</button>
    </form>
<?php } ?>
<?php require_once('footer.php'); ?>