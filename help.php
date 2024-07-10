<?php include('db_connect.php'); 
$qry = $conn->query("SELECT * FROM system_settings");
$rs = $qry->fetch_array();
?>
<!-- Info boxes -->
<div class="col-12">
    <div class="card">
        <div class="card-body">
            Welcome! <b><?php echo $_SESSION['login_name'] ?>!</b>
        </div>
    </div>
</div>
<i>Write your concerns, query or question, our team will respond. Call <b><?php echo '<a href="tel:'.$rs['contact'].'">'.$rs['contact'].'</a></b> or Email <a href="mailto:'.$rs['email'].'"><b>'.$rs['email'] ?></b></a> for Help.</i>
<div class="row col-8">

    <?php
	if(ISSET($_POST['send'])){
        
		$clientId = $_POST['clientId'];
		$Query = $_POST['Query'];

		$send = $conn->query("INSERT INTO client_query(`ClientId`,  `Query`) VALUES ('$clientId', '$Query')");

		if($send){
            $get = $conn->query("SELECT * FROM client WHERE id = '$SessionId'");
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
		  $message .= '<h3 style="color:;">Hello.! '.$result['ClientName'].' - '.$result['ClientID'].'</h3>';
		  $message .= '<div style="font-size:18px;"><p>Your Message has been sent.<p/>
          <h4>YOUR MESSAGE.</h4>
		  <hr style="border-style:dotted; border-color: black;" />
		 '.$Query.'.<br/>
		  <hr style="border-style:dotted; border-color: black;" />
			  <center>&copy;2021, LAND/PROPERTY RATES DEPARTMENT</center>
		  <br/>
		  <i>
			  <center>THANK YOU.</center>
		  </i>';
		  $message .= '</div></body></html>';
			
		  // Sending email
		  if(mail($to, $subject, $message, $headers)){
			echo '<span style="color:green;text-align:center; font-weight: bold;">Success!. Your Message has been sent.</span>';
		  } else{
			echo '<span style="color:red;text-align:center; font-weight: bold;">Error! Sending Email Failed</span>';
		  }
		}else{
			echo '<span style="color:red;text-align:center; font-weight: bold;">System Error! Faile to Pay.</span>';
		}
	}
    
                  $qry = $conn->query("SELECT * FROM client  WHERE id = '$SessionId' ");
                  $rs = $qry->fetch_array();
                echo'
                <div class="container-fluid">
                  <form action="" id="clientId" method="POST">
					<input type="hidden" class="form-control form-control-sm" name="clientId" id="clientId" value="'.$rs['ClientID'].'" readonly>		  

                      <label for="PropertyId" class="control-label">Date</label>
                    <input type="text" class="form-control form-control-sm" name="date" value="'.date('d M, Y').'" readonly>
                    <div id="msg" class="form-group"></div>
                    <div class="form-group">
                      <label for="Query" class="control-label">Your Message</label>
                      <textarea type="text" class="form-control form-control-sm" name="Query" id="Query" required></textarea>					  
                    </div>
                    <div class="card-footer border-top border-info">
                      <div class="d-flex w-100 justify-content-center align-items-center">
                        <button type="submit" class="btn btn-flat  bg-gradient-primary mx-2" name="send">SEND</button>
                      </div>
                  </form>
                </div>';
            ?>
        </div>
