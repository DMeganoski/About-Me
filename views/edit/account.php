<?php

if (!defined('APPLICATION'))
    exit();

include_once(PATH_PLUGINS.DS."AboutMe/views/sharedcssandjs.php");

// TODO: hide sections if disabled by admin
?><h3><span class="Indicator Open">v</span><? echo T("Name Settings")?></h3><?

/* PREP: Allow users to choose prefered display name across the site
 * echo "<li>";
 * echo $Sender->Form->Label('NamePreference', 'Preferred Display Name');
 * echo $Sender->Form->RadioList('NamePreference', $this->NamePreferenceChoices, array('default' => '0'));
 */

echo "<li>";
echo $Sender->Form->Label("First Name");
echo $Sender->Form->TextBox('FirstName');
echo "</li>";
echo "<li>";
echo $Sender->Form->Label('LastName');
echo $Sender->Form->TextBox("LastName");
?></li>
</ul>
<h3><span class="Indicator Open">v</span><? echo T("Birthday Settings"); ?></h3>
<ul>
    <li><?
echo $Sender->Form->Label("Birthday");
echo $Sender->Form->Date("DateOfBirth");
echo "</li>";
echo "<li>";
echo $Sender->Form->CheckBox('ShowBY', T('Also show the year?'), array('value' => '1'));
echo "</li>";
echo "<li>";
echo $Sender->Form->Label('Address');
echo $Sender->Form->TextBox("Address", array('MultiLine' => true, 'rows' => '30', 'cols' => '80'));
echo "</li>";
echo "<li>";
echo $Sender->Form->Label('City');
echo $Sender->Form->TextBox("City");
echo "</li>";
echo "<li>";
echo $Sender->Form->Label('State');
echo $Sender->Form->TextBox("State");
echo "</li>";
echo "<li>";
echo $Sender->Form->Label('Zipcode');
echo $Sender->Form->TextBox("Zipcode");
echo "</li>";
echo "<li>";
echo $Sender->Form->Label('Country');
echo $Sender->Form->TextBox("Country");
echo "</li>";
echo "<li>";
echo $Sender->Form->Label('Phone Number', 'Phone Number');
echo $Sender->Form->TextBox('Phone');
echo "</li>";
?>
