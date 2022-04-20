<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment</title>
    <link rel="stylesheet" type="text/css" href="complete.css">
</head>
<body>
<div class="main">
<?php
    $msg = $src = "";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $con = mysqli_connect("localhost", "root", "", "payment") or die("connection to this database failed due to" . mysqli_connect_error());


        $name = mysqli_real_escape_string($con, $_POST["name"]);
        $cvv = mysqli_real_escape_string($con, $_POST['cvv']);
        $card_number = mysqli_real_escape_string($con, $_POST['card_number']);
        $expire_month = mysqli_real_escape_string($con, $_POST['expire_month']);
        $expire_year = mysqli_real_escape_string($con, $_POST['expire_year']);
     

        $stmt = mysqli_prepare($con, "SELECT * FROM `credit_card_details` WHERE `number` = ? AND `name` = ? AND `cvv` = ? AND `expire_month` = ? AND `expire_year` = ?");
        mysqli_stmt_bind_param($stmt, 'sssss', $card_number, $name, $cvv, $expire_month, $expire_year);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $count = mysqli_num_rows($result);

        if ($count > 0){
            $src = "checked.png";
            $msg = "Payment Successful";
        }
        else{
            $src = "remove.png";
            $msg = "Payment Failed";
        }

        mysqli_close($con);
    }
?>       
    <div id="container">
    <img src="<?php echo $src;?>" id="image">
    <label id="label"><?php echo $msg;?></label> 
</div>
</div>
</body>
</html>
    






