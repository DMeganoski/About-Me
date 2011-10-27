<?php if (!defined('APPLICATION')) exit();
if(empty($this->AboutMe)) { // if the sender's row in the 'about me' table is empty, tell the user ?>
	<div class="Empty">
		<?php echo "This profile hasn't been set up yet."; ?>
	</div>
<?php
} else {	 // else display the page
	// Define variables for data
	$RealName = $this->AboutMe->RealName;
	$NickName = $this->AboutMe->OtName;
	$Quote = $this->AboutMe->Quote;
	$BD = $this->AboutMe->BD;
	$HideBD = $this->AboutMe->HideBD;
	$HideBY = $this->AboutMe->HideBY;
	$RelationshipStatus = $this->AboutMe->RelStat;
	$Quote = $this->AboutMe->Quote;
	$Location = $this->AboutMe->Loc;
	$Employer = $this->AboutMe->Emp;
	$JobTitle = $this->AboutMe->JobTit;
	$HighSchool = $this->AboutMe->HS;
	$College = $this->AboutMe->Col;
	$Interests = $this->AboutMe->Inter;
	$Music =$this->AboutMe->Mus;
	$Games = $this->AboutMe->Gam;
	$Movies = $this->AboutMe->Mov;
	$TV = $this->AboutMe->TV;
	$Books = $this->AboutMe->Bks;
	$Biography = $this->AboutMe->Bio;
	$UserName = $this->User->Name;
	$Photo = $this->User->Photo;



?>
<div class="aboutme">
<table id="nameinfo">
	<tr>
		<td class="name"><?php echo $this->AboutMe->RealName ?></td>
		<?php if(!empty($this->AboutMe->OtName )){ // if the column OtName isn't empty, display: ?>
		<td class="nick name">A.K.A. <?php echo $this->AboutMe->OtName; ?></td>
		<?php } ?>
	</tr>
</table>
<?php
/*if ($this->User->Photo != '' && strtolower(substr($this->User->Photo, 0, 7)) != 'http://') {
   ?>
   <div class="Photo">
      <?php echo Img('uploads/'.ChangeBasename($this->User->Photo, 'p%s')); ?>
   </div>
   <?php
} */?>
<table id="quoteinfo">
	<tr>
		<td colspan="3" class="bordertop"></td>
	</tr>
	<tr>
		<td colspan="2" class="quote info"><?php echo $this->AboutMe->Quote ?></td>
	</tr>
	<tr>
		<td colspan="3" class="borderbottom"></td>
	</tr>
</table>
<table id="basicinfo">
	<tr>
		<td colspan="3" class="tablelabel"><h2>Basic Information</h2></td>
	</tr>
	<tr>
		<td colspan="3" class="bordertop"></td>
	</tr>
	<tr>
		<?php if ($this->AboutMe->HideBD != '1') { ?>
		<td class="label">Birthday:</td>
		<?php } if(!empty($this->AboutMe->RelStat )) { ?>
		<td class="label">Relationship Status:</td>
		<?php } if(!empty($this->AboutMe->Loc )) { ?>
		<td class="label">Location:</td>
		<?php } ?>
	</tr>
	<tr>
		<?php if ($this->AboutMe->HideBD != '1') { ?>
		<td class="info"><?php
			if ($this->AboutMe->HideBY == '1') {
				$Birthday = Gdn_Format::Date($this->AboutMe->BD, T('Date.DefaultDayFormat', '%B %e'));
			}
			else {
				$Birthday = Gdn_Format::Date($this->AboutMe->BD, T('Date.DefaultFormat', '%B %e, %Y'));
			}
			echo $Birthday ?></td>
		<?php
		}
			if (!empty($this->AboutMe->RelStat )) { ?>
		<td class="info"><?php
			if ($this->AboutMe->RelStat == 's'){
				echo T(Single);
			}else if ($this->AboutMe->RelStat == 'm'){
				echo T(Married);
			}else if ($this->AboutMe->RelStat == 'i'){
				echo T(InRelationship);
			}else if ($this->AboutMe->RelStat == 'd'){
				echo T(Divorced);
			}else if ($this->AboutMe->RelStat == 'w'){
				echo T(Widowed);
			} ?>
		</td>
		<?php } if (!empty($this->AboutMe->Loc )) { ?>
		<td class="info"><?php echo $this->AboutMe->Loc ?></td>
		<?php } ?>
	</tr>
	<tr>
		<td colspan="3" class="borderbottom"></td>
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
		<td class="info"><?php
        		$Bio = str_replace("\n", "<br/>",$this->AboutMe->Bio);
			echo $Bio; ?>
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

