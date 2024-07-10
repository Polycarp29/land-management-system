<?php include('db_connect.php'); ?>
<!-- Info boxes -->
<div class="col-12">
    <div class="card">
        <div class="card-body">
            Welcome! <b><?php echo $_SESSION['login_name'] ?>!</b>
        </div>
    </div>
</div>
<i>You property will be removed after review, ensure you have cleared all outstanding balances.</i>
<div class="row col-8">

    <?php
	


	if(ISSET($_POST['removeProperty'])){
		$ClientProperty = $_POST['ClientProperty'];
		$ClientId = $_POST['clierntId'];
		$propertyUse = $_POST['propertyUse'];
		$PropertyId  = $_POST['PropertyId'];
    $Property = $_POST['property'];
    $Comment = "Remove Property";
    $status = "0";

		$insert = $conn->query("INSERT INTO update_requests(ClientId, PropertyUse, PropertyId, Property, Comment, status )
		VALUES ('$ClientId', '$propertyUse', '$PropertyId', '$Property', '$Comment', '$status')");

		if($insert){
      $get = $conn->query("SELECT * FROM client WHERE id = '$ClientId' ");
      $result = $get->fetch_array();

		  $to = $result['Email'];
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
		  $message .= '<h3 style="color:;">Client Change Request</h3>';
		  $message .= '<div style="font-size:18px;"><p>You have have requested to remove propert with associated with the following information.<p/>
		  PROPERTY DESC.: '.$Property.' <br/>
		  PROPERTY NUM.: '.$PropertyId.'.<br/>
		  PAYMENT NUM.: '.$propertyUse.'.<br/>
		  <br/>
		  <hr style="border-style:dotted; border-color: black;" />
			  <center>&copy;2021, LAND/PROPERTY RATES DEPARTMENT</center>
		  <br/>
		  <i>
			  <center></center>
		  </i>';
		  $message .= '</div></body></html>';
			
		  // Sending email
		  if(mail($to, $subject, $message, $headers)){
			echo '<span style="color:green;text-align:center; font-weight: bold;">Success!. Your Request has been sent.</span>';
		  } else{
			echo '<span style="color:red;text-align:center; font-weight: bold;">Error! Sending Email Failed</span>';
		  }
		}else{
			echo '<span style="color:red;text-align:center; font-weight: bold;">System Error! Faile to send change request.</span>';
		}
	}


                  $proId = $_GET['proId'];
                  $qry = $conn->query("SELECT * FROM property  WHERE PropertyId = '$proId' ");
                  $rs = $qry->fetch_array();
                    echo'
                <div class="container-fluid">
                  <form action="" id="make_payment" method="POST">
					<input type="hidden" class="form-control form-control-sm" name="ClientProperty" id="id" value="'.$rs['id'].'" readonly>
					<input type="hidden" class="form-control form-control-sm" name="clierntId" id="clierntId" value="'.$rs['ClientId'].'" readonly>		  

                    <label for="PropertyId" class="control-label">Property Number</label>
                      <input type="text" class="form-control form-control-sm" name="PropertyId" value="'.$rs['PropertyId'].'" readonly>
                      <div id="msg" class="form-group"></div>
                    <div class="form-group">
                      <label for="property" class="control-label">Property Description</label>
                      <input type="text" class="form-control form-control-sm" name="property" id="property" value="'.$rs['Property'].'" readonly>					  
                    </div>
                    <div class="form-group">
                      <label for="property" class="control-label">Property Use</label>	
                      <input type="text" class="form-control form-control-sm" name="propertyUse" id="propertyUse" value="'.$rs['PropertyUse'].'" readonly>					  
                    </div>
                    <div class="form-group">
                    <div class="card-footer border-top border-info">
                      <div class="d-flex w-100 justify-content-center align-items-center">
                        <button type="submit" class="btn btn-flat  bg-gradient-danger mx-2" name="removeProperty">REMOVE PROPERTY</button>
                      </div>
                  </form>
                </div>';
            ?>
</div>
<script>
function reSum() {
    var num1 = parseInt(document.getElementById("Balance").value);
    var num2 = parseInt(document.getElementById("amountToPay").value);
    document.getElementById("CurrentBalance").value = +num1 - num2;

}
</script>