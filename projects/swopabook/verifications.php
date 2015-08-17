<?php
	//registration check
	if($_POST['reg_submit'])
	{
		mb_regex_encoding('UTF-8');
		if (isset($_POST['name'])) $name=$_POST['name'];
		if (isset($_POST['surname'])) $surname=$_POST['surname'];
		if (isset($_POST['email'])) $email=$_POST['email'];
		if (isset($_POST['pass1'])) $pass1=$_POST['pass1'];
		if (isset($_POST['pass2'])) $pass2=$_POST['pass2'];
		if (isset($_POST['bio'])) $bio=$_POST['bio'];
		if (isset($_POST['avatar'])) $avatar=$_POST['avatar'];
		if (isset($_POST['captcha'])) $captcha=$_POST['captcha'];

		$example_name="/^[a-zA-Zа-яА-ЯёЁ]{2,30}$/iu";
		$example_surname="/^[a-zа-яё]{2,30}$/iu";
		$example_email="/^[a-z0-9_\.\-]+@([a-z0-9\-]+\.)+[a-z]{2,6}$/is";

		//name check
		if ($name=='') $err_reg_name="Вы не ввели имя";
		else
		{
			if (!preg_match($example_name,$name)) $err_reg_name='Неверное имя.';
		}
		//surname check
		if ($surname=='') $err_reg_surname="Вы не ввели фамилию";
		else
		{
			if (!preg_match($example_surname,$surname)) $err_reg_surname='Неверная фамилия';
		}
		//email check
		if ($email=='') $err_reg_email='Вы не ввели адрес E-mail';
		else
		{
			if (!preg_match($example_email,$email) OR strlen($email)>50)
			{
				$err_reg_email = "Неверный адрес E-mail";
			}
			else
			{
				require ('db_connect.php');
				$q=mysql_query("SELECT * FROM users WHERE email='$email'");
				if (mysql_num_rows($q)!=0)
				{
					$err_reg_email="Такой адрес email уже зарегестрирован";
				}
				require('db_disconnect.php');
			}
		//	else
		//	{
		//		require ('db_connect.php');
		//		$q=mysql_query("SELECT * FROM users WHERE email='$email'");
		//		if($q==true)
		//		{ 
		//			$err_reg_email="Такой адрес email уже зарегестрирован"; 
		//		}
		//		require('db_disconnect.php');
		//	}		
		}
		//pass1 check
		if ($pass1=='') $err_reg_pass1="Вы не ввели пароль";
		//pass2 check
		if ($pass2=='') $err_reg_pass2="Повторите пароль";
		//pass1==pass2
		if ($pass1!=$pass2) $err_reg_pass='Пароли не совпадают.';
		//personalphoto check
		require('uploading.php');
		//captcha check
		if ($captcha!='7') $err_reg_captcha='Докажите, что вы не робот.';
		//no mistakes
		if (($err_reg_name=='')AND($err_reg_surname=='')AND($err_reg_email=='')AND($err_reg_pass1=='')AND($err_reg_pass2=='')AND($err_reg_pass=='')AND($err_file=='')AND($err_reg_captcha==''))
		{
			$password=md5($pass1);
			$dob=$_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
			$status="user";
		//	$today = date("Y-m-d");
			require('db_connect.php');
			copy($_FILES["filename"]["tmp_name"],$filepath);
			$send=mysql_query("INSERT INTO users VALUES('','$name','$surname','$email','$password','$dob','$bio','user','$filepath','')") OR die(mysql_error());
			require('db_disconnect.php');
			$reg_success="Регистрация прошла успешно.";
			$_GET['p']='main';
		}
	}

	//books check
	if ($_POST['book_submit'])
	{
		mb_regex_encoding('UTF-8');
		$booktitle=$_POST['booktitle'];
		$bookabout=$_POST['bookabout'];
		$bookauthor=$_POST['author'];

		//booktitle check
		if ($booktitle=='') $err_booktitle='Введите название книги';
		//bookauthor check
		if ($bookauthor=='') $err_bookauthor='Введите автора книги';
		//bookabout check
		if ($bookabout=='') $err_bookabout='Введите описание книги';
		//bookcover check
		require('uploading.php');
		//проверка на наличие ошибок
		if (($err_booktitle=='')AND($err_author=='')AND($err_bookabout=='')AND($err_file==''))
		{
			$owner=$_SESSION['user_id'];
			$rating=5;
			move_uploaded_file($_FILES["filename"]["tmp_name"],$filepath);
			require('db_connect.php');
			$insert="INSERT INTO books VALUES('','$booktitle','$bookauthor','$bookabout','$filepath','$owner','$rating','new')";
			$send=mysql_query($insert) OR die(mysql_error());
			require('db_disconnect.php');
			$_GET['p']='book';
			require('db_connect.php');
			echo $booktitle;
			$query="SELECT * FROM books WHERE title='$booktitle'";
			$result=mysql_query($query);
			$book_id=mysql_fetch_array($result);
			$_GET['book_id']=$book_id['book_id'];
			require('db_disconnect.php');
		}
	}
?>