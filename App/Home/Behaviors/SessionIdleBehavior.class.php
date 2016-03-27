<?php
namespace Home\Behaviors;
use Think\Behavior;

class SessionIdleBehavior extends Behavior
{
    public function run(&$params)
    {
        $this->checkSessionIdle();
    }

    public function checkSessionIdle()
    {
        if(is_null(session('idle'))){ return; }
		
        if(time() <= session('idle')){
            session('idle', time()+C('SESSION_IDLE'));
        }else{
            //清空session
            session('[destroy]');
        }
    }
}