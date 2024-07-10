<?php include'db_connect.php';

	$qry = $conn->query("SELECT 
	`client`.`id`
	,`client`.`ClientName`
    , `client`.`IdentityType`
    , `client`.`ClientID`
    , `client`.`PostalAddress`
    , `client`.`PhysicalAddress`
    , `client`.`Mobile`
    , `client`.`Email`
    , `client`.`AdditionalInformation`
	,`client_type`.`ClientType`
	FROM client LEFT JOIN `client_type` 
        ON (`client_type`.`id` = `client`.`ClientType`) WHERE client.id= '$SessionId' ");
	$row= $qry->fetch_assoc();
?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary update_client" href="./index.php?page=update&data-id=<?php echo $row['id'] ?>"><i class="fa fa-edit"></i> Update Details</a>
			</div>
		</div>
		<div class="card-body">
<table style="width: 100%">
<tr><th>Client ID#</th><td><?php if($row['IdentityType'] == '1'){echo 'ID TYPE: NRC - '.$row['ClientID'];
}elseif($row['IdentityType'] == '2'){echo 'ID Type: PASSPORT - '.$row['ClientID'];
}elseif($row['IdentityType'] == '3'){echo 'ID Type: = DRIVER\'\S LICENSE - '.$row['ClientID'];
}elseif($row['IdentityType'] == '4'){echo 'ID Type: VOTER\'\S VOTER - '.$row['ClientID'];}else{echo 'ID Type: PACRA/COMPANY - '.$row['ClientID'];}?></td></tr>
<tr><th>Client Type</th><td><?php echo $row['ClientType'];?></td></tr>
<tr><th>Client Name</th><td><?php echo $row['ClientName'];?></td></tr>
<tr><th>Client Contact Number</th><td><?php echo $row['Mobile'];?></td></tr>
<tr><th>Client Contact Email</th><td><?php echo $row['Email'];?></td></tr>
<tr><th>Client Physical Address</th><td><?php echo $row['PhysicalAddress'];?></td></tr>
<tr><th>Client Physical Address</th><td><?php echo $row['PostalAddress'];?></td></tr>
<tr><th>Client Additional Infor</th><td><?php echo $row['AdditionalInformation'];?></td></tr>
</table>
		
		</div>
	</div>
</div>