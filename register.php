<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
  ob_start();
  // if(!isset($_SESSION['system'])){

    $system = $conn->query("SELECT * FROM system_settings")->fetch_array();
    foreach($system as $k => $v){
      $_SESSION['system'][$k] = $v;
    }
  // }
  ob_end_flush();
?>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Login | <?php echo $_SESSION['system']['name'] ?></title>


    <?php include('./header.php'); ?>
    <?php 
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

?>

</head>
<style>
body {
    width: 100%;
    height: calc(100%);
    position: fixed;
    top: 0;
    left: 0;
    align-items: center !important;
    /*background: #007bff;*/
}

main#main {
    width: 100%;
    height: calc(100%);
    display: flex;
}
</style>

<body class="bg-dark">


    <main id="main">

        <div class="align-self-center w-100">
            <h4 class="text-white text-center"><b>Create Client Online Account</b></h4>
            <div id="login-center" class="bg-dark row justify-content-center">
                <div class="card col-md-4">
                    <div class="card-body">
                        <form id="vsr-frm" method="POST" action="">
                            <div class="form-group">
                                <label for="ClientId" class="control-label text-dark">Identity #:</label>
                                <input type="text" id="ClientId" name="ClientId" class="form-control form-control-sm" placeholder="Enter Identity Num. i.e NRC/PACRA"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="ClientId" class="control-label text-dark">Emalil</label>
                                <input type="email" id="email" name="email" class="form-control form-control-sm" placeholder="Enter email"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label text-dark">Password</label>
                                <input type="password" id="password" name="pwd1" class="form-control form-control-sm" placeholder="Type your password"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label text-dark">Retype Password</label>
                                <input type="password" id="password" name="pwd2" class="form-control form-control-sm" placeholder="Confirm your password"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary" id='button' name="register">Activate Account</button>
                            <a href="login.php">Login</a>
                        </form>

                        <?php
include 'db_connect.php';

if(ISSET($_POST['register'])){
$LoginId  = $_POST['ClientId'];
$pwd1 = $_POST['pwd1'];
$pwd2 = $_POST['pwd2'];
$email = $_POST['email'];

$qry = $conn->query("SELECT id FROM client WHERE id = '$LoginId' ");
$rs = $qry->fetch_array();
if($rs > 0){//Client ID Found
    if($pwd1 == $pwd2){//Passwords Match
        $qry2 = $conn->query("SELECT ClientId FROM client_login WHERE ClientId = '$ClientID' ");
        $rs2 = $qry2->fetch_array();
        if($rs2 > 0){//If Already registered
            echo '<script>alert("Error! Account Already Created.");</script>';
        }else{//If not registered
            $qry3 = $conn->query("INSERT INTO client_login(ClientId, Password) VALUES('$LoginId', md5('$pwd1'))") or die(myqli($conn));

            $to = $email;
                $subject = 'REVENUE DEPARTMENT';
                $from = 'revenuedepartments@rcs.com';
                 
                // To send HTML mail, the Content-type header must be set
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                 
                // Create email headers
                $headers .= 'From: '.$from."\r\n".
                    'Reply-To: '.$from."\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                 
                // Compose a simple HTML email message
                $message = '<html><body style="">';
                $message .= '<h3 style="color:;">CONGRATULATION!....</h3>';
                $message .= '<p style="font-size:18px;">Your Account has been created. <br/>Login ID: <b>'.$LoginId.'</b> <br/>Password: <b>'.$pwd2.'.</b></p>';
                $message .= '</body></html>';
                 
                // Sending email
                if(mail($to, $subject, $message, $headers)){
                    echo '<span style="color:green;text-align:center;">Success! Check your email for your Details</span>';
                } else{
                    echo '<span style="color:green;text-align:center;">Success! You can login. Error! Email Not Sent</span>';
                }
        }
    }else{//Passwords dont match
        echo '<span style="color:red;text-align:center;">Error! Password Mismatch</script>';
    }
    
}else{//Client ID not Found
    echo '<span style="color:red;text-align:center;">ID Error! Contact Revenue Department for Help.</script>';
    }
}
?>



                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
<?php include 'footer.php' ?>

</html>