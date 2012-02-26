<?php
if (!defined('APPLICATION'))
    exit();
// Let's get rid of a level of array
$Basic = $EnabledSections['Basic'];

// Check for photo, as it will affect the layout
if (!empty($Photo) && strtolower(substr($Photo, 0, 7)) != 'http://') {
    // if the user has a photo, create the first table 
    ?><table id="photoinfo">
        <tr>
    	<td class="photo"><?php echo $Photo; ?></td>
        </tr>
    </table>
    <table class="hasphoto" id="nameinfo"><?php
} else {
    ?><table id="nameinfo"><?php
} 

$FirstName = $Basic['FirstName'];
$LastName = $Basic['LastName'];
if ($FirstName['Value'] != NULL || $LastName['Value'] != NULL) {
    ?><tr>
    	    <td class="name"><?php echo $FirstName['Value']." ".$LastName['Value'] ?></td>
    </tr><?
}
$NickName = $Basic['NickName'];
    if (!empty($NickName['Value'])) {
    ?><tr>
    	    <td class="nick name"> <?php echo T("A.K.A.") . " " . $NickName['Value']; ?></td>
            </tr><?php 
	    
    } 
	?><tr>
	    <td class="user info">Username: <?php echo anchor('@' . $UserName, 'messages/add/' . $UserName); ?></td>
	</tr>
    </table><?php
    if (!empty($Basic['Quote']['Value'])) {
        ?><table id="quoteinfo">
    	<tr>
    	    <td colspan="3" class="bordertop"></td>
    	</tr>
    	<tr>
    	    <td colspan="3" class="quote info"><?php echo $Basic['Quote']['Value'] ?></td>
    	</tr>
    	<tr>
    	    <td colspan="3" class="borderbottom"></td>
    	</tr>
        </table><?php
}
?><table id = "basicinfo">
<tr>
<td colspan = "2" class = "tablelabel"><h2>Basic Information</h2></td>
</tr>
<tr>
<td colspan = "2" class = "bordertop"></td>
</tr>
<tr>
<?php if (!empty($Basic['Gender']['Value'])) {
    ?>
    <td class="label"><? echo $Basic['Gender']['Label']; ?></td>
<?php } if ($HideBD != '1') { ?>
    <td class="label"><? echo $Basic['Birthday']['Label']; ?></td>
<?php } ?>
</tr>
<tr>
<?php if (!empty($Basic['Gender']['Value'])) { ?>
    <td class="info"><?php echo $Basic['Gender']['Value']; ?></td>
<?php } if ($HideBD != '1') { ?>
    <td class="info"><?php echo $Basic['Birthday']['Value'] ?></td>
<?php } ?>
</tr>
<tr>
    <td colspan="2" class="borderbottom"></td>
</tr>
</table>
<table id="basicinfo">
    <tr>
    <?php if (!empty($Basic['Relationship']['Value'])) { 
	?><td colspan="2" class="label">Relationship Status:</td><?
    }
    ?></tr>
    <tr>
    <?php if (!empty($Basic['Relationship']['Value'])) { 
	?><td colspan="2" class="info"><?php echo $Basic['Relationship']['Value']; ?></td><?
    }
    ?></tr>
    <tr>
	<td colspan="4" class="borderbottom"></td>
    </tr>
</table>
