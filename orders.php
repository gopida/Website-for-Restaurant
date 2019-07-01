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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
</head>

<body class='master-container'>
    <?php session_start();
    include ("authnavi.php"); ?>
    <?php require_once 'process.php'; ?>
    <script type="text/javascript">

    </script>
    <div class="reservationform">


        <?php
        $USER_ID = $_SESSION['userid'];
        $order_items = $mysqli->query("SELECT distinct ORDER_ID, STATUS, TOTALPRICE FROM ORDERS WHERE USER_ID='$USER_ID'") or die($mysqli->error);
        $row_count = mysqli_num_rows($order_items);
        if($row_count == 0){
            echo "<h3 align=\"center\">No order placed yet!<h3>";
        }else{
    ?>
        <table class=" table" style="font-size:12px;font-weight: bold;">
            <thead>
                <tr>
                    <th><h3>Order ID</h3></th>
                    <th><h3>Order Items</h3></th>
                    <th><h3>Total Price</h3></th>
                    <th><h3>Status</h3></th>
                </tr>
            </thead>
            <tbody>
                <?php while($item = $order_items->fetch_assoc()):
                    $order_id = $item['ORDER_ID'];
                    $menu_items = $mysqli->query("SELECT M.ITEM_NAME , O.QUANTITY FROM MENU M, ORDERS O
                    WHERE O.ITEM_ID = M.ITEM_ID AND O.ORDER_ID = '$order_id'") or die($mysqli->error);?>
                <tr>
                    <td>
                        <?php echo $order_id; ?>
                    </td>
                    <td>
                        <?php while($order_item = $menu_items->fetch_assoc()):
                            $itemname = $order_item['ITEM_NAME'];
                            $quantity = $order_item['QUANTITY'];
                            echo "$itemname - ($quantity) <br /> ";
                        endwhile; ?>
                    </td>
                    <td>
                        <?php echo $item['TOTALPRICE']; ?>
                    </td>
                    <td>
                        <?php echo $item['STATUS']; ?>
                    </td>
                </tr>
                    <?php endwhile; ?>
            </tbody>
        </table>
        <?php } ?>
    </div>
</body>

</html>