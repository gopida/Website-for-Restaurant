<!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript">
    function logout() {
            $.ajax({
                url: 'process.php',
                data: { LOGOUT: 1
                },
                type: 'post',
                success: function(output) {
                }
            });
            window.location.replace("index.php");
    }
</script>
</head>
<body>
<div>
    <nav class="navbar navbar-inverse top-fixed">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">SD Eats!</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>
                <li class="active"><a href="ordernow.php">Order Now!</a></li>
                <li><a href="menu.php">MENU</a></li>
                <li><a href="reservation.php">Reservation</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <li><a href="cart.php">Cart</a></li>
            <li><a href="orders.php">Order</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo 'Welcome, ' . $_SESSION['name']; ?></a></li>
            <li><a href="javascript:logout();">Logout</a></li>    
        </ul>
        </div>
    </nav>
</div>
</body>
<html>