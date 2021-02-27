<?php
$username = '';
$errors = [
    'username' => '',
    'password' => '',
    'repeat_password' => ''
];

if (isset($_POST['submit'])) {

    include('config/database_connection.php');
    //USERNAME
    $username = $_POST['username'];
    if (empty($username)) {
        $errors['username'] = 'Please enter a username';
    } else {
        $sql = "SELECT COUNT(*) AS count
                FROM users
                WHERE username = '" . $conn->real_escape_string($username) . "';";

        $result = mysqli_query($conn, $sql);

        $amount = mysqli_fetch_all($result)[0][0];

        if ($amount > 0) {
            $errors['username'] = 'Username already exists';
        }

    }
    //PASSWORD
    $password = $_POST['password'];
    if (empty($password)) {
        $errors['password'] = 'Please enter a password';
    }
    //REPEAT PASSWORD
    if ($_POST['repeat_password'] != $password) {
        $errors['repeat_password'] = 'Passwords must be the same';
    }

    if (!array_filter($errors)) {
        //save to db
        $sql = "INSERT INTO users(username, password) VALUES ('$username', '" . password_hash($password, PASSWORD_BCRYPT) . "')";
        //redirect
        if (mysqli_query($conn, $sql)) {
            session_start();
            $_SESSION['user'] = $username;
            header('Location: message_list.php');
        } else {
            echo mysqli_error($conn);
        }
    }

    mysqli_close($conn);

}

?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php') ?>

<section class="container grey-text">
    <h4 class="center">Log in</h4>
    <form action="register.php" method="POST" class="white">
        <label>Username:</label>
        <input type="text" name="username" value="<?php echo $username ?>">
        <div class="red-text"><?php echo $errors['username']; ?></div>
        <label>Password:</label>
        <input type="password" name="password">
        <div class="red-text"><?php echo $errors['password']; ?></div>
        <label>Repeat password:</label>
        <input type="password" name="repeat_password">
        <div class="red-text"><?php echo $errors['repeat_password']; ?></div>
        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>

<?php include('templates/footer.php') ?>
</html>