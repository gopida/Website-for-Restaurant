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
    <script type="text/javascript">
    function signIn() {
        var emailid = document.getElementById('email').value;
        var pswd = document.getElementById('psw').value;
        $.ajax({
            url: 'process.php',
            data: {
                SIGNIN: 1,
                email: emailid,
                password: pswd
            },
            type: 'post',
            success: function(output) {
                if (output == 1) {
                    window.location.replace("index.php");
                } else {
                    document.getElementById('response').innerHTML = 'Please check your Email/Password!';
                }
            }
        });
    }
    </script>
</head>

<body class='master-container'>
    <?php include ("navigation.php"); ?>
    <?php require_once 'process.php'; ?>

    <div>
            <div class="reservationform">
                <h1>Sign in</h1>
                <p id="response"></p>
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" id="email" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" id="psw" required>

                <button type="submit" name="signin" class="lightbutton" onClick='signIn()'>Sign in</button>
            </div>
    </div>
</body>

</html>