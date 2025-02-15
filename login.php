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
            <h3 class="text-white text-center"><?php echo $_SESSION['system']['name'] ?></h3>
            <h4 class="text-white text-center"><b>Client Login | <a href="admin/">Administrator Login</a></b></h4>
            <div id="login-center" class="bg-dark row justify-content-center">
                <div class="card col-md-4">
                    <div class="card-body">
                        <form id="login-form">
                            <div class="form-group">
                                <label for="username" class="control-label text-dark">Login ID</label>
                                <input type="text" id="username" name="username" class="form-control form-control-sm"
                                    placeholder="Username/Login ID" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label text-dark">Password</label>
                                <input type="password" id="password" name="password"
                                    class="form-control form-control-sm" placeholder="Password" required>
                            </div>
                            <div class="w-100 d-flex justify-content-center align-items-center">
                                <button class="btn-sm btn-block btn-wave col-md-4 btn-primary m-0 mr-1">Login</button>
                                <a href="register.php">Create Password</a>
                            </div>
                        </form>
                        <p><a href="passwordreset.php">Forgot Password</a></p>
                        <p></p>
                        <i style="text-align: center; color: gray;">1st time login, please use the Login sent to you to
                            create password.</i>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer" style="text-align: center;">
        <strong>Copyright &copy; 2021 <a href="#">LAND/PROPERTY RECOVERY SYSTEM. By Makomelo Alex.
                SIN#1411218922.</a>.</strong>
        All rights reserved.
    </footer>
</body>
<?php include 'footer.php' ?>
<script>
$('#login-form').submit(function(e) {
    e.preventDefault()
    $('#login-form button[type="button"]').attr('disabled', true).html('Logging in...');
    if ($(this).find('.alert-danger').length > 0)
        $(this).find('.alert-danger').remove();
    $.ajax({
        url: 'ajax.php?action=login',
        method: 'POST',
        data: $(this).serialize(),
        error: err => {
            console.log(err)
            $('#login-form button[type="button"]').removeAttr('disabled').html('Login');

        },
        success: function(resp) {
            if (resp == 1) {
                location.href = 'index.php?page=home';
            } else {
                $('#login-form').prepend(
                    '<div class="alert alert-danger">Username or password is incorrect.</div>')
                $('#login-form button[type="button"]').removeAttr('disabled').html(
                    'Create Account');
            }
        }
    })
})
</script>

</html>