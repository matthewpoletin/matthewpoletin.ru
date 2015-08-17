<?php
	$name2="Название второй полки";
	switch ($_GET['p']) {
		case 'main':
			$name2="Популярное";
			break;
		case 'myshelf':
			$name2="Мои книги";
			break;
		default:
			$name2="Популярное";
			break;
	}
?>
<div class="name2">
	<?=$name2?>
</div>