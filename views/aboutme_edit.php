<?php if (!defined('APPLICATION')) exit(); ?>
<?php
// Initialize the Form
echo $this->Form->Open();
echo $this->Form->Errors();

// Define Lists

	$RelationshipData = $this->RelationshipData = array(
		'p' => T('PickOne'),
		's' => T('Single'),
		'm' => T('Married'),
		'i' => T('InRelationship'),
		'd' => T('Divorced'),
		'w' => T('Widowed'),
	);

// Display the form
?>
<?php if(C('Plugins.AboutMe.UseRealName', TRUE) || C('Plugins.AboutMe.UseNickName', TRUE) || C('Plugins.AboutMe.UseWebSite', TRUE) || C('Plugins.AboutMe.UseRelationshipStatus', TRUE) || C('Plugins.AboutMe.UseBirthday', TRUE) || C('Plugins.AboutMe.UseQuote', TRUE) || C('Plugins.AboutMe.UseLocation', TRUE)) { ?>
<h2>Basic Information</h2>
<ul>
	<?php if(C('Plugins.AboutMe.UseRealName', TRUE)) { ?>
	 <li>
      <?php
         echo $this->Form->Label('Real Name', 'Real Name');
         echo $this->Form->TextBox('RealName');
      ?>
   </li>
   <?php } ?>
   
   
   <?php if(C('Plugins.AboutMe.UseNickName', TRUE)) { ?>
    <li>
      <?php
         echo $this->Form->Label('Nick Name', 'Nick Name');
         echo $this->Form->TextBox('OtName');
      ?>
   </li>
   <?php } ?>
   
   <?php if(C('Plugins.AboutMe.UseWebSite', TRUE)) { ?>
   <li>
      <?php
         echo $this->Form->Label('WebSite', 'WS');
         echo $this->Form->TextBox('WS') ?>
   </li>
    <?php } ?>
   
   
   <?php if(C('Plugins.AboutMe.UseRelationshipStatus', TRUE)) { ?>
    <li>
      <?php
         echo $this->Form->Label('Relationship Status', 'Relationship Status');
         echo $this->Form->DropDown('RelStat', $RelationshipData);
      ?>
   </li>
   <?php } ?>
   
   
   <?php if(C('Plugins.AboutMe.UseBirthday', TRUE)) { ?>
   <li>
      <?php
         echo $this->Form->Label('Birthday', 'Birthday');
         echo $this->Form->Date('BD');
    	?>
    </li>
    <li>
    	<table>
			<tr>
				<td>
					<?php
         				 echo $this->Form->CheckBox('HideBD', T('Hide Birthday'), array('value' => '1'));
      				?>
      			</td>
      			<td>
      				<?php
         				 echo $this->Form->CheckBox('HideBY', T('Hide Year Only'), array('value' => '1'));
      				?>
      			</td>
			</tr>
		</table>
	</li>
	 <?php } ?>
	 
	 
	<?php if(C('Plugins.AboutMe.UseQuote', TRUE)) { ?>
   <li>
      <?php
         echo $this->Form->Label('Favorite Quote', 'Quote');
         echo $this->Form->TextBox('Quote', array('MultiLine' => true, 'rows'=>'20', 'cols'=>'80'));
      ?>
   </li>
    <?php } ?>
	
	
   <?php if(C('Plugins.AboutMe.UseLocation', TRUE)) { ?>
   <li>
    <?php
         echo $this->Form->Label('Location', 'Location');
         echo $this->Form->TextBox('Loc'); ?>
   </li>
   <?php } ?>
   
    <?php 
    $this->FireEvent('EditBasicAfter'); 
    ?>
    </ul>
	<?php } ?>
	
	
	<?php if(C('Plugins.AboutMe.UseEmployer', TRUE) || C('Plugins.AboutMe.UseJobTitle', TRUE)) { ?>
   		<H2>Career</H2>
   <ul>
   
   
   <?php if(C('Plugins.AboutMe.UseEmployer', TRUE)) { ?>
    <li>
      <?php
         echo $this->Form->Label('Employer', 'Employer');
         echo $this->Form->TextBox('Emp');
      ?>
   </li>
    <?php } ?>
	
	
   <?php if(C('Plugins.AboutMe.UseJobTitle', TRUE)) { ?>
    <li>
      <?php
         echo $this->Form->Label('Job Title', 'Job Title');
         echo $this->Form->TextBox('JobTit');
      ?>
   </li>
    <?php } ?>
    </ul>
	<?php } ?>
	
	<?php if(C('Plugins.AboutMe.UseHighSchool', TRUE) || C('Plugins.AboutMe.UseCollege', TRUE)) { ?>
   		<H2>Education</H2>
   <ul>
   
   
   <?php if(C('Plugins.AboutMe.UseHighSchool', TRUE)) { ?>
    <li>
      <?php
         echo $this->Form->Label('High School', 'High School');
         echo $this->Form->TextBox('HS');
      ?>
   </li>
    <?php } ?>
	
	
   <?php if(C('Plugins.AboutMe.UseCollege', TRUE)) { ?>
    <li>
      <?php
         echo $this->Form->Label('College', 'College');
         echo $this->Form->TextBox('Col');
      ?>
   </li>
    <?php } ?>
	
	
   <?php 
    $this->FireEvent('EditEduAfter'); 
    ?>
	</ul>
	<?php } ?>
	
	
	<?php if(C('Plugins.AboutMe.UseBio', TRUE)) { ?>
   		<H2>Biography</H2>
   <ul>
   <li>
      <?php
         echo $this->Form->Label('Biography', 'Bio');
         echo $this->Form->TextBox('Bio', array('MultiLine' => true, 'rows'=>'30', 'cols'=>'80')) ?>
   </li>
   </ul>
    <?php } ?>
	
	
   <?php if(C('Plugins.AboutMe.UseInter', TRUE) || C('Plugins.AboutMe.UseMus', TRUE) || C('Plugins.AboutMe.UseGam', TRUE) || C('Plugins.AboutMe.UseMov', TRUE) || C('Plugins.AboutMe.UseTV', TRUE) || C('Plugins.AboutMe.UseBks', TRUE)) { ?>
   		<H2>Interests</H2>
   <ul>
   
   
   <?php if(C('Plugins.AboutMe.UseInter', TRUE)) { ?>
    <li>
      <?php
         echo $this->Form->Label('Interests', 'Inter');
         echo $this->Form->TextBox('Inter') ?>
   </li>
    <?php } ?>
	
	
   <?php if(C('Plugins.AboutMe.UseMus', TRUE)) { ?>
   <li>
      <?php
         echo $this->Form->Label('Music', 'Mus');
         echo $this->Form->TextBox('Mus') ?>
   </li>
    <?php } ?>
	
	
   <?php if(C('Plugins.AboutMe.UseGam', TRUE)) { ?>
   <li>
      <?php
         echo $this->Form->Label('Games', 'Gam');
         echo $this->Form->TextBox('Gam') ?>
   </li>
    <?php } ?>
	
	
   <?php if(C('Plugins.AboutMe.UseMov', TRUE)) { ?>
   <li>
      <?php
         echo $this->Form->Label('Movies', 'Mov');
         echo $this->Form->TextBox('Mov') ?>
   </li>
    <?php } ?>
	
	
   <?php if(C('Plugins.AboutMe.UseTV', TRUE)) { ?>
   <li>
      <?php
         echo $this->Form->Label('Television', 'TV');
         echo $this->Form->TextBox('TV') ?>
   </li>
    <?php } ?>
	
	
   <?php if(C('Plugins.AboutMe.UseBks', TRUE)) { ?>
   <li>
      <?php
         echo $this->Form->Label('Books', 'Bks');
         echo $this->Form->TextBox('Bks') ?>
   </li>
    <?php } ?>
	</ul>
	 <?php } ?>
	
	
   <?php
      $this->FireEvent('EditInterAfter');
      ?>
</ul>
	<?php
// Close the form
				echo $this->Form->Close('Save'); 


