<?php
    require_once('header.php');
    if (!isset($_POST['username']) && !isset($_POST['password'])) {
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
        <div class="form-element">
            <label>Confirm Password:</label>
            <input type="password" name="confirm-password" require />
        </div>
        <button type="submit" name="login">Log In</button>
    </form>
<?php 
    } elseif (isset($_POST['username']) && isset($_POST['password'])) {
        $db->create_user($_POST['username'], $_POST['password']);
    } else {
        header("Location: index.php");
    }
    require_once('footer.php');
?>