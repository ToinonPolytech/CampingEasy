<?php 
require_once("user.controller.class.php");
class Controller_Client extends Controller_User
{
	public function canEdit($o){
		if ($this->_user->getUserInfos()->getId()==$o->_user->getUserInfos()->getId())
		{
			if ($this->can(CAN_CREATE_SUBACCOUNT))
				return true;
		}
		return false;
	}
}
	
	
	
	
	
	

?>