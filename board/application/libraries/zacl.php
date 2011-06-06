<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Zacl
{
	// Set the instance variable
	var $CI;

	function __construct()
        {
            //session_start();
            //Append Zend's folder in PHP's include path
            //set_include_path(get_include_path() . PATH_SEPARATOR . BASEPATH . "application/library");
            $CI =& get_instance();
            $CI->load->library('Zend');
            $CI->zend->load('Zend/Acl');
            $CI->zend->load('Zend/Acl/Role');
            $CI->zend->load('Zend/Acl/Resource');
            
            //Load the Acl class
//            require_once 'Zend/Acl.php';
//            require_once 'Zend/Acl/Role.php';
//            require_once 'Zend/Acl/Resource.php';

            //Create a new Acl object
            $this->acl = new Zend_Acl();

            /**
             * Add roles and resources. Check Zend's documentation for excellent
             * information on all these.
             * http://framework.zend.com/manual/en/zend.acl.html
             */
            $this->acl->addRole(new Zend_Acl_Role('banned'));
            $this->acl->addRole(new Zend_Acl_Role('guest'));
            $this->acl->addRole(new Zend_Acl_Role('member'));
            $this->acl->addRole(new Zend_Acl_Role('writer'));
            $this->acl->addRole(new Zend_Acl_Role('editor'), 'writer');
            $this->acl->addRole(new Zend_Acl_Role('mod'), 'editor');
            $this->acl->addRole(new Zend_Acl_Role('admin'));
            /**
             * Add some resources
             */
            $this->acl->add(new Zend_Acl_Resource('topic'));
            $this->acl->add(new Zend_Acl_Resource('topic/add'),'topic');
            $this->acl->add(new Zend_Acl_Resource('topic/edit'),'topic');
            $this->acl->add(new Zend_Acl_Resource('ajax_action'));
            $this->acl->add(new Zend_Acl_Resource('ajax_action/upload'),'ajax_action');
            $this->acl->add(new Zend_Acl_Resource('ajax_action/save'),'ajax_action');
            $this->acl->add(new Zend_Acl_Resource('action_reply'));
            $this->acl->add(new Zend_Acl_Resource('action_reply/save_reply'),'action_reply');
            $this->acl->add(new Zend_Acl_Resource('action_reply/report'),'action_reply');
            
            //$this->acl->add(new Zend_Acl_Resource('topic/delete'),'editor');

            /**
             * Set rules for Acl
             */
            $this->acl->deny(); //Deny everything, so as to follow a whitelist approach.
           /*——————————— Baned ———————————*/
           // $acl->allow(‘banned', ‘usercp/settings');
            /*——————————– Member ——————————–*/
            $this->acl->allow('member', 'topic');
            $this->acl->allow('member', 'ajax_action');
            $this->acl->allow('member', 'action_reply');
            /*———————————- Writer ———————————*/
            $this->acl->allow('writer', 'topic/add');
            $this->acl->allow('writer', 'ajax_action');
            $this->acl->allow('writer', 'action_reply');
            /*———————————- Editor ———————————-*/
            $this->acl->allow('editor', 'topic');
            $this->acl->allow('editor', 'ajax_action');
            $this->acl->allow('editor', 'action_reply');
            /*——————————- Moderator ——————————-*/
           // $acl->allow('moderator', 'office');
           // $acl->deny('moderator', 'office/users');
            /*—————————– Administrator —————————–*/
            $this->acl->allow('admin'); // Grant All
          //  $this->acl->allow('guest','users_login');
           // $this->acl->allow('member','users_profile');
        }

	// Function to check if the current or a preset role has access to a resource
	function check_acl($role,$resource,$own_id=NULL,$member_id=NULL)
        {
            if (!$this->acl->has($resource))
            {
                return TRUE;
            }
            
            if($this->acl->isAllowed($role,$resource)){
                if (($member_id!=NULL) and ($own_id!=NULL) and ($own_id==$member_id)){
                    return TRUE;
                }else{
                    return $this->acl->isAllowed($role,$resource);
                }
            }else{
                return FALSE ;
            }
            
        }
 
}