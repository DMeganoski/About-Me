<?php

if (!defined('APPLICATION'))
    exit();
// Define the plugin:
$PluginInfo['AboutMeDev'] = array(
    'Name' => 'AboutMeDev',
    'Description' => 'This is the development version.',
    'Version' => '1.1.x',
    'Author' => "Darryl Meganoski",
    'AuthorEmail' => 'zodiacdm@gmail.com',
    'AuthorUrl' => 'www.facebook.com/zodiacdm',
    'HasLocale' => TRUE,
);

class AboutMe extends Gdn_Plugin {

    /**
     * Adds a tab to the profile.
     * If you would like this to be the first 'tab' on the list, go to
     * 'vanilla_folder/applications/dashboard/controllers/class.profilecontroller.php'
     * and add a
     * $this->FireEvent('BeforeAddProfileTabs');
     * somewhere around line 736 of the file,
     * and change the name of the magic event below to ProfileController_BeforeAddProfileTabs_handler
     */
    public function ProfileController_AddProfileTabs_handler(&$Sender) {
	$Sender->AddProfileTab('aboutme', "/profile/aboutme/" . $Sender->User->UserID . "/" . Gdn_Format::Url($Sender->User->Name), 'AboutMe', 'About Me');
	$Sender->AddCssFile('/plugins/AboutMeDev/design/am.default_theme.css');
	$Sender->AddJsFile('/plugins/AboutMeDev/aboutme.boxlink.js');
    }

    /**
     * Adds the button to the side menu for filling in info
     * @param $Sender
     */
    public function ProfileController_AfterAddSideMenu_Handler(&$Sender) {
	$SideMenu = $Sender->EventArguments['SideMenu'];
	$Session = Gdn::Session();
	$ViewingUserID = $Session->UserID;

	if ($Sender->User->UserID == $ViewingUserID) {
	    $SideMenu->AddLink('Options', T('Edit My Details'), '/profile/editme/' . $Sender->User->UserID . '/' . Gdn_Format::Url($Sender->User->Name), FALSE, array('class' => 'Popup'));
	} else {
	    $SideMenu->AddLink('Options', T('Edit My Details'), '/profile/editme/' . $Sender->User->UserID . '/' . Gdn_Format::Url($Sender->User->Name), 'Garden.Users.Edit', array('class' => 'Popup'));
	    return;
	}
    }

    /**
     * Creates a page for the viewing of the user info
     */
    public function ProfileController_AboutMe_Create(&$Sender, $params) {
	$Sender->UserID = ArrayValue(0, $Sender->RequestArgs, '');
	$Sender->UserName = ArrayValue(1, $Sender->RequestArgs, '');
	$Sender->GetUserInfo($Sender->UserID, $Sender->UserName);
	$Sender->SetTabView('aboutme', dirname(__FILE__) . DS . 'views/view/aboutme_view.php', 'Profile', 'Dashboard');
	//$UserInfoModule = new UserInfoModule($this);
	//$UserInfoModule->User = $this->User;
	//$UserInfoModule->Roles = $this->Roles;

	$AboutMeModel = new Gdn_Model('AboutMe');
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
	$this->UserID = ArrayValue(0, $Sender->RequestArgs, '');
	$this->UserName = ArrayValue(1, $Sender->RequestArgs, '');
	$Sender->GetUserInfo($Sender->UserID, $Sender->UserName);
	// change this to use a different css stylesheet i.e. from am.default_theme.css to am.realgamerstheme.css
	$Sender->AddCssFile(dirname(__FILE__) . DS .'design/am.default_theme.css');
	$Sender->AddJsFile(PATH_PLUGINS . DS . 'AboutMe/js/form_collapse.js');

	if (!is_numeric($this->UserID)) {

	    echo '<div class="Empty">Oops, thats not right...</div>';
	    $Sender->Render();
	}
	$AboutMeModel = new Gdn_Model('AboutMe');
	$AboutMeData = $AboutMeModel->GetWhere(array('UserID' => $this->UserID));
	$AboutMe = $AboutMeData->FirstRow();
	$Sender->AboutMe = $AboutMe;

	$Session = Gdn::Session();
	$ViewingUserID = $Session->UserID;
	if ($Sender->User->UserID != $ViewingUserID) {
	    $Sender->Permission('Garden.Users.Edit');
	    $AboutMeUserID = $Sender->User->UserID;
	} else {
	    $AboutMeUserID = $ViewingUserID = Gdn::Session()->UserID;
	}

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
	    $Sender->Form->SetFormValue('UserID', $this->UserID);
	    $Data = $Sender->Form->FormValues();
	    if ($Sender->Form->Save() !== FALSE) {
		$Sender->StatusMessage = Gdn::Translate("Your settings have been saved.");
		// Trying to record activity if the person changed his/her info
		// AddActivity($AboutMeUserID, 'Story', 'has updated his profile');
	    } else {
		$Sender->StatusMessage = T("Oops, changes not saved");
	    }
	} //ends save form
	$Sender->View = dirname(__FILE__) . DS . 'views/edit/aboutme_edit.php';

	//$Sender->HandlerType = HANDLER_TYPE_NORMAL;
	$Sender->Render();
    }
    
    public function ProfileController_EditMyAccountAfter_Handler($Sender) {
	echo "<style>#Popup textarea#Form_Address{width: 250px;}</style>";
	echo "<li>";
	echo $Sender->Form->Label("First Name");
	echo $Sender->Form->TextBox('FirstName');
	echo "</li>";
	echo "<li>";
	echo $Sender->Form->Label('LastName');
	echo $Sender->Form->TextBox("LastName");
	echo "</li>";
	echo "<li>";
	echo $Sender->Form->Label("Birthday");
	echo $Sender->Form->Date("DateOfBirth");
	echo "</li>";
	echo "<li>";
	echo $Sender->Form->CheckBox('ShowBY', T('Also show the year?'), array('value' => '1'));
	echo "</li>";
	echo "<li>";
	echo $Sender->Form->Label('Address');
	echo $Sender->Form->TextBox("Address", array('MultiLine' => true, 'rows'=>'30', 'cols'=>'80'));
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

    /**
     * This method gets called in place of the EntryController's Render method.
     */
    public function EntryController_AfterPasswordField_handler(&$Sender) {
	echo '<li>';
	echo $this->Form->Label('Address', 'Address');
	echo $this->Form->TextBox('Address');
    }

    /* public function ProfileController_AfterPreferencesDefined_Handler(&$Sender) {
      $Sender->Preferences['Profile Information Visibility'] = array(

      'Everyone.Birthyear' => T('Just hide the year.'),
      'Everyone.HideSome' => T('Hide my info from the public. (unregistered users)'),
      'Everyone.HideAll' => T('Hide my info from everyone except staff.'),
      'Everyone.Birthday' => T('Show my birthday.'),

      'Pulbic.Birthday' => T('Show my birthday.'),
      'Pulbic.HideAll' => T('Hide my info from everyone except staff.'),
      'Pulbic.Birthyear' => T('Just hide the year.'),
      'Pulbic.HideSome' => T('Hide my info from the public. (unregistered users)'),




      );


      } */

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
		->Column('Colllege', 'varchar(32)', TRUE)
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
    }

    /**
     * Function called when the plugin is disabled. 
     */
    public function OnDisable() {
	
    }

}

Gdn::FactoryInstall('AboutMeModel', 'AboutMeModel', PATH_PLUGINS . DS . 'AboutMe' . DS . 'class.aboutme.plugin.php', Gdn::FactoryInstance, NULL, FALSE);
?>