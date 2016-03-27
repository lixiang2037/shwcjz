<?php
namespace Home\Behaviors;
use Think\Behavior;
class CheckUserBehavior extends Behavior
{
	public function run(&$params)
    {
        $this->checkLogin();
    }

    public function checkLogin()
    {
    	if(CONTROLLER_NAME === 'User' || CONTROLLER_NAME === 'Index' || CONTROLLER_NAME === 'Service'){
    		return true; 
    	}
    	if(ACTION_NAME === 'index' || ACTION_NAME === 'login'|| ACTION_NAME === 'logout' || ACTION_NAME === 'verify'){
    		return true; 
    	}
        if(is_user_login() === 0){
       		redirect(C(WWW_GK_COM)."/user/login"); 
        }else {
        	return true;
        }
    }
}