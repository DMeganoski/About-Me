<?php if (!defined('APPLICATION')) exit();
// Define Lists

    $RelationshipData = $this->RelationshipData = array(
	    'p' => T('PickOne'),
	    's' => T('Single'),
	    'm' => T('Married'),
	    'i' => T('InRelationship'),
	    'd' => T('Divorced'),
	    'w' => T('Widowed'),
    );
    $VisibilityData = array(
	    '0' => T('Not Visible'),
	    '1' => T('Public')
    )
	
// Display the form
?>
<script type="text/javascript">
    $(document).ready(function() {
	
	$('h2.Closed').next('ul').hide();
	
	$('h2.Collapse').find('span.Open').html('>').removeClass('Open').addClass('Closed');
	$('h2.Category').click(function() {
	    if (($this).hasClass('Open')) {
		$(this).next('ul').slideUp();
		$(this).find('span.Open').html('>').removeClass('Open').addClass('Closed');
	    } else {
		$(this).parent().find('h2.Open').next('ul').slideUp();
		$(this).next('ul').slideDown();
		$(this).find('span.Closed').html('v').removeClass('Closed').addClass('Open');
		$(this).removeClass("Closed").addClass("Open");
	    
		
	    }
	    
	    
	    
	})
    })

</script><?
echo "<h2>Edit My Details</h2>";
echo $this->Form->Open();
echo $this->Form->Errors();
?><h2 class="Open"><span class="Open"></span>Basic Information</h2>
<ul>
    <li><?
	echo $this->Form->Label('NickName');
	echo $this->Form->TextBox("NickName");
	echo "</li>";
	echo "<li>";
	echo "<style>#Popup textarea#Form_Quote{width: 250px;}</style>";
	echo $this->Form->Label('Favorite Quote');
	echo $this->Form->TextBox("Quote", array('MultiLine' => true, 'rows'=>'2', 'cols'=>'8'));
    ?></li>
    <li><?
	echo $this->Form->Label('Relationship Status', 'Relationship Status');
        echo $this->Form->DropDown('Relationship', $RelationshipData);
    ?></li>
</ul>
<H2 class="Category Open"><span class="Open"></span>Career Information</H2>
<ul>
   </li>
    <li>
      <?php
         echo $this->Form->Label('Company', 'Company');
         echo $this->Form->TextBox('Company');
      ?>
   </li>
    <li>
      <?php
         echo $this->Form->Label('Position', 'Position');
         echo $this->Form->TextBox('Position');
      ?>
   </li>
    <li>
</ul>
<H2 class="Open"><span class="Open"></span>Education Information</H2>
<ul>
    </li>
    <li>
      <?php
         echo $this->Form->Label('High School', 'High School');
         echo $this->Form->TextBox('HighSchool');
      ?>
   </li>
    <li>
      <?php
         echo $this->Form->Label('College', 'College');
         echo $this->Form->TextBox('College');
      ?>
   </li>
   <?php 
    $this->FireEvent('EditEduAfter'); 
    ?>
   <li>
</ul>
<H2 class="Open"><span class="Open"></span>Biography</H2>
<ul>
   </li>
   <li>
      <?php
	echo "<style>#Popup textarea#Form_Biography{width: 250px;}</style>";
         echo $this->Form->Label('Biography', 'Bio');
         echo $this->Form->TextBox('Biography', array('MultiLine' => true, 'rows'=>'30', 'cols'=>'80')) ?>
   </li>
   <li>
</ul>
<H2 class="Open"><span class="Open">Interests</span></H2>
<ul>
   </li>
    <li>
      <?php
         echo $this->Form->Label('OtherInterests', 'OtherInterests');
         echo $this->Form->TextBox('OtherInterests') ?>
   </li>
   <li>
      <?php
         echo $this->Form->Label('Music', 'Music');
         echo $this->Form->TextBox('Music') ?>
   </li>
   <li>
      <?php
         echo $this->Form->Label('Games', 'Games');
         echo $this->Form->TextBox('Games') ?>
   </li>
   <li>
      <?php
         echo $this->Form->Label('Movies', 'Movies');
         echo $this->Form->TextBox('Movies') ?>
   </li>
   <li>
      <?php
         echo $this->Form->Label('Television', 'Television');
         echo $this->Form->TextBox('Television') ?>
   </li>
   <li>
      <?php
         echo $this->Form->Label('Books', 'Books');
         echo $this->Form->TextBox('Books') ?>
   </li>
   <?php
      $this->FireEvent('EditInterAfter');
      ?>
</ul>
	<?php
// Close the form
				echo $this->Form->Close('Save'); 


