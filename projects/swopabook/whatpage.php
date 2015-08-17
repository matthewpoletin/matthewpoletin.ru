<?php
	//auth exit
	if ($_GET['status']=='exit')
	{
		unset($_SESSION['status']);
		unset($_SESSION['login']);
		unset($_SESSION['user_id']);
		unset($_SESSION['name']);
		unset($_SESSION['surname']);
		unset($_SESSION['role']);
	}
	//auth check
	if ($_POST['auth_submit'])
	{
		$login=$_POST['login'];
		$password=$_POST['password'];
		if ($login=='' OR $password=='')
		{
			$err_auth = 'Вы не ввели логин или пароль.';	
		}
		else
		{
			$password=md5($password);
			require('db_connect.php');
			$auth=mysql_query("SELECT * FROM users WHERE email='$login' AND password='$password'");
			require('db_disconnect.php');
			if(mysql_num_rows($auth)==0)
			{
				$err_auth = 'Логин или пароль введены неправильно.';
			}
		}
		if ($err_auth=='')
		{
			$_SESSION['status']='1';
			//login
			$_SESSION['login']=$login;
			require('db_connect.php');
			$user_info_query=mysql_query("SELECT * FROM users WHERE email='$login'",$db);
			$user_info=mysql_fetch_array($user_info_query);
			//user_id
			$_SESSION['user_id']=$user_info['user_id'];
			//name
			$_SESSION['name']=$user_info['name'];	
			//surname
			$_SESSION['surname']=$user_info['surname'];	
			//role
			$_SESSION['role']=$user_info['role'];
			require('db_disconnect.php');
			$GET['p']='myshelf';
		}
		else
		{
			$_GET['p']='main';
		}

	}
	//page infos
		switch ($_GET['p'])
		{
			case 'registration':
				$p_type="desk";
				$p_title="Регистрация";
				break;
			case 'map':
				$p_type="wall";
				$p_title="Карта сайта";
				break;
			case 'auth':
				$p_type="desk";
				$p_title="Авторизация";
				break;
			case 'myshelf':
				$p_type="shelf";
				$p_title="Моя полка";
				break;
			case 'addbook':
				$p_type="desk";
				$p_title="Добавить книгу";
				break;
			case 'book':
				$p_type="desk";
				$p_title="Книга";
				break;
			case 'main':
				$p_type="shelf";
				$p_title="Главная";
				break;
			default:
				$p_type="shelf";
				$p_title="Главная";
				break;
		}
?>
