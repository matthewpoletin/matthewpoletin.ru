<?php
	switch ($_GET['p'])
	{
		case 'registration':
			require('registration.php');
			break;
		case 'addbook':
			require('addbook.php');
			break;
		case 'book':
			require('book.php');
			break;
		default:
			echo "Ошибка 404!<br>";
			echo "Эта страница удалена или ещё не создана";
			break;
	}
?>