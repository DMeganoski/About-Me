<?php

if (!defined('APPLICATION'))
    exit();
// Check to see if the user chose to show the year also, and format the birthday as such
if ($this->User->ShowBY != '1') {
    $Birthday = Gdn_Format::Date($this->User->DateOfBirth, T('Date.DefaultDayFormat', '%B %e'));
} else {
    $Birthday = Gdn_Format::Date($this->User->DateOfBirth, T('Date.DefaultFormat', '%B %e, %Y'));
}

// Gender Translation
if ($this->User->Gender == 'm') {
    $Gender = T("Male");
} else if ($this->User->Gender == 'f') {
    $Gender = T("Female");
}

// Relationship Status Translation
switch ($this->AboutMe->Relationship) {
    default:
    case 's':
	$RelationshipStatus = T("Single");
	break;
    case 'm':
	$RelationshipStatus = T("Married");
	break;
    case 'i':
	$RelationshipStatus = T("In Relationship");
	break;
    case 'd':
	$RelationshipStatus = T("Divorced");
	break;
    case 'w':
	$RelationshipStatus = T("Widowed");
	break;
}
// Replace the line breaks in the bio
$Biography = str_replace("\n", "<br/>", $this->AboutMe->Bio);

// A giant array containing all the fields and default values.
// Not sure if this is the most efficient way, but...
// Labels are displayed as below
$AllSections = array(
"Basic" => array(
    "FirstName" => array(
	"Label" => T("First Name"), "Visibility" => 0, "Value"=> NULL,
	"Source" => $this->User->FirstName),
    "LastName" => array(
	"Label"=> T("Last Name"), "Visibility" => 0, "Value" => NULL,
	"Source" => $this->User->LastName),
    "UserName" => array(
	"Label" => T("User Name"), "Visibilty" => 0, "Value" => NULL,
	"Source" => $this->User->Name),
    "NickName" => array(
	"Label"=> T("Nick Name"), "Visibility" => 0, "Value" => NULL,
	"Source" => $this->AboutMe->NickName),
    "Relationship" => array(
	"Label"=> T("Relationship Status"), "Visibility" => 0, "Value" => NULL,
	"Source" => $RelationshipStatus),
    "Quote" => array(
	"Label"=> T("Favorite Quote"), "Visibility" => 0, "Value" => NULL,
	"Source" => $this->AboutMe->Quote),
    "Gender" => array(
	"Label"=> T("Gender"), "Visibility" => 0, "Value" => NULL,
	"Source" => $Gender),
    "Birthday" => array(
	"Label"=> T("Birthday"), "Visibility" => 0, "Value" => NULL,
	"Source" => $Birthday),
),
"Location" => array(
    "Address" => array(
	"Label"=> T("Address"), "Visibility" => 0, "Value" => NULL,
	"Source" => $this->User->Address),
    "City" => array(
	"Label"=> T("City"), "Visibility" => 0, "Value" => NULL,
	"Source" => $this->User->City),
    "State" => array(
	"Label"=> T("State"), "Visibility" => 0, "Value" => NULL,
	"Source" => $this->User->State),
    "Country" => array(
	"Label"=> T("Country"), "Visibility" => 0, "Value" => NULL,
	"Source" => $this->User->Country),
),
"Career" => array(
    "Company" => array(
	"Label"=> T("Company"), "Visibility" => 0, "Value" => NULL,
	"Source" => $this->AboutMe->Company),
    "Position" => array(
	"Label"=> T("Position"), "Visibility" => 0, "Value" => NULL,
	"Source" => $this->AboutMe->Position),
),
"Education" => array(
    "HighSchool" => array(
	"Label" => T(""), "Visibility" => 0, "Value" => NULL,
	"Source" => $this->AboutMe->HighSchool),
    "College" => array(
	"Label" => T("College"), "Visibility" => 0, "Value" => NULL,
	"Source" => $this->AboutMe->College)
),
"Interests" => array(
    "Music" => array(
	"Label" => T("Music"), "Visibility" => 0, "Value" => NULL,
	"Source" => $this->AboutMe->Music),
    "Movies" => array(
	"Label" => T("Movies"), "Visibility" => 0, "Value" => NULL,
	"Source" => $this->AboutMe->Movies),
    "Television" => array(
	"Label" => T("Television"), "Visibility" => 0, "Value" => NULL,
	"Source" => $this->AboutMe->Television),
    "Games" => array(
	"Label" => T("Games"), "Visibility" => 0, "Value" => NULL,
	"Source" => $this->AboutMe->Games),
    "Books" => array(
	"Label" => T("Books"), "Visibility" => 0, "Value" => NULL,
	"Source" => $this->AboutMe->Books),
    "OtherInterests" => array(
	"Label" => T("OtherInterests"), "Visibility" => 0, "Value" => NULL,
	"Source" => $this->AboutMe->OtherInterests)
),
"Biography" => array(
    "Biography" => array(
	"Label" => T(""), "Visibility" => 0, "Value" => NULL,
	"Source" => $Biography)
));
// End of giant array

$UserName = $this->User->Name;

// Get User Info
if (!empty($this->User->Photo)) {
    if (strtolower(substr($this->User->Photo, 0, 7)) != 'http://') {
	$Photo = Img('uploads/' . ChangeBasename($this->User->Photo, 'p%s'));
    } else if (strtolower(substr($$this->User->Photo, 0, 7)) == 'http://') {
	$Photo = Img($this->User->Photo) . $this->User->Photo;
    }
} else {
    $Photo = NULL;
}

/*
 * Function to check to see if the section is enabled on the site, and if it is,
 * checks to see if the user has disabled it.
 */

function CheckEnabled() {
    
}

?>
