<?php require_once('header.php'); ?>
<?php
    if ($_POST && isset($_POST['username']) && isset($_POST['password'])) {
        echo('ok');
        $_SESSION['username'] = 'logged';
    } elseif (isset($_SESSION['username'])) {
        // redirect
        echo('logged in already');
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