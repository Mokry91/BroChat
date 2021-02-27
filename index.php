<?php
session_start();

$error = '';

include("config/database_connection.php");

if (isset($_POST['submit'])) {

    if (!empty($_POST['username'])) {
        $sql = "SELECT username, password FROM users 
            WHERE username = '{$_POST['username']}'";

        $result = mysqli_query($conn, $sql);

        $user = mysqli_fetch_all($result);

        if ($user) {
            $pass_hash = $user[0][1];
            if (password_verify($_POST['password'], $pass_hash)) {
                $_SESSION['user'] = $_POST['username'];
                header("Location: message_list.php");
            } else {
                $error = "Incorrect password";
            }
        } else {
            $error = 'User does not exist';
        }
    } else {
        $error = 'Please enter your log in data';
    }
}

mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php') ?>

<section class="container grey-text">
    <h4 class="center">Log in</h4>
    <form action="index.php" method="POST" class="white">
        <label>Username:</label>
        <input type="text" name="username">
        <label>Password:</label>
        <input type="password" name="password">
        <div class="red-text"><?php echo $error; ?></div>
        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>

<?php include('templates/footer.php') ?>
</html>