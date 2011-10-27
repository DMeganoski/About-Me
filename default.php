<?php if (!defined('APPLICATION')) exit();
// Define the plugin:
$PluginInfo['AboutMe'] = array(
    'Name' => 'AboutMe',
   'Description' => 'This is a plugin to add a tab to the profile page, with various fields for a more detailed user profile.',
   'Version' => '1.1.1',
   'Author' => "Darryl Meganoski",
   'AuthorEmail' => 'zodiacdm@gmail.com',
   'AuthorUrl' => 'www.facebook.com/zodiacdm',
   'HasLocale' => TRUE,

);

class AboutMe implements Gdn_IPlugin {

//==========Random Variables for later Use
//$Controller = $Sender->ControllerName;

/**
 * Add to profile @ tabs - link to view page.
 * If you would like this to be the first 'tab' on the list, go to
 * 'vanilla_folder/applications/dashboard/controllers/class.profilecontroller.php'
 * and add a
 * $this->FireEvent('BeforeAddProfileTabs');
 * somewhere around line 736 of the file,
 * and change the name of the magic event below to ProfileController_BeforeAddProfileTabs_handler
 */
public function ProfileController_AddProfileTabs_handler(&$Sender) {
   $Sender->AddProfileTab('aboutme', "/profile/aboutme/".$Sender->User->UserID."/".Gdn_Format::Url($Sender->User->Name), 'AboutMe', 'About Me');
   $Sender->AddCssFile('/plugins/AboutMe/design/am.default_theme.css');
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
         $SideMenu->AddLink('Options', T('Edit My Details'), '/profile/editme/'.$Sender->User->UserID.'/'.Gdn_Format::Url($Sender->User->Name), FALSE, array('class' => 'Popup'));
      } else {
      	$SideMenu->AddLink('Options', T('Edit My Details'), '/profile/editme/'.$Sender->User->UserID.'/'.Gdn_Format::Url($Sender->User->Name), 'Garden.Users.Edit', array('class' => 'Popup'));
      	return;
      }
}


/**
* Create a controller for 'edit' or 'view' commands
* @param unknown_type $Sender
* @param unknown_type $params - three elements - ['edit' or 'view' | user_id | user_name]
*/
public function ProfileController_AboutMe_Create(&$Sender, $params) {
   $Sender->UserID = ArrayValue(0, $Sender->RequestArgs, '');
   $Sender->UserName = ArrayValue(1, $Sender->RequestArgs, '');
   $Sender->GetUserInfo($Sender->UserID, $Sender->UserName);
   $Sender->SetTabView('aboutme', dirname(__FILE__).DS.'views'.DS.'aboutme_view.php', 'Profile', 'Dashboard');
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

public function ProfileController_EditMe_Create(&$Sender, $params) {
   $this->UserID = ArrayValue(0, $Sender->RequestArgs, '');
   $this->UserName = ArrayValue(1, $Sender->RequestArgs, '');
   $Sender->GetUserInfo($Sender->UserID, $Sender->UserName);
   // change this to use a different css stylesheet i.e. from am.default_theme.css to am.realgamerstheme.css
   $Sender->AddCssFile('/plugins/AboutMe/design/am.default_theme.css');

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
      if(!empty($Sender->AboutMe)) {
	 $Sender->Form->SetData($Sender->AboutMe);
      }
   } else { //starts save form
      if(!empty($Sender->AboutMe)) {
	 $Sender->Form->SetFormValue('ProfileID', $Sender->AboutMe->ProfileID);
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
   $Sender->View = dirname(__FILE__).DS.'views'.DS.'aboutme_edit.php';

   //$Sender->HandlerType = HANDLER_TYPE_NORMAL;
   $Sender->Render();
}

public function OnDisable() {
}

/*public function ProfileController_AfterPreferencesDefined_Handler(&$Sender) {
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


}*/
/**
 *
 * Create the database table and columns for the information to be saved.
 * These fields are what you would change or add to to add more to the profile.
 * Remember you would also have to add fields for new columns in the edit, and view pages as well.
 *
 */
public function Setup(){
		$Structure = Gdn::Structure();
		$Structure->Table('AboutMe')
		->PrimaryKey('ProfileID')
        ->Column('UserID', 'int', FALSE, 'primary')
        ->Column('RealName', 'varchar(64)', FALSE)
        ->Column('OtName', 'varchar(32)', TRUE)
        ->Column('RelStat', array('s','m','i','d','w'), FALSE)
        ->Column('BD', 'date', FALSE)
        ->Column('HideBD', array('1','0'), TRUE)
        ->Column('HideBY', array('1','0'), TRUE)
        ->Column('Quote', 'varchar(128)', TRUE)
        ->Column('Loc', 'varchar(32)', TRUE)
        ->Column('Emp', 'varchar(32)', TRUE)
        ->Column('JobTit', 'varchar(32)', TRUE)
        ->Column('HS', 'varchar(32)', TRUE)
        ->Column('Col', 'varchar(32)', TRUE)
        ->Column('Inter', 'varchar(128)', TRUE)
        ->Column('Mus', 'varchar(128)', TRUE)
        ->Column('Gam', 'varchar(128)', TRUE)
        ->Column('Mov', 'varchar(128)', TRUE)
        ->Column('TV', 'varchar(128)', TRUE)
        ->Column('Bks', 'varchar(128)', TRUE)
        ->Column('Bio', 'varchar(1024)', TRUE)
        ->Set(FALSE, FALSE);
	}
}

Gdn::FactoryInstall('AboutMeModel','AboutMeModel',
PATH_PLUGINS.DS.'AboutMe'.DS.'class.aboutme.plugin.php',
Gdn::FactoryInstance,NULL,FALSE);


?>
