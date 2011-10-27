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
<h2>Basic Information</h2>
<ul>
	 <li>
      <?php
         echo $this->Form->Label('Real Name', 'Real Name');
         echo $this->Form->TextBox('RealName');
      ?>
   </li>
    <li>
      <?php
         echo $this->Form->Label('Nick Name', 'Nick Name');
         echo $this->Form->TextBox('OtName');
      ?>
   </li>
    <li>
      <?php
         echo $this->Form->Label('Relationship Status', 'Relationship Status');
         echo $this->Form->DropDown('RelStat', $RelationshipData);
      ?>
   </li>
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
   <li>
      <?php
         echo $this->Form->Label('Favorite Quote', 'Quote');
         echo $this->Form->TextBox('Quote', array('MultiLine' => true, 'rows'=>'20', 'cols'=>'80'));
      ?>
   </li>
   <li>
    <?php
         echo $this->Form->Label('Location', 'Location');
         echo $this->Form->TextBox('Loc'); ?>
   </li>
    <?php 
    $this->FireEvent('EditBasicAfter'); 
    ?>
    <li>
   		<H2>Career</H2>
   </li>
    <li>
      <?php
         echo $this->Form->Label('Employer', 'Employer');
         echo $this->Form->TextBox('Emp');
      ?>
   </li>
    <li>
      <?php
         echo $this->Form->Label('Job Title', 'Job Title');
         echo $this->Form->TextBox('JobTit');
      ?>
   </li>
    <li>
   		<H2>Education</H2>
   </li>
    <li>
      <?php
         echo $this->Form->Label('High School', 'High School');
         echo $this->Form->TextBox('HS');
      ?>
   </li>
    <li>
      <?php
         echo $this->Form->Label('College', 'College');
         echo $this->Form->TextBox('Col');
      ?>
   </li>
   <?php 
    $this->FireEvent('EditEduAfter'); 
    ?>
   <li>
   		<H2>Biography</H2>
   </li>
   <li>
      <?php
         echo $this->Form->Label('Biography', 'Bio');
         echo $this->Form->TextBox('Bio', array('MultiLine' => true, 'rows'=>'30', 'cols'=>'80')) ?>
   </li>
   <li>
   		<H2>Interests</H2>
   </li>
    <li>
      <?php
         echo $this->Form->Label('Interests', 'Inter');
         echo $this->Form->TextBox('Inter') ?>
   </li>
   <li>
      <?php
         echo $this->Form->Label('Music', 'Mus');
         echo $this->Form->TextBox('Mus') ?>
   </li>
   <li>
      <?php
         echo $this->Form->Label('Games', 'Gam');
         echo $this->Form->TextBox('Gam') ?>
   </li>
   <li>
      <?php
         echo $this->Form->Label('Movies', 'Mov');
         echo $this->Form->TextBox('Mov') ?>
   </li>
   <li>
      <?php
         echo $this->Form->Label('Television', 'TV');
         echo $this->Form->TextBox('TV') ?>
   </li>
   <li>
      <?php
         echo $this->Form->Label('Books', 'Bks');
         echo $this->Form->TextBox('Bks') ?>
   </li>
   <?php
      $this->FireEvent('EditInterAfter');
      ?>
</ul>
	<?php
// Close the form
				echo $this->Form->Close('Save'); 


