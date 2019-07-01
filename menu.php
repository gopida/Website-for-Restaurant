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
    <?php session_start(); 
     if(isset($_SESSION['userid'])){
        include ("authnavi.php");
    }else{
        include ("navigation.php");
    } ?>
    <?php require_once 'process.php'; ?>
    <?php 
        $menu_items = $mysqli->query("SELECT * FROM MENU") or die($mysqli->error);
    ?>

    <div class="reservationform"">
        
    
        <?php while($item = $menu_items->fetch_assoc()): ?>
        <div class=" item">
        <table class="table">
            <thead>
                <tr>
                    <th class="itemname"><?php echo $item['ITEM_NAME']; ?></th>
                    <th class="itemprice"><p align="right"><?php echo $item['ITEM_PRICE']; ?></p></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th class="itemdesc"><?php echo $item['ITEM_DESC']; ?></th>
                    <th></th>
                </tr>
            </tbody>
        </table>
    </div>
    <?php endwhile; ?>


    </div>
</body>

</html>