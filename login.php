<?php require_once('header.php');
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $valid = $db->validateUser($_POST['username'], $_POST['password']);
        if ($valid) {
            header("Location: index.php");
        } else {
            ?>Invalid login. <a href="login.php">Try again.</a><?php
        }
    } elseif (isset($_SESSION['username'])) {
        // Already logged in
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

    <a href="register.php">No account? Register here.</a>
<?php } ?>
<?php require_once('footer.php'); ?>