<?php include'db_connect.php' ?>
<div class="col-lg-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <div class="card-tools">
                <a class="btn btn-block btn-sm btn-default btn-flat border-primary " ><i class="fa fa-plus"></i> New</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table tabe-hover table-bordered" id="list">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Property</th>
                        <th>Property#</th>
                        <th>Property Value</th>
                        <th>Amount Paid</th>
                        <th>Balance</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
					$i = 1;
					$qry = $conn->query("SELECT `property`.`id` AS id, 
					`property`.`Property`,
					`property`.`PropertyId`,
					FORMAT(`property`.`AmountPayable`,2) AS AmountPayable,
					FORMAT(`property`.`AmountPaid`,2) AS AmountPaid,
					FORMAT(`property`.`CurrentBalance`,2) AS CurrentBalance,
					property.Status
					FROM property LEFT JOIN client On property.ClientId = client.id WHERE client.id = '$SessionId' AND  property.Status = '1' ");
					while($row= $qry->fetch_assoc()):
					?>
                    <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo $row['Property'] ?></td>
                        <td><?php echo $row['PropertyId'] ?></td>
                        <td>ZMK <?php echo $row['AmountPayable'] ?></td>
                        <td>ZMK <?php echo $row['AmountPaid'] ?></td>
                        <td>ZMK <?php echo $row['CurrentBalance'] ?></td>
                        <td class="text-center">
						<div class="btn-group">
                                <a href="./index.php?page=property_details&proId=<?php echo $row['PropertyId'] ?>"
                                    class="btn btn-primary btn-flat make_payment">VIEW
                                </a>
                            </div>
                            <div class="btn-group">
                                <a href="./index.php?page=step1&proId=<?php echo $row['PropertyId'] ?>"
                                    class="btn btn-success btn-flat make_payment">PAY
                                </a>
                            </div>
                            <div class="btn-group">
							<a href="./index.php?page=manage_property&proId=<?php echo $row['PropertyId'] ?>"
                                    class="btn btn-warning btn-flat make_payment">REMOVE
                                </a>
                            </div>
        </div>
        </td>
        </tr>
        <?php endwhile; ?>
        </tbody>
        </table>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#list').dataTable()
    $('.new_class').click(function() {
        uni_modal("New Property", "new_property.php")
    })
    $('.manage_property').click(function() {
        uni_modal("Manage Property", "manage_property.php?id=" + $(this).attr('data-id'))
    })
    $('.delete_class').click(function() {
        _conf("Are you sure to delete this class?", "delete_class", [$(this).attr('data-id')])
    })
})

function delete_class($id) {
    start_load()
    $.ajax({
        url: 'ajax.php?action=delete_class',
        method: 'POST',
        data: {
            id: $id
        },
        success: function(resp) {
            if (resp == 1) {
                alert_toast("Data successfully deleted", 'success')
                setTimeout(function() {
                    location.reload()
                }, 1500)

            }
        }
    })
}
</script>