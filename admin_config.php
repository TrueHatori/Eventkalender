<?php

require_once('../../class2.php');
if (!getperms('P')) 
{
	e107::redirect('admin');
	exit;
}

e107::lan('eventcalender',true);
define('EC_CACHE_TAG', 'nomd5_eventcalender');

class eventcalender_adminArea extends e_admin_dispatcher
{
	protected $modes = array(	
		'main'	=> array(
			'controller' 	=> 'eventcalender_ui',
			'path' 			=> null,
			'ui' 			=> 'eventcalender_form_ui',
			'uipath' 		=> null
		),
	);

	protected $adminMenu = array(
		'main/list'				=> array('caption'=> 'Event Liste', 'perm' => 'P'),
		'main/create'			=> array('caption'=> 'Neues Event', 'perm' => 'P'),
	);

	protected $adminMenuAliases = array(
		'main/edit'	=> 'main/list'
	);

	protected $menuTitle = 'Event Calendar';
}

class eventcalender_ui extends e_admin_ui
{
		protected $pluginTitle		= LAN_PLUGIN_ECAL_TITLE;
		protected $pluginName		= 'eventcalender';	
		protected $table			= 'eventcalender';
		protected $pid				= 'ec_ID';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
		protected $batchExport     = true;
		protected $batchCopy		= true;
	
		protected $listOrder		= 'ec_Beginn ASC';

		protected $fields 		= array (
		'checkboxes' => array(
			'title' => '',
			'type' => null,
			'data' => null,
			'width' => '5%',
			'thclass' => 'center',
			'forced' => '1',
			'class' => 'center',
			'toggle' => 'e-multiselect',
			),
		'ec_ID'			=> array(
			'title' => LAN_ID,
			'width' => '5%',
			'type' => 'number',
			'data' => 'str',
			'class' => 'left',
			'thclass' => 'left',
			'primary' => true,
			),
		'ec_Name'		=> array(
			'title' => LAN_ADMIN_01,
			'type' => 'text',
			'data' => 'str',
			'width' => 'auto',
			'inline' => false,
			'validate' => true,
			'writeParms' => array('size'=>'xlarge'),
			'class' => 'left',
			'thclass' => 'left',
			'help' => LAN_ADMIN_HELP_01,
			),
		'ec_URL'		=> array(
			'title' => LAN_ADMIN_02,
			'type' => 'url',
			'data' => 'str',
			'width' => 'auto',
			'inline' => false,
			'validate' => true,
			'writeParms' => array('size'=>'xxlarge'),
			'class' => 'left',
			'thclass' => 'left',
			'help' => LAN_ADMIN_HELP_02,
			),
		'ec_Beginn'		=> array(
			'title' => LAN_ADMIN_03,
			'type' => 'datestamp',
			'data' => 'int',
			'width' => 'auto',
			'inline' => false,
			'validate' => true,
			'writeParms'=>'type=datetime',
			'class' => null,
			'thclass' => 'left',
			'nosort' => false,
			'parms' => 'mask=%A %d %B %Y',
			'filter' => true,
			'help' => LAN_ADMIN_HELP_03,
			),
		'ec_Ende'		=> array(
			'title' => LAN_ADMIN_04,
			'type' => 'datestamp',
			'data' => 'int',
			'width' => 'auto',
			'inline' => false,
			'validate' => true,
			'writeParms'=>'type=datetime',
			'class' => null,
			'thclass' => 'left',
			'nosort' => false,
			'parms' => 'mask=%A %d %B %Y',
			'filter' => true,
			'help' => LAN_ADMIN_HELP_04,
		),
		'ec_Beschreibung' => array(
			'title' => LAN_ADMIN_05,
			'type' => 'textarea',
			'data' => 'str',
			'width' => '30%',
			'class' => 'left',
			'thclass' => 'left',
			),
		'options'       => array(
			'title' => LAN_OPTIONS,
			'type' => null,
			'width' => '5%',
			'forced' => true,
			'thclass' => 'center last',
			'class' => 'right',
			),
		);

		protected $fieldpref = array();

	//	protected $preftabs        = array('General', 'Other' );
		protected $prefs = array(
		);

		public function init()
		{
			// This code may be removed once plugin development is complete. 
			if(!e107::isInstalled('eventcalender'))
			{
				e107::getMessage()->addWarning("This plugin is not yet installed. Saving and loading of preference or table data will fail.");
			}
			// Set drop-down values (if any). 
		}

		// ------- Customize Create --------
		public function beforeCreate($new_data,$old_data)
		{
			return $new_data;
		}

		public function afterCreate($new_data, $old_data, $id)
		{
			e107::getCache()->clear_sys(EC_CACHE_TAG);
		}

		public function onCreateError($new_data, $old_data)
		{
			// do something
		}		

		// ------- Customize Update --------
		public function beforeUpdate($new_data, $old_data, $id)
		{
			return $new_data;
		}

		public function afterUpdate($new_data, $old_data, $id)
		{
			e107::getCache()->clear_sys(EC_CACHE_TAG);
		}

		public function onUpdateError($new_data, $old_data, $id)
		{
			// do something
		}
		
		public function afterDelete($deleted_data, $id, $deleted_check)
		{
			e107::getCache()->clear_sys(EC_CACHE_TAG);
		}

		// left-panel help menu area. (replaces e_help.php used in old plugins)
		public function renderHelp()
		{
			$caption = LAN_HELP;
			$text = LAN_ADMIN_HELPTEXT;

			return array('caption'=>$caption,'text'=> $text);
		}
}

class eventcalender_form_ui extends e_admin_form_ui
{
}

new eventcalender_adminArea();
require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();
require_once(e_ADMIN."footer.php");
exit;
