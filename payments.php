<?php include'db_connect.php' ?>
<div class="col-lg-12">
    <div class="card card-outline card-primary">
        <div class="card-body">
            <table class="table tabe-hover table-bordered" id="list">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Property</th>
                        <th>Property #</th>
                        <th>Amount Paid</th>
                        <th>Balance Due</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
					$i = 1;
					$qry = $conn->query("SELECT
					`property`.`PropertyId`,
					`property_revenu`.`id`,
					`property_revenu`.`PropertyUse`,
					DATE_FORMAT(`property_revenu`.`date`, '%D %M, %Y') AS date,
					`property`.`Property`,
				   FORMAT(`property_revenu`.`AmountPaid`,2) AS AmountPaid,
				   FORMAT(`property_revenu`.`Balance`,2) AS Balance
				   FROM property_revenu LEFT JOIN property ON `property`.`PropertyId` = `property_revenu`.`PropertyId` LEFT JOIN `client` ON property.ClientId = client.id WHERE client.id = '$SessionId' ");
					while($row= $qry->fetch_assoc()):
					?>
                    <tr>
                        <td class="text-center"><?php echo $i++ ?></td>
                        <td><?php echo $row['Property'] ?></td>
                        <td><?php echo $row['PropertyId'] ?></td>
                        <td>ZMK <?php echo $row['AmountPaid'] ?></td>
                        <td>ZMK <?php echo $row['Balance'] ?></td>
                        <td><?php echo $row['date'] ?></td>
                        <td class="text-center">
                            <!--<div class="btn-group">
                                <a href="./index.php?page=make_payment&proId=<?php //echo $row['PropertyId'] ?>"
                                    class="btn btn-primary btn-flat make_payment">PAY
                                </a>
                            </div>-->
							<div class="btn-group">
                                <a href="./index.php?page=view_payment&payId=<?php echo $row['id'] ?>"
                                    class="btn btn-primary btn-flat print_payment">RECEIPT
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#list').dataTable();
})
</script>