<!DOCTYPE html>
<html lang="en">

<head>
    <title>San Diego Eats!</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
</head>

<body class='master-container'>
    <?php include ("navigation.php"); ?>
    <?php require_once 'process.php'; ?>
    <div>
        <form action="process.php" method="POST">
            <div class="reservationform">
                <h1>Sign Up</h1>
                <p>Please fill in this form to create an account.</p>
                <label for="username"><b>Name</b></label>
                <input type="text" placeholder="Enter name" name="username" required>

                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>

                <label for="psw-repeat"><b>Repeat Password</b></label>
                <input type="password" placeholder="Repeat Password" name="psw-repeat" required>

                <button type="submit" name="signup" class="lightbutton">Sign Up</button>
            </div>
        </form>
    </div>
</body>

</html>