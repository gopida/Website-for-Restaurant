<?php
$mysqli = new mysqli('localhost', 'root', '', 'restaurant') or die(mysqli_error($mysqli));

if(isset($_POST['signup'])){

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['psw'];

    $mysqli->query("INSERT INTO USER (NAME, EMAIL, PASSWORD) VALUES ('$username', '$email', '$password')") or die($mysqli->error);

    $user_id = mysqli_insert_id($mysqli);
    session_start();
    $_SESSION['name'] = $username;
    $_SESSION['userid'] = $user_id;

    header('location: index.php');
}


if(isset($_POST['SIGNIN'])){

    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_item = $mysqli->query("SELECT NAME , USER_ID FROM USER WHERE EMAIL='$email' AND PASSWORD= '$password'") or die($mysqli->error);

    $row_count = mysqli_num_rows($user_item);
    if($row_count > 0 ){
        $row = mysqli_fetch_assoc($user_item);
        session_start();
        $_SESSION['name'] = $row['NAME'];
        $_SESSION['userid'] = $row['USER_ID'];
        
        echo "1";
    }else{
        echo "0";
    }
}

if(isset($_POST['LOGOUT'])){
    session_start();
    session_destroy();
}


if(isset($_POST['RESERVATION'])){

    $fullname =  $_POST['FULLNAME'];
    $mobile = $_POST['MOBILE'];
    $members = $_POST['MEMBERS'];
    $resvtime =  date("Y-m-d H:i:s",strtotime($_POST['DATETIME']));
    $specialrequest = $_POST['SPECIALREQUEST'];
    $parking = $_POST['PARKING'];
    

    $mysqli->query("INSERT INTO RESERVATION (fullname, mobile, members, reservationtime, specialrequest, parking) values 
                    ('$fullname', '$mobile', '$members', '$resvtime', '$specialrequest', '$parking')") 
                    or die($mysqli->error);

    $resv_id = mysqli_insert_id($mysqli);

    echo "$resv_id";
}

if (isset($_POST['ORDER'])){
    session_start();
    $USER_ID = $_SESSION['userid'];
    $ITEM_ID = $_POST['ITEM_ID'];
    $mysqli->query("INSERT INTO CART (USER_ID, ITEM_ID) VALUES ('$USER_ID' , '$ITEM_ID')")  or die($mysqli->error);
}

if (isset($_POST['UPDATE'])){
    session_start();
    $USER_ID = $_SESSION['userid'];
    $ITEM_ID = $_POST['ITEM_ID'];
    $ITEM_QUANITY = $_POST['ITEM_QUANTITY'];
    $mysqli->query("UPDATE CART SET QUANTITY = '$ITEM_QUANITY' WHERE ITEM_ID = '$ITEM_ID' AND USER_ID='$USER_ID'")  or die($mysqli->error);
}

if (isset($_POST['DELETE'])){
    session_start();
    $USER_ID = $_SESSION['userid'];
    $ITEM_ID = $_POST['ITEM_ID'];
    $mysqli->query("DELETE FROM CART WHERE ITEM_ID = '$ITEM_ID' AND '$USER_ID'")  or die($mysqli->error);
}

if (isset($_POST['DELIVERY'])){
    session_start();
    $USER_ID = $_SESSION['userid'];
    $ADDRESS_NAME = $_POST['addr_name'];
    $CITY = $_POST['addr_city'];
    $STATE = $_POST['addr_state'];
    $ZIP = $_POST['addr_zip'];
    $TOTALPRICE = $_POST['total_price'];

    $mysqli->query("INSERT INTO ADDRESS(USER_ID, ADDRESS_NAME, CITY, STATE, ZIP) VALUES ('$USER_ID', '$ADDRESS_NAME', '$CITY', '$STATE', '$ZIP')") or die($mysqli->error);
    
    $address_id = mysqli_insert_id($mysqli);

    $cart_items = $mysqli->query("SELECT distinct ITEM_ID, QUANTITY FROM CART WHERE USER_ID = '$USER_ID'");

    $order_id = time();
    while($item = $cart_items->fetch_assoc()){
        $item_id = $item['ITEM_ID'];
        $quantity = $item['QUANTITY'];
        $mysqli->query("INSERT INTO ORDERS(ORDER_ID, USER_ID, ITEM_ID, ADDRESS_ID, TOTALPRICE , QUANTITY)
                VALUES ('$order_id', '$USER_ID' ,'$item_id', '$address_id', '$TOTALPRICE', $quantity)") or die($mysqli->error);
      }

      $mysqli->query("DELETE FROM CART WHERE USER_ID = '$USER_ID'") or die($mysqli->error);

      echo $order_id;
    }

    if (isset($_POST['PICKUP'])){
        session_start();
        $USER_ID = $_SESSION['userid'];
        $TOTALPRICE = $_POST['total_price'];
    
        $address_id = 1;

        $cart_items = $mysqli->query("SELECT distinct ITEM_ID, QUANTITY FROM CART WHERE USER_ID = '$USER_ID'");
    
        $order_id = time();
        while($item = $cart_items->fetch_assoc()){
            $item_id = $item['ITEM_ID'];
            $quantity = $item['QUANTITY'];

            $mysqli->query("INSERT INTO ORDERS(ORDER_ID, USER_ID, ITEM_ID, ADDRESS_ID, TOTALPRICE, QUANTITY)
                    VALUES ('$order_id', '$USER_ID' ,'$item_id', '$address_id', '$TOTALPRICE', $quantity)") or die($mysqli->error);
          }
          $mysqli->query("DELETE FROM CART WHERE USER_ID = '$USER_ID'") or die($mysqli->error);
          
          echo $order_id;
        }
    
?>
