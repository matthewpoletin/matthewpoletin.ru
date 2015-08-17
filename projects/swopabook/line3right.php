<div class="line3right">
	<?php
		$book_link="?p=book&book_id=";
//		function get_books()
//		{
			require('db_connect.php');
			switch ($p_title) {
				//main
				case 'Главная':
					$query="SELECT * FROM books ORDER BY rating";
					break;
				case 'Моя полка':
					$user_id=$_SESSION['user_id'];
					$query="SELECT * FROM books WHERE user_id='$user_id' ORDER BY book_id";
					break;
				case 'Полка':
					$query="SELECT * FROM books WHERE user_id='$user_id' ORDER BY book_id";
					break;
			}
			$result=mysql_query($query);
			$res_array=array();
			$count=0;
			while($row=mysql_fetch_array($result))
			{
				$res_array[$count]=$row;
				$count++;
			}
			$result=$res_array;
			require('db_disconnect.php');
//			return $result;
//		}
	?>

	<?php
//		$book=get_books();
		$book=$result;
		$i = 0;
		foreach ($book as $item):
	?>
	<div class="bookshadow">
		<div class="book">
			<a href="<?=$book_link.$item['book_id']?>">
				<img width="90px" height="120px" src="<?=$item['cover']?>" alt="<?=$item['book_id']?>">
			</a>
		</div>
	</div>
	<?php
		$i++;
		if ($i==4) break;
		endforeach;
	?>
</div>