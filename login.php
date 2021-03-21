<?php require_once('header.php');
    $showLoginForm = false;

    if (isset($_POST['username']) && isset($_POST['password'])) {
        if ($db->validateUser($_POST['username'], $_POST['password'])) {
            echo('Login successful');
        } else {
            $showLoginForm = true;
            ?>Invalid login.<?php
        }
    } elseif (isset($_SESSION['username'])) {
        // Already logged in
        header("Location: index.php");
    } else {
        $showLoginForm = true;
    }

    if ($showLoginForm) {
?>
    <form method="post" action="login.php">
        <div class="form-element">
            <label>Username:</label>
            <input type="text" name="username" required />
        </div>
        <div class="form-element">
            <label>Password:</label>
            <input type="password" name="password" required />
        </div>
        <button type="submit" name="login">Log In</button>
    </form>

    <a href="register.php">No account? Register here.</a>
<?php } 
require_once('footer.php'); 
?>