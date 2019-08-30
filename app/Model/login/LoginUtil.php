<?php

namespace Model\login;


class LoginUtil {
	
	public static function isNotLogin($session){
		return is_null($session['user_info']) ;
	}

	public static function validate($session){
		if(self::isNotLogin($session)){
			var_dump(333);
			//nothing
		}else{
			var_dump(4);
			header('Location: /');
		}
	}
}