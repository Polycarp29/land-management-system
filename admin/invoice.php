<?php
namespace PHPMaker2020\revenue;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$invoice = new invoice();

// Run the page
$invoice->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>
<div class="btn-group">
    <a href="allBills.php?" class="btn btn-primary btn-flat make_payment">PRINT ALL BILLS
    </a>
</div>
<table class="table table-striped table-bordered" cellspacing="0" width="100%" id="myDataTable">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Client Number</th>
            <th>Client Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
			  $sql="SELECT * FROM client";
   			  $rows = ExecuteRows($sql);
			  $i = 1;
   			  foreach ($rows as $row){					
			  ?>
        <tr>
            <td><?php echo $i++ ?></td>
            <td><?php echo $row['ClientID']; ?></td>
            <td><?php echo $row['ClientName']; ?></td>
            <td class="text-center">
                <div class="btn-group">
                    <a href="printInvoice.php?Id=<?php echo $row['id']; ?>"
                        class="btn btn-primary btn-flat make_payment">PRINT BILL
                    </a>
                </div>
                </div>
            </td>
        </tr>
        <?php }?>
    </tbody>
</table>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$invoice->terminate();
?>