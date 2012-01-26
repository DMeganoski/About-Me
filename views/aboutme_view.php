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
	$WebSite = $this->User->WS;

?>
<div class="aboutme" style="padding:10px;">
<?php if(C('Plugins.AboutMe.UseRealName', TRUE)) { ?>
<div class="aboutme-section">
	Real Name
	<h3><?php echo $this->AboutMe->RealName ?>
	<?php if(C('Plugins.AboutMe.UseRealName', TRUE) && !empty($this->AboutMe->OtName )){ ?>
		<span style="font-size:0.6em">A.K.A. <?php echo $this->AboutMe->OtName; ?><span>
	<?php } ?>
	</h3>
</div>
<?php } ?>


<?php if(C('Plugins.AboutMe.UseQuote', TRUE) && !empty($this->AboutMe->Quote )) { ?>
<div class="aboutme-section">
	Quote
	<h3><?php echo nl2br($this->AboutMe->Quote); ?></h3>
</div>
<?php } ?>

<?php if(C('Plugins.AboutMe.UseWebSite', TRUE) || C('Plugins.AboutMe.UseRelationshipStatus', TRUE) || C('Plugins.AboutMe.UseBirthday', TRUE) || C('Plugins.AboutMe.UseLocation', TRUE)) { ?>
<div class="aboutme-section">
<h2>Basic Information</h2>

	<?php if (C('Plugins.AboutMe.UseBirthday', TRUE) && $this->AboutMe->HideBD != '1') { ?>
		Birthday
		<h3><?php if ($this->AboutMe->HideBY == '1') {
			$Birthday = Gdn_Format::Date($this->AboutMe->BD, T('Date.DefaultDayFormat', '%B %e'));
		} else {
			$Birthday = Gdn_Format::Date($this->AboutMe->BD, T('Date.DefaultFormat', '%B %e, %Y'));
		}
		echo $Birthday ?></h3>
	<?php } ?>
		
	<?php if(C('Plugins.AboutMe.UseRelationshipStatus', TRUE) && !empty($this->AboutMe->RelStat )) { ?>
		Relationship Status
		<h3><?php
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
		</h3>
	<?php } ?>
			
	<?php if(C('Plugins.AboutMe.UseLocation', TRUE) && !empty($this->AboutMe->Loc )) { ?>
		Location<h3><?php echo $this->AboutMe->Loc ?></h3>
	<?php } ?>
		
	<?php if(C('Plugins.AboutMe.UseWebSite', TRUE) && !empty($this->AboutMe->WS )) { ?>
		WebSite<h3><a href="<?php echo $this->AboutMe->WS ?>" target="_blank"><?php echo $this->AboutMe->WS ?></a></h3>
	<?php } ?>
</div>
<?php } ?>


<?php if(C('Plugins.AboutMe.UseBio', TRUE) && !empty($this->AboutMe->Bio)) { ?>
	<div class="aboutme-section">
		<h2>Biography</h2>
		<h3><?php echo nl2br($this->AboutMe->Bio); ?></h3>
	</div>
<?php } ?>

<?php if(C('Plugins.AboutMe.UseEmployer', TRUE) || C('Plugins.AboutMe.UseJobTitle', TRUE)) { ?>
<div class="aboutme-section">
	<h2>Career</h2>

	<?php if(C('Plugins.AboutMe.UseEmployer', TRUE) && !empty($this->AboutMe->Emp )) { ?>
		Employer
		<h3><?php echo $this->AboutMe->Emp ?></h3>
	<?php } ?>
			
	<?php if(C('Plugins.AboutMe.UseJobTitle', TRUE) && !empty($this->AboutMe->JobTit )) { ?>
		Job Title
		<h3><?php echo $this->AboutMe->JobTit ?></h3>
	<?php } ?>

</div>
<?php } ?>


<?php if(C('Plugins.AboutMe.UseHighSchool', TRUE) || C('Plugins.AboutMe.UseCollege', TRUE)) { ?>
<div class="aboutme-section">
	<h2>Education</h2>
	
		<?php if(C('Plugins.AboutMe.UseHighSchool', TRUE) && !empty($this->AboutMe->HS )) { ?>
			High School
			<h3><?php echo $this->AboutMe->HS ?></h3>
		<?php } ?>
			
		<?php if(C('Plugins.AboutMe.UseCollege', TRUE) && !empty($this->AboutMe->Col )) { ?>
			College
			<h3><?php echo $this->AboutMe->Col ?></h3>
		<?php } ?>
		
</div>
<?php } ?>



<?php if(C('Plugins.AboutMe.UseInter', TRUE) || C('Plugins.AboutMe.UseMus', TRUE) || C('Plugins.AboutMe.UseGam', TRUE) || C('Plugins.AboutMe.UseMov', TRUE) || C('Plugins.AboutMe.UseTV', TRUE) || C('Plugins.AboutMe.UseBks', TRUE)) { ?>
<div class="aboutme-section">
	<h2>Interests</h2>

	<?php if(C('Plugins.AboutMe.UseInter', TRUE) && !empty($this->AboutMe->Inter )) { ?>
		Interests
		<h3><?php echo $this->AboutMe->Inter ?></h3>
	<?php } ?>
		
	<?php if( C('Plugins.AboutMe.UseMus', TRUE) && !empty($this->AboutMe->Mus )) { ?>
		Music
		<h3><?php echo $this->AboutMe->Mus ?></h3>
	<?php } ?>
		
	<?php if(C('Plugins.AboutMe.UseGam', TRUE) && !empty($this->AboutMe->Gam )) { ?>
		Games
		<h3><?php echo $this->AboutMe->Gam ?></h3>
	<?php } ?>
		
	<?php if(C('Plugins.AboutMe.UseMov', TRUE) && !empty($this->AboutMe->Mov )) { ?>
		Movies
		<h3><?php echo $this->AboutMe->Mov ?></h3>
	<?php } ?>
		
	<?php if(C('Plugins.AboutMe.UseTV', TRUE) && !empty($this->AboutMe->TV )) { ?>
		Television
		<h3><?php echo $this->AboutMe->TV ?></h3>
	<?php } ?>
		
	<?php if(C('Plugins.AboutMe.UseBks', TRUE) && !empty($this->AboutMe->Bks )) { ?>
		Books
		<h3><?php echo $this->AboutMe->Bks ?></h3>
	<?php } ?>
	
</div>
<?php } ?>


<?php
$this->FireEvent('AboutPageBoxAfter');
?>
</div>
<?php }

