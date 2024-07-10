<?php include('db_connect.php'); ?>
<!-- Info boxes -->
<div class="col-12">
    <div class="card">
        <div class="card-body">
            Welcome! <b><?php echo $_SESSION['login_name'] ?>!</b>
        </div>
    </div>
</div>
<span style="color:green;text-align:center; font-weight: bold;">SELECT PAYMENT METHOD</span>
<?php
$proId = $_GET['proId'];
$qry = $conn->query("SELECT * FROM property  WHERE PropertyId = '$proId' ");
$rs = $qry->fetch_array();
?>
<form action="./index.php?page=make_payment" method="POST">
<input type="hidden" class="form-control form-control-sm" name="id" id="id" value="<?php echo $rs['id']; ?>" readonly>
    <div class="form-group">
        <label for="paymethode" class="control-label">Payment Method</label>
        <select class="form-control" name="paymethode" id="paymethode">
            <option value="1">Mobile Money</option>
            <option value="2">Credit Card</option> 
        </select>
    </div>
    <button type="submit" class="btn btn-flat  bg-gradient-primary mx-2" name="step2">NEXT <i class="fa fa-angle-double-right"> </i></button>
</form>
</div>