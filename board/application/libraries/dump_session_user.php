<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Dump_session_user {
    
    function __construct() 
    {
        $CI =& get_instance();
          
        $CI->load->model('model_member', 'member');
        if(isset($_SESSION['center_userid'])){
            $session_member = new Zend_Session_Namespace('member');
            $session_member->member_id=$_SESSION['center_userid'] ;
            $result_member=$CI->member->fetch($session_member->member_id);
            if(!empty ($result_member)){
                $session_member->sync='yes' ;
                $session_member->member_id=$result_member['user_id'] ;
                $session_member->member_firstname=$result_member['user_firstname'] ;
                $session_member->member_lastname=$result_member['user_lastname'] ;
                $session_member->member_login=$result_member['user_login'] ;
                $session_member->member_role_name=$result_member['role_name'] ;
                $session_member->fb_id=$result_member['fb_id'] ;
            }else{
                $session_member->member_error=1;
                $session_member->sync='no' ;
            }      
        }
    }
}
?>
