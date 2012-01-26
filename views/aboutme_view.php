<?php if (!defined('APPLICATION')) exit();
if(empty($this->AboutMe)) { // if the sender's row in the 'about me' table is empty, tell the user ?>
	<div class="Empty">
		<?php echo "This profile hasn't been set up yet."; ?>
	</div>
<?php
} else {	 // else display the page
	// Define variables for data
	$FirstName = $this->AboutMe->RealName;
	$NickName = $this->AboutMe->OtName;
	$Quote = $this->AboutMe->Quote;
	if ($this->AboutMe->HideBY == '1') {
		$Birthday = Gdn_Format::Date($this->AboutMe->BD, T('Date.DefaultDayFormat', '%B %e')); }
	else {
		$Birthday = Gdn_Format::Date($this->AboutMe->BD, T('Date.DefaultFormat', '%B %e, %Y')); }
	$HideBD = $this->AboutMe->HideBD;
	$HideBY = $this->AboutMe->HideBY;
	if ($this->AboutMe->RelStat == 's'){ $RelationshipStatus = T(Single); }
		else if ($this->AboutMe->RelStat == 'm'){ $RelationshipStatus = T(Married); }
		else if ($this->AboutMe->RelStat == 'i'){ $RelationshipStatus = T(InRelationship); }
		else if ($this->AboutMe->RelStat == 'd'){ $RelationshipStatus = T(Divorced); }
		else if ($this->AboutMe->RelStat == 'w'){ $RelationshipStatus = T(Widowed); }
	$Location = $this->AboutMe->Loc;
	$Employer = $this->AboutMe->Emp;
	$Position = $this->AboutMe->JobTit;
	$HighSchool = $this->AboutMe->HS;
	$College = $this->AboutMe->Col;
	$Interests = $this->AboutMe->Inter;
	$Music =$this->AboutMe->Mus;
	$Games = $this->AboutMe->Gam;
	$Movies = $this->AboutMe->Mov;
	$TV = $this->AboutMe->TV;
	$Books = $this->AboutMe->Bks;
	$Biography = str_replace("\n", "<br/>",$this->AboutMe->Bio);
	$UserName = $this->User->Name;
	if (strtolower(substr($this->User->Photo, 0, 7)) != 'http://') {
		$Photo = Img('uploads/'.ChangeBasename($this->User->Photo, 'p%s')); }
	else if (strtolower(substr($$this->User->Photo, 0, 7)) == 'http://') {
		$Photo = Img($this->User->Photo); }
	if ($this->User->Gender == 'm') {
		$Gender = T(Male); }
	else if ($this->User->Gender == 'f') {
		$Gender = T(Female); }
	?>

<div class="aboutme">
<?php
	if (!empty($Photo) && strtolower(substr($Photo, 0, 7)) != 'http://') { ?>
	<table id="photoinfo">
		<tr>
			<td class="photo"><?php echo $Photo; ?></td>
	</tr>
</table>
<table class="hasphoto" id="nameinfo">
<?php } else { ?>
<table id="nameinfo"> <?php } ?>
	<?php if(!empty($FirstName)){  ?>
	<tr>
		<td class="name"><?php echo $FirstName ?></td>
	</tr><?php } ?>
	<?php if(!empty($NickName )){ // if the column OtName isn't empty, display: ?>
	<tr>
		<td class="nick name">A.K.A. <?php echo $NickName; ?></td>
	</tr><?php } ?>
	<tr>
		<td class="user info">Username: <?php echo anchor('@'.$UserName, 'messages/add/'.$UserName);?></td>
	</tr>
</table>
<?php if(!empty($Quote)){  ?>
<table id="quoteinfo">
	<tr>
		<td colspan="3" class="bordertop"></td>
	</tr>
	<tr>
		<td colspan="3" class="quote info"><?php echo $this->AboutMe->Quote ?></td>
	</tr>
	<tr>
		<td colspan="3" class="borderbottom"></td>
	</tr>
</table><?php } ?>
<table id="basicinfo">
	<tr>
		<td colspan="2" class="tablelabel"><h2>Basic Information</h2></td>
	</tr>
	<tr>
		<td colspan="2" class="bordertop"></td>
	</tr>
	<tr>
		<?php  if(!empty($Gender)) { ?>
		<td class="label">Gender:</td>
		<?php } if ($HideBD != '1') { ?>
		<td class="label">Birthday:</td>
		<?php } ?>
	</tr>
	<tr>
		<?php if (!empty($Gender)) { ?>
		<td class="info"><?php echo $Gender; ?></td>
		<?php } if ($HideBD != '1') { ?>
		<td class="info"><?php	echo $Birthday ?></td>
		<?php } ?>
	</tr>
	<tr>
		<td colspan="2" class="borderbottom"></td>
	</tr>
</table>
<table id="basicinfo">
	<tr>
		<?php if(!empty($RelationshipStatus)) { ?>
		<td colspan="2" class="label">Relationship Status:</td>
		<?php } if(!empty($Location)) { ?>
		<td colspan="2" class="label">Location:</td>
		<?php } ?>
	</tr>
	<tr>
		<?php if (!empty($RelationshipStatus)) { ?>
		<td colspan="2" class="info"><?php echo $RelationshipStatus; ?></td>
		<?php } if (!empty($Location)) { ?>
		<td colspan="2" class="info"><?php echo $Location ?></td>
		<?php } ?>
	</tr>
	<tr>
		<td colspan="4" class="borderbottom"></td>
	</tr>
</table>
<?php if(!empty($this->AboutMe->Bio)) { ?>
<table id="bioinfo">
	<tr>
		<td class="tablelabel"><h2>Biography</h2></td>
	</tr>
	<tr>
		<td class="bordertop"></td>
	</tr>
	<tr>
		<td class="info"><?php 	echo $Biography; ?>
		</td>
	</tr>
	<tr>
		<td class="borderbottom"></td>
	</tr>
</table>
<?php } ?>
<table id="carinfo">
	<tr>
		<td colspan="3" class=tablelabel><h2>Career</h2></td>
	</tr>
	<tr>
		<td colspan="3" class="bordertop"></td>
	</tr>
	<tr>
		<?php if(!empty($this->AboutMe->Emp )) { ?>
		<td class="label">Employer:</td>
		<?php } if(!empty($this->AboutMe->JobTit )) { ?>
		<td class="label">Job Title:</td>
		<?php } ?>
	</tr>
	<tr>
		<?php if(!empty($this->AboutMe->Emp )) { ?>
		<td class="info"><?php echo $this->AboutMe->Emp ?></td>
		<?php } if(!empty($this->AboutMe->JobTit )) { ?>
		<td class="info"><?php echo $this->AboutMe->JobTit ?></td>
		<?php } ?>
	</tr>
	<tr>
		<td colspan="3" class="borderbottom"></td>
	</tr>
</table>
<table id="eduinfo">
	<tr>
		<td colspan="3" class="tablelabel"><h2>Education</h2></td>
	</tr>
	<tr>
		<td colspan="3" class="bordertop"></td>
	</tr>
	<tr>
		<?php if(!empty($this->AboutMe->HS )) { ?>
		<td class="label">High School:</td>
		<?php } if(!empty($this->AboutMe->Col )) { ?>
		<td class="label">College:</td>
		<?php } ?>
	</tr>
	<tr>
		<?php if(!empty($this->AboutMe->HS )) { ?>
		<td class="info"><?php echo $this->AboutMe->HS ?></td>
		<?php } if(!empty($this->AboutMe->Col )) { ?>
		<td class="info"><?php echo $this->AboutMe->Col ?></td>
		<?php } ?>
	</tr>
	<tr>
		<td colspan="3" class="borderbottom"></td>
	</tr>
</table>

<table id="interinfo">
	<tr>
		<td colspan="3" class=tablelabel><h2>Interests</h2></td>
	</tr>
	<tr>
		<td colspan="3" class="bordertop"></td>
	</tr>
	<?php if(!empty($this->AboutMe->Inter )) { ?>
	<tr>
		<td class="label">Interests:</td>
	</tr>
	<tr>
		<td class="info"><?php echo $this->AboutMe->Inter ?></td>
	</tr>
	<?php } if(!empty($this->AboutMe->Mus )) { ?>
	<tr>
		<td class="label">Music:</td>
	</tr>
	<tr>
		<td class="info"><?php echo $this->AboutMe->Mus ?></td>
	</tr>
	<?php } if(!empty($this->AboutMe->Gam )) { ?>
	<tr>
		<td class="label">Games:</td>
	</tr>
	<tr>
		<td class="info"><?php echo $this->AboutMe->Gam ?></td>
	</tr>
	<?php } if(!empty($this->AboutMe->Mov )) { ?>
	<tr>
		<td class="label">Movies:</td>
	</tr>
	<tr>
		<td class="info"><?php echo $this->AboutMe->Mov ?></td>
	</tr>
	<?php } if(!empty($this->AboutMe->TV )) { ?>
	<tr>
		<td class="label">Television:</td>
	</tr>
	<tr>
		<td class="info"><?php echo $this->AboutMe->TV ?></td>
	</tr>
	<?php } if(!empty($this->AboutMe->Bks )) { ?>
	<tr>
		<td class="label">Books:</td>
	</tr>
	<tr>
		<td class="info"><?php echo $this->AboutMe->Bks ?></td>
	</tr>
	<?php } ?>
	<tr>
		<td class="borderbottom"></td>
	</tr>
</table>
<?php
$this->FireEvent('AboutPageBoxAfter');
?>
</div>
<?php }

