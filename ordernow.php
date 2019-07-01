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
    include ("authnavi.php"); ?>
    <?php require_once 'process.php'; ?>
    <script type="text/javascript">
    <?php 
        $menu_items = $mysqli->query("SELECT * FROM MENU") or die($mysqli->error);
    ?>

    function add(itemid) {

        if (document.getElementById(itemid).innerHTML !== "Added") {
            $.ajax({
                url: 'process.php',
                data: {
                    ORDER: 1,
                    ITEM_ID: itemid
                },
                type: 'post',
                success: function(output) {}
            });
            document.getElementById(itemid).innerHTML = "Added";
        }

    }
    </script>

    <div class="reservationform"">
        
    
        <?php while($item = $menu_items->fetch_assoc()): ?>
        <div class=" item">
        <table class="table">
            <thead>
                <tr>
                    <th class="itemname"><?php echo $item['ITEM_NAME']; ?></th>
                    <th class="itemprice">
                        <p align="right"><?php echo $item['ITEM_PRICE']; ?></p>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th class="itemdesc"><?php echo $item['ITEM_DESC']; ?></th>
                    <th><button type="submit" id=<?php echo $item['ITEM_ID']; ?> name="addtocart"
                            class="btn btn-primary pull-right" onClick='add(<?php echo $item['ITEM_ID']; ?>)'>Add to Cart</button>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
    <?php endwhile; ?>
    <?php 
        $USER_ID = $_SESSION['userid'];
        $cart_items = $mysqli->query("SELECT distinct ITEM_ID FROM CART 
                WHERE USER_ID = '$USER_ID';") or die($mysqli->error);
        
        while($cart_item = $cart_items->fetch_assoc()):
            $i_id = $cart_item['ITEM_ID'];
            echo "<script type=\"text/javascript\">document.getElementById('$i_id').innerHTML = \"Added\";</script>";
        endwhile;
    ?>

    </div>
</body>

</html>