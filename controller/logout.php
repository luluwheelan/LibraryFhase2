<?php
	require_once('../session/session.php');
	require_once('../model/class.user.php');
	$user_logout = new USER();
	
	if($user_logout->is_loggedin()!="")
	{
		$user_logout->redirect('../view/profile.php');
	}
	if(isset($_GET['logout']) && $_GET['logout']=="true")
	{
		$user_logout->doLogout();
		$user_logout->redirect('../view/sign_in.php');
	}
