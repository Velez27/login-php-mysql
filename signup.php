<?php

require 'database.php';

$message = '';

if(!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = 'INSERT INTO usuarios (email, password) VALUES (:email, :password)';
    $statment = $conn->prepare($sql);
    $statment->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $statment->bindParam(':password', $password);

    if($statment->execute()) {
        $message = 'Successfully created new user';
    } else {
        $message = 'Sorry there must have been an issue creating you account';
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS CUSTOM -->
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>SignUp</title>
</head>
<body>

    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
        <p> <?= $message ?> </p>
<?php endif ?>

    <h1>SignUp</h1>
    <span>or <a href="login.php">Login</a></span>

    <form action="signup.php" method="POST">
        <input type="text" name="email" placeholder="Enter your email">
        <input type="password" name="password" placeholder="Enter your password">
        <input type="password" name="confirm_password" placeholder="Confirm your password">
        <input type="submit" value="Send">
    </form>

</body>
</html>