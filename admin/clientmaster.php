<?php
namespace PHPMaker2020\revenue;
?>
<?php if ($client->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_clientmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($client->id->Visible) { // id ?>
		<tr id="r_id">
			<td class="<?php echo $client->TableLeftColumnClass ?>"><?php echo $client->id->caption() ?></td>
			<td <?php echo $client->id->cellAttributes() ?>>
<span id="el_client_id">
<span<?php echo $client->id->viewAttributes() ?>><?php echo $client->id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($client->ClientName->Visible) { // ClientName ?>
		<tr id="r_ClientName">
			<td class="<?php echo $client->TableLeftColumnClass ?>"><?php echo $client->ClientName->caption() ?></td>
			<td <?php echo $client->ClientName->cellAttributes() ?>>
<span id="el_client_ClientName">
<span<?php echo $client->ClientName->viewAttributes() ?>><?php echo $client->ClientName->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($client->ClientType->Visible) { // ClientType ?>
		<tr id="r_ClientType">
			<td class="<?php echo $client->TableLeftColumnClass ?>"><?php echo $client->ClientType->caption() ?></td>
			<td <?php echo $client->ClientType->cellAttributes() ?>>
<span id="el_client_ClientType">
<span<?php echo $client->ClientType->viewAttributes() ?>><?php echo $client->ClientType->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($client->IdentityType->Visible) { // IdentityType ?>
		<tr id="r_IdentityType">
			<td class="<?php echo $client->TableLeftColumnClass ?>"><?php echo $client->IdentityType->caption() ?></td>
			<td <?php echo $client->IdentityType->cellAttributes() ?>>
<span id="el_client_IdentityType">
<span<?php echo $client->IdentityType->viewAttributes() ?>><?php echo $client->IdentityType->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($client->ClientID->Visible) { // ClientID ?>
		<tr id="r_ClientID">
			<td class="<?php echo $client->TableLeftColumnClass ?>"><?php echo $client->ClientID->caption() ?></td>
			<td <?php echo $client->ClientID->cellAttributes() ?>>
<span id="el_client_ClientID">
<span<?php echo $client->ClientID->viewAttributes() ?>><?php echo $client->ClientID->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($client->Surname->Visible) { // Surname ?>
		<tr id="r_Surname">
			<td class="<?php echo $client->TableLeftColumnClass ?>"><?php echo $client->Surname->caption() ?></td>
			<td <?php echo $client->Surname->cellAttributes() ?>>
<span id="el_client_Surname">
<span<?php echo $client->Surname->viewAttributes() ?>><?php echo $client->Surname->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($client->FirstName->Visible) { // FirstName ?>
		<tr id="r_FirstName">
			<td class="<?php echo $client->TableLeftColumnClass ?>"><?php echo $client->FirstName->caption() ?></td>
			<td <?php echo $client->FirstName->cellAttributes() ?>>
<span id="el_client_FirstName">
<span<?php echo $client->FirstName->viewAttributes() ?>><?php echo $client->FirstName->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($client->MiddleName->Visible) { // MiddleName ?>
		<tr id="r_MiddleName">
			<td class="<?php echo $client->TableLeftColumnClass ?>"><?php echo $client->MiddleName->caption() ?></td>
			<td <?php echo $client->MiddleName->cellAttributes() ?>>
<span id="el_client_MiddleName">
<span<?php echo $client->MiddleName->viewAttributes() ?>><?php echo $client->MiddleName->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($client->Gender->Visible) { // Gender ?>
		<tr id="r_Gender">
			<td class="<?php echo $client->TableLeftColumnClass ?>"><?php echo $client->Gender->caption() ?></td>
			<td <?php echo $client->Gender->cellAttributes() ?>>
<span id="el_client_Gender">
<span<?php echo $client->Gender->viewAttributes() ?>><?php echo $client->Gender->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($client->MaritalStatus->Visible) { // MaritalStatus ?>
		<tr id="r_MaritalStatus">
			<td class="<?php echo $client->TableLeftColumnClass ?>"><?php echo $client->MaritalStatus->caption() ?></td>
			<td <?php echo $client->MaritalStatus->cellAttributes() ?>>
<span id="el_client_MaritalStatus">
<span<?php echo $client->MaritalStatus->viewAttributes() ?>><?php echo $client->MaritalStatus->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($client->DateOfBirth->Visible) { // DateOfBirth ?>
		<tr id="r_DateOfBirth">
			<td class="<?php echo $client->TableLeftColumnClass ?>"><?php echo $client->DateOfBirth->caption() ?></td>
			<td <?php echo $client->DateOfBirth->cellAttributes() ?>>
<span id="el_client_DateOfBirth">
<span<?php echo $client->DateOfBirth->viewAttributes() ?>><?php echo $client->DateOfBirth->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($client->TownOrVillage->Visible) { // TownOrVillage ?>
		<tr id="r_TownOrVillage">
			<td class="<?php echo $client->TableLeftColumnClass ?>"><?php echo $client->TownOrVillage->caption() ?></td>
			<td <?php echo $client->TownOrVillage->cellAttributes() ?>>
<span id="el_client_TownOrVillage">
<span<?php echo $client->TownOrVillage->viewAttributes() ?>><?php echo $client->TownOrVillage->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($client->Mobile->Visible) { // Mobile ?>
		<tr id="r_Mobile">
			<td class="<?php echo $client->TableLeftColumnClass ?>"><?php echo $client->Mobile->caption() ?></td>
			<td <?php echo $client->Mobile->cellAttributes() ?>>
<span id="el_client_Mobile">
<span<?php echo $client->Mobile->viewAttributes() ?>><?php echo $client->Mobile->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($client->_Email->Visible) { // Email ?>
		<tr id="r__Email">
			<td class="<?php echo $client->TableLeftColumnClass ?>"><?php echo $client->_Email->caption() ?></td>
			<td <?php echo $client->_Email->cellAttributes() ?>>
<span id="el_client__Email">
<span<?php echo $client->_Email->viewAttributes() ?>><?php echo $client->_Email->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($client->NextOfKin->Visible) { // NextOfKin ?>
		<tr id="r_NextOfKin">
			<td class="<?php echo $client->TableLeftColumnClass ?>"><?php echo $client->NextOfKin->caption() ?></td>
			<td <?php echo $client->NextOfKin->cellAttributes() ?>>
<span id="el_client_NextOfKin">
<span<?php echo $client->NextOfKin->viewAttributes() ?>><?php echo $client->NextOfKin->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($client->NextOfKinMobile->Visible) { // NextOfKinMobile ?>
		<tr id="r_NextOfKinMobile">
			<td class="<?php echo $client->TableLeftColumnClass ?>"><?php echo $client->NextOfKinMobile->caption() ?></td>
			<td <?php echo $client->NextOfKinMobile->cellAttributes() ?>>
<span id="el_client_NextOfKinMobile">
<span<?php echo $client->NextOfKinMobile->viewAttributes() ?>><?php echo $client->NextOfKinMobile->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($client->NextOfKinEmail->Visible) { // NextOfKinEmail ?>
		<tr id="r_NextOfKinEmail">
			<td class="<?php echo $client->TableLeftColumnClass ?>"><?php echo $client->NextOfKinEmail->caption() ?></td>
			<td <?php echo $client->NextOfKinEmail->cellAttributes() ?>>
<span id="el_client_NextOfKinEmail">
<span<?php echo $client->NextOfKinEmail->viewAttributes() ?>><?php echo $client->NextOfKinEmail->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>