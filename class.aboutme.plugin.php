<?php
// Define the plugin:
$PluginInfo['AboutMe'] = array(
	'Name' =>		'About Me',
  	'Description' => 'This is a plugin to add a tab to the profile page, with various fields for a more detailed user profile.',
   'Version' => '1.x',
   'Author' => "Darryl Meganoski",
   'AuthorEmail' => 'zodiacdm@gmail.com',
   'AuthorUrl' => 'www.realgamersusepc.com',
   'HasLocale' => TRUE,

);

class AboutMe implements Gdn_IPlugin {


	public function ProfileController_EditMyAccountAfter_Handler(&$Sender) {
		echo '<li>';
		echo $Sender->Form->Label('Nick Name', 'NickName');
		echo $Sender->Form->TextBox('OtName');
		echo '</li>';
	}
	/**
	 * Add the tab to the profile for the 'About Me'page
	 *
	 * @param unknown_type $Sender
	 */
	public function ProfileController_AddProfileTabs_handler(&$Sender) {
		$Sender->AddProfileTab(Translate("AboutMe_ProfileTab"), "/profile/aboutme/view/".$Sender->User->UserID."/".GDN_Format::Url($Sender->User->Name));
		$Sender->AddCssFile('/plugins/AboutMe/design/am.default_theme.css'); // change this to use a different css stylesheet i.e. from am.default_theme.css to am.realgamerstheme.css
}

	
/**
 * Add to profile @ side menu - link to edit details
 * @param $Sender
 */
public function ProfileController_AfterAddSideMenu_Handler(&$Sender) {
      $SideMenu = $Sender->EventArguments['SideMenu'];
      $Session = Gdn::Session();
      $ViewingUserID = $Session->UserID;
 		if ($Sender->User->UserID != $ViewingUserID) {
         $Sender->Permission('Garden.Users.Edit');
         $AboutMeUserID = $Sender->User->UserID;
      } else {
      	$AboutMeUserID = $ViewingUserID = Gdn::Session()->UserID; 
      }
      if ($Sender->User->UserID == $ViewingUserID) {
         $SideMenu->AddLink('Options', T('Edit My Details'), '/profile/aboutme/edit/'.$Sender->User->UserID.'/'.Gdn_Format::Url($Sender->User->Name), FALSE, array('class' => 'Popup'));
      } else {
      	$SideMenu->AddLink('Options', T('Edit My Details'), '/profile/aboutme/edit/'.$Sender->User->UserID.'/'.Gdn_Format::Url($Sender->User->Name), 'Garden.Users.Edit', array('class' => 'Popup'));
      	return;
      }
}

	/**
	 * Create a controller for 'edit' or 'view' commands
	 * @param unknown_type $Sender
	 * @param unknown_type $params - three elements - ['edit' or 'view' | user_id | user_name]
	 */
	public function ProfileController_AboutMe_Create($Sender, $params) {
		$command = $params[0];
		$Sender->id = $params[1];
		$Sender->name = $params[2];
		
		$ViewingUserID = $Session->UserID;
		if ($Sender->User->UserID != $ViewingUserID) {
		$AboutMeUserID = $Sender->User->UserID;
		} else {
      	$AboutMeUserID = $ViewingUserID = Gdn::Session()->UserID; 
		}
		
		$SQL = Gdn::SQL();
     	$Session = Gdn::Session();
		
		$AboutMeModel = new Gdn_Model('AboutMe');
		$AboutMeData = $AboutMeModel->GetWhere(array('UserID' => $Sender->id));
		$AboutMe = $AboutMeData->FirstRow();
		$Sender->AboutMe = $AboutMe;
		
		$Sender->User = $SQL
			->Select('*')
        	->From('User')
        	->Where(array('UserID' => $Sender->id))
        	->Get()
        	->FirstRow();
		
		// If command is view, show the aboutme_view page
		if($command == 'view') {
			$Sender->View = dirname(__FILE__).DS.'views'.DS.'aboutme_view.php'; 
		}
		// If command is edit, create the form
		else if($command == 'edit') { 
      		$Sender->Form = new Gdn_Form();
      		$Sender->Form->SetModel($AboutMeModel);
      		if ($Sender->Form->AuthenticatedPostBack() === FALSE) {
      			//AND If the table is empty, set the form data
				if(!empty($Sender->AboutMe)) {
					$Sender->Form->SetData($Sender->AboutMe); 
				}
      		}
			else { //starts save form
      			if(!empty($Sender->AboutMe)) {
					$Sender->Form->SetFormValue('ProfileID', $Sender->AboutMe->ProfileID);
      			}
      			$Sender->Form->SetFormValue('UserID', $Sender->id);
				$Data = $Sender->Form->FormValues();
				if ($Sender->Form->Save() !== FALSE) {
            		$Profile = ArrayValue('$AboutMe', $Data);
               		if ($Data !== FALSE) {
                  		AddActivity($Sender->id, 'EditProfile','<a href="/profile/'.$Sender->User->UserID.'/'.Gdn_Format::Url($Sender->User->Name).'">'.$Sender->User->Name.'</a>'); }
                  		
            			$Sender->StatusMessage = Gdn::Translate("Your settings have been saved.");            		 
					}
     			else{
					$Sender->StatusMessage = T("Oops, changes not saved");
     			}
      		} //ends save form
      	$Sender->View = dirname(__FILE__).DS.'views'.DS.'aboutme_edit.php';
      	}
	$Sender->Render();
}

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
        
// Insert some activity types
///  %1 = ActivityName
///  %2 = ActivityName Possessive
///  %3 = RegardingName
///  %4 = RegardingName Possessive
///  %5 = Link to RegardingName's Wall
///  %6 = his/her
///  %7 = he/she
///  %8 = RouteCode & Route

//  X created a group
	$SQL = Gdn::SQL();
	if ($SQL->GetWhere('ActivityType', array('Name' => 'EditProfile'))->NumRows() == 0)
   		$SQL->Insert('ActivityType', array('AllowComments' => '0', 'Name' => 'EditProfile', 'FullHeadline' => '%1$s edited %6$s profile.', 'ProfileHeadline' => '%1$s edited %6$s profile.', 'Public' => '1'));
   
        
	}
}

Gdn::FactoryInstall('AboutMeModel','AboutMeModel',
PATH_PLUGINS.DS.'AboutMe'.DS.'class.aboutmemodel.php',
Gdn::FactoryInstance,NULL,FALSE);


?>
