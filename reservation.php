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


    <script type="text/javascript">
    function reservationform() {

        var fullname = document.getElementById('fullname').value;
        var mobile = document.getElementById('mobile').value;
        var members = document.getElementById('members').value;
        var datetime = document.getElementById('datetime').value;
        var specialrequest = document.getElementById('specialrequest').value;
        var parking = 'No'
        if(document.getElementById('parking').checked == true){
            var parking = 'Yes'
        }

        $.ajax({
            url: 'process.php',
            data: {
                RESERVATION: 1,
                FULLNAME: fullname,
                MOBILE: mobile,
                MEMBERS: members,
                DATETIME: datetime,
                SPECIALREQUEST: specialrequest,
                PARKING: parking
            },
            type: 'post',
            success: function(output) {
                document.getElementById('resvid').innerHTML = "Reservation ID : ".concat(output);            }
        });

    }

    function redirect() {
        window.location.replace("index.php");
    }
  
    </script>

    <div class="reservationform">
        <h1 align="center">BOOK A TABLE!</h1>

        <input type="text" id="fullname" placeholder="Full Name" />
        <br /> <br />

        <input type="tel" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" id="mobile" placeholder="Mobile Number" />
        <br /> <br />
        <input type="number" id="members" min="1" max="15" placeholder="Members" />

        <input type="datetime-local" id="datetime" />

        <textarea id="specialrequest" placeholder="Special Request?"></textarea>
        <div align="center">
            <label for="parking"><input type="checkbox" id="parking" name="parking"/> <span>Need Parking</span></label>
        </div>
        <input type="submit" class="btn btn-info btn-lg" name="reservation" data-toggle="modal" data-target="#myModal" 
        onClick='reservationform()' value="Submit" />

    </div>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Thank You! Table reserved! </h4>
                </div>
                <div class="modal-body">
                    <p id="resvid"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" onClick="redirect()" class="btn btn-default"
                        data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>