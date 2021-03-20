<?php
    require_once('header.php');
    $showForm = false;
    $showLoginLink = false;

    if (!isset($_POST['username']) && !isset($_POST['password'])) {
        $showForm = true;
    } elseif (isset($_POST['username']) && isset($_POST['password'])) {
        $result = $db->createUser($_POST['username'], $_POST['password']);

        if ($result) {
            echo('account created');
            $showLoginLink = true;
        } else {
            $showForm = true;
            
            echo('failed to create account');
        }
    } else {
        header("Location: index.php");
    }

    if ($showForm) { 
        $showLoginLink = true;
?>
        <form method="post" action="register.php">
            <div class="form-element">
                <label>Username:</label>
                <input type="text" name="username" required />
            </div>
            <div class="form-element">
                <label>Password:</label>
                <input type="password" name="password" require />
            </div>
            <div class="form-element">
                <label>Confirm Password:</label>
                <input type="password" name="confirm-password" require />
            </div>
            <button type="submit" name="login">Register</button>
        </form>
<?php }
    
    if ($showLoginLink) { ?>
        <a href="login.php">Login</a>
<?php }
    require_once('footer.php');
?>