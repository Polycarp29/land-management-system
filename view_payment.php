<?php include'db_connect.php' ?>
<style>
.text-danger strong {
    color: #9f181c;
}

.receipt-main {
    background: #ffffff none repeat scroll 0 0;
    border-bottom: 12px solid #333333;
    border-top: 12px solid #9f181c;
    margin-top: 50px;
    margin-bottom: 50px;
    padding: 40px 30px !important;
    position: relative;
    box-shadow: 0 1px 21px #acacac;
    color: #333333;
    font-family: open sans;
}

.receipt-main p {
    color: #333333;
    font-family: open sans;
    line-height: 1.42857;
}

.receipt-footer h1 {
    font-size: 15px;
    font-weight: 400 !important;
    margin: 0 !important;
}

.receipt-main::after {
    background: #414143 none repeat scroll 0 0;
    content: "";
    height: 5px;
    left: 0;
    position: absolute;
    right: 0;
    top: -13px;
}

.receipt-main thead {
    background: #414143 none repeat scroll 0 0;
}

.receipt-main thead th {
    color: #fff;
}

.receipt-right h5 {
    font-size: 16px;
    font-weight: bold;
    margin: 0 0 7px 0;
}

.receipt-right p {
    font-size: 12px;
    margin: 0px;
}

.receipt-right p i {
    text-align: center;
    width: 18px;
}

.receipt-main td {
    padding: 9px 20px !important;
}

.receipt-main th {
    padding: 13px 20px !important;
}

.receipt-main td {
    font-size: 18px;
    font-weight: initial !important;
}

.receipt-main td p:last-child {
    margin: 0;
    padding: 0;
}

.receipt-main td h2 {
    font-size: 20px;
    font-weight: 900;
    margin: 0;
    text-transform: uppercase;
}

.receipt-header-mid .receipt-left h1 {
    font-weight: 100;
    margin: 34px 0 0;
    text-align: center;
    text-transform: uppercase;
}

.receipt-header-mid {
    margin: 24px 0;
    overflow: hidden;
}

#container {
    background-color: #dcdcdc;
}

table {
    border-color: black;
    width: 100%;
}

@media print {
    table {
        border-color: grey;
        width: 100%;
    }

    .receipt-footer {
        padding-top: 50px;
    }

    receipt-main thead {
        background: #414143 none repeat scroll 0 0;
    }
}
</style>
<?php
$payId = $_GET['payId'];
$qry = $conn->query("SELECT
`client`.`ClientName`
, `client`.`ClientID`
, `client`.`Mobile`
, `client`.`Email`
, `property`.`Property`
, `property`.`PropertyId`
, `property`.`Location`
, `property`.`PropertyUse`
, `charges`.`ChargeDesc`
, `property`.`ChargeableFee`
, `property`.`BalanceBF`
, `property`.`AmountPayable`
, `property_revenu`.`id`
, FORMAT(`property_revenu`.`AmountPayable`, 2) AS AmountPayable
, FORMAT(`property_revenu`.`AmountPaid`, 2) AS AmountPaid
, FORMAT(`property_revenu`.`Balance`, 2) AS Balance
, `property_revenu`.`ClientProperty`
, `charge_group`.`ChargeGroupName`
, DATE_FORMAT(`property_revenu`.`date`, '%D %M, %Y') AS date
FROM
`client`
LEFT JOIN `property` 
    ON (`client`.`id` = `property`.`ClientId`)
LEFT JOIN `charges` 
    ON (`charges`.`ChargeDesc` = `property`.`ChargeGroup`)
LEFT JOIN `charge_group` 
    ON (`charge_group`.`ChargeGroupCode` = `charges`.`ChargeGroup`)
LEFT JOIN `property_revenu` 
    ON (`property_revenu`.`ClientProperty` = `property`.`id`) WHERE `property_revenu`.`id` = '$payId' ");
$rs = $qry->fetch_array();
?>
<div class="col-lg-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <div class="card-tools">
                <a class="btn btn-block btn-sm btn-default btn-flat border-primary update_client"
                    onclick="print_div()"><i class="fa fa-print"></i>PRINT</a>
            </div>
        </div>
        <div class="card-body" id="print_div">
            <div class="row">

                <div class="receipt-main col-xs-12 col-sm-12 col-md-12 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                    <h3>
                        <center>LAND/PROPERTY RATES DEPARTMENT</center>
                    </h3>
                    <div class="row">
                        <div class="receipt-header receipt-header-mid">
                            <div class="col-xs-12 col-sm-12 col-md-12text-left">
                                <div class="receipt-right">
                                    <h5>CLIENT NUMBER.: <?php echo $rs['ClientName'];?> </h5>
                                    <h5>CLIENT NAME.: <?php echo $rs['ClientID'];?> </h5>
                                    <h5>PAYMENT DATE.: <?php echo $rs['date'];?> </h5>
                                    <h5>RECEIPT NUMBER: <?php echo $rs['id'];?> </h5>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="receipt-left">
                                    <h1>Payment Receipt</h1>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <table width="100%" style="border-color: #e4dddd;" border="1">
                            <thead style="background-color: #414143; color:#fff">
                                <tr>
                                    <th style="background-color: #414143; text-align:center;">Property Desc</th>
                                    <th style="background-color: #414143; text-align:center;">Property Num</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="padding-left:20px;"><?php echo $rs['Property'];?></td>
                                    <td style="text-align:right; padding-right:20px;"><?php echo $rs['PropertyId'];?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right" style="padding-right:20px;">
                                        <strong>Amount Due: </strong>
                                    </td>
                                    <td style="text-align:right; padding-right:20px;">
                                        <strong><i class="fa fa-inr"></i>ZMK
                                            <?php echo $rs['AmountPayable'];?></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right" style="padding-right:20px;">
                                        <strong>Amount Paid: </strong>
                                    </td>
                                    <td style="text-align:right; padding-right:20px;">
                                        <strong><i class="fa fa-inr"></i>ZMK
                                            <?php echo $rs['AmountPaid'];?></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right" style="padding-right:20px;">
                                        <strong>Balance Due: </strong>
                                    </td>
                                    <td style="text-align:right; padding-right:20px;">
                                        <strong><i class="fa fa-inr"></i>ZMK <?php echo $rs['Balance'];?></strong>
                                    </td>
                                </tr>
                                <tr>

                                    <td class="text-right" style="border-bottom: none; padding-right:20px;">
                                        <strong>Total: </strong>
                                    </td>
                                    <td class="text-right text-danger" style="padding-right:20px;">
                                        <strong><i class="fa fa-inr"></i>ZMK
                                            <?php echo $rs['AmountPaid'];?></strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div><br />

                    <div class="footer-text">
                        <hr style="border-style:dotted; border-color: black;" />
                        <p>
                            <center>&copy;2021, LAND/PROPERTY RATES DEPARTMENT</center>
                        </p>
                        <i>
                            <center>You can print this receipt and present it as proof od payment. THANK YOU.</center>
                        </i>
                    </div>
                    <div class="row">
                        <div class="receipt-header receipt-header-mid receipt-footer">
                            <div class="col-xs-12 col-sm-12 col-md-12text-left">
                                <div class="receipt-right">
                                    <p><b>Date Printed:</b> <?php echo date('d M, Y');?></p>
                                    <h5 style="color: rgb(140, 140, 140);">Thank you for your business!</h5>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="receipt-left">
                                    <!--<h5>Signature</h5>-->
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function print_div(div) {
    var restorepage = document.body.innerHTML;
    var printDiv = document.getElementById("print_div").innerHTML;

    document.body.innerHTML = printDiv;
    window.print();
    document.body.innerHTML = restorepage;
}
</script>