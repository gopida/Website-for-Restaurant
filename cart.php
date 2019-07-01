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
    function update(itemid) {

        var quantity = document.getElementById('quantity'.concat(itemid)).value;

        $.ajax({
            url: 'process.php',
            data: {
                UPDATE: 1,
                ITEM_ID: itemid,
                ITEM_QUANTITY: quantity
            },
            type: 'post',
            success: function(output) {}
        });

        location.reload();

    }

    function deleteItem(itemid) {

        $.ajax({
            url: 'process.php',
            data: {
                DELETE: 1,
                ITEM_ID: itemid
            },
            type: 'post',
            success: function(output) {}
        });

        location.reload();

    }

    function deliveryOrder() {

        var adr = document.getElementById("adr").value;
        var city = document.getElementById("city").value;
        var state = document.getElementById("state").value;
        var zip = document.getElementById("zip").value;
        var totalprice = document.getElementById("totalprice").innerHTML;


        $.ajax({
            url: 'process.php',
            data: {
                DELIVERY: 1,
                addr_name: adr,
                addr_city: city,
                addr_state: state,
                addr_zip: zip,
                total_price: totalprice
            },
            type: 'post',
            success: function(output) {
                document.getElementById('orderid').innerHTML = "ORDER ID : ".concat(output);
            }
        });

    }

    function orderPickup() {

        var totalprice = document.getElementById("totalprice").innerHTML;


        $.ajax({
            url: 'process.php',
            data: {
                PICKUP: 1,
                total_price: totalprice
            },
            type: 'post',
            success: function(output) {
                document.getElementById('orderid').innerHTML = "ORDER ID : ".concat(output);
            }
        });

    }

    function redirect() {
        window.location.replace("orders.php");
    }

    function show() {
        var addr = document.getElementById("address");
        addr.style.display = "block";
    }
    </script>

    <?php 
        $USER_ID = $_SESSION['userid'];
        $cart_items = $mysqli->query("SELECT distinct M.ITEM_ID, M.ITEM_NAME, M.ITEM_PRICE, C.QUANTITY FROM CART C, MENU M 
                WHERE C.ITEM_ID = M.ITEM_ID AND C.USER_ID = '$USER_ID';") or die($mysqli->error);

    ?>


    <div class="reservationform">
        
        <?php $row_count = mysqli_num_rows($cart_items);

        if($row_count == 0){
            echo "<h3 align=\"center\">Cart is Empty! </h3>";
        }else{
        ?>
        
        <div class=" item">
        <table class="table" style="font-size:12px;">
            <?php 
            $totalprice = 0;
            while($item = $cart_items->fetch_assoc()): 
            $price = $item['ITEM_PRICE'] * $item['QUANTITY'];
            $totalprice = $totalprice + $price;
            ?>
            <thead>
                <tr>
                    <div id="<?php echo $item['ITEM_ID']; ?>">
                        <th class="itemname cart"><?php echo $item['ITEM_NAME']; ?>
                    </div>
                    </th>
                    <th><input style="width:100px;height:20px;" type="number"
                            id="quantity<?php echo $item['ITEM_ID']; ?>" min="1" max="5"
                            value=<?php echo $item['QUANTITY']; ?>></th>
                    <th class="itemprice"><?php echo $price; ?></th>
                    <th><button type="submit" name="update" class="btn btn-primary"
                            onClick='update(<?php echo $item['ITEM_ID']; ?>)'>Update</button></th>
                    <th><button type="submit" name="delete" class="btn btn-danger"
                            onClick='deleteItem(<?php echo $item['ITEM_ID']; ?>)'>Delete</button></th>
    </div>
    </tr>
    <thead>
        <?php endwhile; ?>
    <tbody>
        <tr>
            <td></td>
            <td>
                <p>Total Price </p>
            </td>
            <td id="totalprice"><?php echo $totalprice; ?></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan=2 align="center">
                <button class="btn btn-info" onClick="show()">
                    Deliver
                </button>
            </td>
            <td colspan=2 align="center">
                <button class="btn btn-info" onClick="orderPickup()" data-toggle="modal" data-target="#myModal">
                    Pick Up
                </button>
            </td>
            <td></td>
        </tr>
        </table>


    </tbody>
    </div>
    <table class="table">
        <tr id="address" style="display: none;">

            <td colspan="5">

                <h3>Delivery Address</h3>

                <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
                <label for="city"><i class="fa fa-institution"></i> City</label>
                <input type="text" id="city" name="city" placeholder="New York">

                <label for="state">State</label>
                <input type="text" id="state" name="state" placeholder="NY">
                <label for="zip">Zip</label>
                <input type="text" id="zip" name="zip" placeholder="10001">
                <button class="btn btn-success center-block" data-toggle="modal" data-target="#myModal"
                    onClick="deliveryOrder()">
                    Place Order
                </button>


            </td>
        </tr>
    </table>


    </div>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Order successfully placed!</h4>
                </div>
                <div class="modal-body">
                    <p id="orderid"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" onClick="redirect()" class="btn btn-default"
                        data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    </div>
</body>

</html>