<?php

if (!defined('APPLICATION'))
    exit();
// Define the plugin:
$PluginInfo['AboutMe'] = array(
    'Name' => 'AboutMe',
    'Description' => 'This plugin adds a new tab and section to the profile, \'About Me\', with customizable user information.',
    'Version' => '1.5.0',
    'Author' => "Darryl Meganoski",
    'AuthorEmail' => 'dmeganoski@gmail.com',
    'AuthorUrl' => 'www.facebook.com/dmeganoski',
    'HasLocale' => TRUE,
    'CMSGroup' => 'ProfilePlus',
);

class AboutMe extends Gdn_Plugin {

    /**
     * Adds a tab to the profile.
     */
    public function ProfileController_AddProfileTabs_handler(&$Sender) {
	$Sender->AddProfileTab('aboutme', "/profile/aboutme/" . $Sender->User->UserID . "/" . Gdn_Format::Url($Sender->User->Name), 'AboutMe', 'About Me');
	$Sender->AddCssFile('/plugins/AboutMe/design/am.default_theme.css');
	$Sender->AddJsFile('/plugins/AboutMe/aboutme.boxlink.js');
    }

    /**
     * Adds the button to the side menu for filling in info
     * @param $Sender
     */
    public function ProfileController_AfterAddSideMenu_Handler(&$Sender) {
	$SideMenu = $Sender->EventArguments['SideMenu'];
	$Session = Gdn::Session();
	$ViewingUserID = $Session->UserID;

	// if the viewing user is the same as the requested user, add the self-edit link
	if ($Sender->User->UserID == $ViewingUserID) {
	    $SideMenu->AddLink('Options', T('Edit My Details'), '/profile/editme/' . $Sender->User->UserID . '/' . Gdn_Format::Url($Sender->User->Name), FALSE, array('class' => 'Popup'));
	    $Sender->AllowEdit == TRUE;
	// else only add the link to edit the requested user if the viewing user has the permission to edit users.
	} else {
	    $SideMenu->AddLink('Options', T('Edit My Details'), '/profile/editme/' . $Sender->User->UserID . '/' . Gdn_Format::Url($Sender->User->Name), 'Garden.Users.Edit', array('class' => 'Popup'));
	    return;
	    if($Sender->Permission('Garden.Users.Edit'))
		$Sender->AllowEdit == TRUE;
	}
    }

    /**
     * Creates a page for the viewing of the user info
     */
    public function ProfileController_AboutMe_Create(&$Sender, $params) {
	$Sender->UserID = ArrayValue(0, $Sender->RequestArgs, '');
	$Sender->UserName = ArrayValue(1, $Sender->RequestArgs, '');
	$Sender->GetUserInfo($Sender->UserID, $Sender->UserName);
	$Sender->SetTabView('aboutme', dirname(__FILE__) . DS . 'views/view/aboutme.php', 'Profile', 'Dashboard');
	//$UserInfoModule = new UserInfoModule($this);
	//$UserInfoModule->User = $this->User;
	//$UserInfoModule->Roles = $this->Roles;
	// Create the model for the data
	$AboutMeModel = new Gdn_Model('AboutMe');
	// Get data related to requested user
	$AboutMeData = $AboutMeModel->GetWhere(array('UserID' => $Sender->UserID));
	$AboutMe = $AboutMeData->FirstRow();
	$Sender->AboutMe = $AboutMe;

	$Sender->HandlerType = HANDLER_TYPE_NORMAL;
	$Sender->Render();
    }

    /**
     * The edit view, creates a basic page and form for the information 
     */
    public function ProfileController_EditMe_Create(&$Sender, $params) {
	$Sender->UserID = ArrayValue(0, $Sender->RequestArgs, '');
	$Sender->UserName = ArrayValue(1, $Sender->RequestArgs, '');
	$Sender->GetUserInfo($Sender->UserID, $Sender->UserName);

	if (!is_numeric($Sender->UserID)) {

	    echo '<div class="Empty">Oops, thats not right...</div>';
	    $Sender->View = PATH_PLUGINS . DS . "AboutMe/views/edit/editme.php";
	    $Sender->Render();
	} else {

	    // Check to make sure the user has permission
	    $Session = Gdn::Session();
	    $ViewingUserID = $Session->UserID;
	    if ($Sender->User->UserID != $ViewingUserID) {
		$Sender->Permission('Garden.Users.Edit');
		$AboutMeUserID = $Sender->User->UserID;
		$Sender->AllowEdit = TRUE;
	    } else {
		$AboutMeUserID = $ViewingUserID = Gdn::Session()->UserID;
		$Sender->AllowEdit = TRUE;
	    }

	    // Create the model and retrieve the data
	    $AboutMeModel = new Gdn_Model('AboutMe');
	    $AboutMeData = $AboutMeModel->GetWhere(array('UserID' => $Sender->UserID));
	    $AboutMe = $AboutMeData->FirstRow();
	    $Sender->AboutMe = $AboutMe;

	    //$Sender->AddSideMenu('plugin/userlist');
	    $Sender->Form = new Gdn_Form();
	    $Sender->Form->SetModel($AboutMeModel);
	    if ($Sender->Form->AuthenticatedPostBack() === FALSE) {
		//AND If the table is empty, set the form data
		if (!empty($Sender->AboutMe)) {
		    $Sender->Form->SetData($Sender->AboutMe);
		}
	    } else { //starts save form
		if (!empty($Sender->AboutMe)) {
		    $Sender->Form->SetFormValue('ProfileID', $Sender->AboutMe->ProfileID);
		    //$Sender->Preferences = MyExplode($Sender->AboutMe->Preferences);
		}
		$Sender->Form->SetFormValue('UserID', $Sender->UserID);
		$Data = $Sender->Form->FormValues();
		if ($Sender->Form->Save() !== FALSE) {
		    $Sender->StatusMessage = Gdn::Translate("Your settings have been saved.");
		    // TODO: Add user activity here
		} else {
		    $Sender->StatusMessage = T("Oops, changes not saved");
		}
	    } //ends save form
	    $Sender->View = dirname(__FILE__) . DS . 'views/edit/editme.php';

	    //$Sender->HandlerType = HANDLER_TYPE_NORMAL;
	    $Sender->Render();
	}
    }

    /**
     *
     * @param type $Sender 
     */
    public function ProfileController_EditMyAccountAfter_Handler($Sender) {

	// PREP: Allow users to choose prefered display name across the site
	//$this->NamePreferenceChoices = array('0' => 'User Name','1'=> 'Real Name');

	include_once(PATH_PLUGINS . DS . 'AboutMe/views/edit/account.php');
    }

    public function SettingsController_AboutMeSettings_Create($Sender) {
	// Load javascript & css, check permissions, and load side menu for this page.
	$Sender->AddJsFile('settings.js');
	$Sender->Title(T('Dashboard Summaries'));
	$Sender->RequiredAdminPermissions[] = 'Garden.Settings.Manage';
	$Sender->AddSideMenu('dashboard/settings');
	// Load up config options we'll be setting
	$Validation = new Gdn_Validation();
	$ConfigurationModel = new Gdn_ConfigurationModel($Validation);
	$ConfigurationModel->SetField(array(
	    'Galleries.Items.PerPage',
	    'Galleries.FireEvents.Show'
	));

	// Set the model on the form.
	$this->Form->SetModel($ConfigurationModel);

	// If seeing the form for the first time...
	if ($this->Form->AuthenticatedPostBack() === FALSE) {
	    // Apply the config settings to the form.
	    $this->Form->SetData($ConfigurationModel->Data);
	} else {
	    // Define some validation rules for the fields being saved
	    $ConfigurationModel->Validation->ApplyRule('Galleries.Items.PerPage', 'Required');
	    $ConfigurationModel->Validation->ApplyRule('Galleries.Items.PerPage', 'Integer');
	    $ConfigurationModel->Validation->ApplyRule('Vanilla.Comments.AutoRefresh', 'Integer');
	    $ConfigurationModel->Validation->ApplyRule('Vanilla.Archive.Date', 'Date');
	}


	// Render the custom dashboard view
	$Sender->Render('dashboardsummaries', '', 'plugins/VanillaStats');
    }


    /* -------------- Functions for imploding and exploding associative arrays ------------- */
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

    public function MyExplode($WierdArray) {
	$WierdPiece = explode('-', $WierdArray);
	foreach ($WierdPiece as $Piece) {
	    list ($Key, $Value) = explode(':', $Piece);
	    $Return[$Key] = $Value;
	}
	return $Return;
    }

    /**
     *
     * Create the database table and columns for the information to be saved.
     * These fields are what you would change or add to to add more to the profile.
     * Remember you would also have to add fields for new columns in the edit, and view pages as well.
     *
     */
    public function Structure() {
	$Structure = Gdn::Structure();
	// This is the default vanilla user table. It already contains alot of information
	/// so you should be careful how much you add to it.
	$Structure->Table('User')
		->Column('FirstName', 'varchar(64)', TRUE)
		->Column('LastName', 'varchar(64)', TRUE)
		->Column('ShowBY', 'tinyint(1)', '0')
		// Location Info
		->Column('Address', 'varchar(128)', TRUE)
		->Column('City', 'varchar(64)', TRUE)
		->Column('State', 'varchar(64)', TRUE)
		->Column('Country', 'varchar(64)', TRUE)
		->Column('Phone', 'varchar(12)', TRUE)
		->Set();
	// This is a new table we are creating for this plugin. You should add new data here.
	$Structure->Table('AboutMe')
		->PrimaryKey('ProfileID')
		->Column('UserID', 'int', FALSE, 'primary')
		// Basic Info
		->Column('NickName', 'varchar(64)', TRUE)
		->Column('Relationship', array('s', 'm', 'i', 'd', 'w'), TRUE)
		->Column('Quote', 'varchar(128)', TRUE)
		// Career Info
		->Column('Company', 'varchar(64)', TRUE)
		->Column('Position', 'varchar(64)', TRUE)
		// Education Info
		->Column('HighSchool', 'varchar(32)', TRUE)
		->Column('College', 'varchar(32)', TRUE)
		// Interest fields
		->Column('Music', 'varchar(128)', TRUE)
		->Column('Games', 'varchar(128)', TRUE)
		->Column('Movies', 'varchar(128)', TRUE)
		->Column('Television', 'varchar(128)', TRUE)
		->Column('Books', 'varchar(128)', TRUE)
		->Column('OtherInterests', 'varchar(128)', TRUE)
		// Biography
		->Column('Biograpy', 'text', TRUE)
		// Preferences
		->Column('Preferences', 'text', TRUE)
		->Set(FALSE, FALSE);
    }

    /**
     * Function called when the plugin is enabled.
     */
    public function Setup() {
	$this->Structure();
	if (C("Garden.ProfileTabOrder") == NULL)
	    SaveToConfig('Garden.ProfileTabOrder', array('aboutme'));
	
	// check the last version installed.
	$ThisVersion = $PluginInfo['AboutMe']['Version'];
	$InstalledVersion = C("Plugins.AboutMe.Version");
	if (substr($InstalledVersion, 0, 1) == substr($ThisVersion, 0, 1)) {
	    if (substr($InstalledVersion, 0, 3) == substr($ThisVersion, 0, 3)) {
		if (substr($InstalledVersion, 0, 5) == substr($ThisVersion, 0, 5)) {
		    // Versions are the same
		} else {
		    $this->OnUpgrade($InstalledVersion);
		}
	    } else {
		$this->OnUpgrade($InstalledVersion);
	    }
	} else {
	    $this->OnUpgrade($InstalledVersion);
	}
    }
    

    /**
     * Function called when the plugin is disabled. 
     */
    public function OnDisable() {
	
    }
    
    public function OnUpgrade($InstalledVersion = '0.0.0') {
	
    }

}

Gdn::FactoryInstall('AboutMeModel', 'AboutMeModel', PATH_PLUGINS . DS . 'AboutMe' . DS . 'default.php', Gdn::FactoryInstance, NULL, FALSE);
?>