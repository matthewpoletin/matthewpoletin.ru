<?php
	// если загружен файл
	if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
	{
		//если изображение
		if ($_FILES['filename']['type'] == "image/gif" OR $_FILES['filename']['type'] == "image/jpeg" OR $_FILES['filename']['type'] == "image/png")
		{
			$filetype=substr($_FILES['filename']['name'], strrpos($_FILES['filename']['name'], '.')+1);

			switch ($_GET['p'])
			{
				case 'addbook':
					$filedir="archives/bookcover/";
					$filepath=$filedir.$_SESSION['user_id'].'_'.$booktitle.'.'.$filetype;
					break;
				case 'registration':
					$filedir="archives/personalphotos/";
					$filepath=$filedir.$surname.'_'.$name.'.'.$filetype;
					break;
				}
		}
		//если не изображение
		else
		{
			$err_file='Выбранный файл не является изображением';
		}
	}
	else
	{
		$err_file='Вы не выбрали фото';
	}
?>