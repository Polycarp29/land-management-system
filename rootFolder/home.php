<?php include('db_connect.php'); ?>
<!-- Info boxes -->
<div class="col-12">
    <div class="card">
        <div class="card-body">
            Welcome! <b><?php echo $_SESSION['login_name'] ?>!</b>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-6 col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-book"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Balance Due</span>
                <span class="info-box-number">
                    <?php 
                  $qry=$conn->query("SELECT FORMAT(SUM(property.CurrentBalance),2) AS CurrentBalance FROM property LEFT JOIN client On property.ClientId = client.id WHERE client.id = '$SessionId' ");
                  $r=$qry->fetch_array();
                  if($r['CurrentBalance'] == NULL){
                    echo 'ZMK 0.00';
                  }else{
                    echo 'ZMK '.$r['CurrentBalance'];
                  }
                  
                   ?>
                </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-university"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Total Properties</span>
                <span class="info-box-number">
                    <?php 
                  $qry = $conn->query("SELECT COUNT(property.ClientId) AS  propertyNum FROM property LEFT JOIN client On property.ClientId = client.id WHERE client.id = '$SessionId' ");
                  $rs = $qry->fetch_array();
                  echo $rs['propertyNum'];?>
                </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-book"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Payments Made</span>
                <span class="info-box-number">
                    <?php  
                  $qry=$conn->query("SELECT FORMAT(SUM(property.AmountPaid),2) AS AmountPaid FROM property LEFT JOIN client On property.ClientId = client.id WHERE client.id = '$SessionId' ");
                  $r=$qry->fetch_array();
                  if($r['AmountPaid'] == NULL){
                    echo 'ZMK 0.00';
                  }else{
                    echo 'ZMK '.$r['AmountPaid'];
                  }?>
                </span>
            </div>
        </div>
    </div>
</div>
<div class="col-12">
    <div class="card">
        <div class="card-body">
            NOTIFICATIONS</b>
        </div>
    </div>
</div>
<!-- Row  -->
<div class="row">
    <!-- Column -->
    <div class="col-md-4 wrap-service5-box">
        <div class="card card-shadow border-0 mb-4">
            <div class="card-body d-flex">
                <div class="">
                    <h6 class="font-weight-medium"><a href="javascript:void(0)" class="linking">New Notification</a>
                    </h6>
                    <p class="mt-3">You can now pay for your properties online.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>