<?php if (!defined('APPLICATION'))
    exit();



/*
     * Takes an array implodes it with '-' and ':', and returns the new string
     */

    function MyImplode($Array) {
	$Result = '';
	foreach ($Array as $Key => $Value) {
	    if (strlen($Result) > 1)
		$Result .= '-';
	    $Result .= $Key . ':' . $Value;
	}
	return $Result;
    }

    /*
     * Takes an imploded string containing an associative array and explodes it into an array again
     */

    function MyExplode($WierdArray) {
	$WierdPieces = explode('-', $WierdArray);
	foreach ($WierdPieces as $Piece) {
	    list ($Key, $Value) = explode(':', $Piece);
	    $Return[$Key] = $Value;
	}
	return $Return;
    }



$Preferences = MyExplode($this->AboutMe->Preferences);
if (empty($this->AboutMe)) { // if the sender's row in the 'about me' table is empty, tell the user 
    ?>
    <div class="Empty">
    <?php echo "This profile hasn't been set up yet."; ?>
    </div>
    <?php
} else { // else display the page
    include(PATH_PLUGINS . DS . "AboutMeDev/views/view/shelf.php");
    ?>

    <div class="aboutme"><?php
//--------------------------Start of php content --------------------------//
    // Blank array to be filled only by enabled sections with information within
    $SectionsWithInfo = array();
    foreach($AllSections as $SectionName => $Info) {
	// for each array of fields
	foreach($Info as $FieldName => $Details) {
	    if(!in_array($Preferences['Public'], $FieldName)) {
		$EnabledSections[$SectionName][$FieldName]=$AllSections[$SectionName][$FieldName];
		$EnabledSections[$SectionName][$FieldName]['Visibility'] = 1;
	    }
	    if($EnabledSections[$SectionName][$FieldName]["Visibility"] != 0) {
		$Source = $EnabledSections[$SectionName][$FieldName]['Source'];
		if(!empty($Source)) {
		    $EnabledSections[$SectionName][$FieldName]['Value'] = $Source;
		    // Mark this section as having information
		    $SectionsWithInfo[] = $SectionName;
		}
	    }
	}
    }
    foreach($EnabledSections as $Enabled => $Info) {
	if(in_array($Enabled, $SectionsWithInfo)) {
	    include(PATH_PLUGINS.DS."AboutMeDev/views/view/sections/".strtolower($Enabled).".php");
	}
    }
    // print_r($EnabledSections);
	    $this->FireEvent('AboutPageBoxAfter');
	    ?>
    </div>
<?php
}

