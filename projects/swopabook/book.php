<?php
	$book_id=$_GET['book_id'];
	require('db_connect.php');
	$query="SELECT * FROM books WHERE book_id='$book_id'";
	$result=mysql_query($query);
	$result_arr=mysql_fetch_array($result);
	require('db_disconnect.php');
	//author
	$bookauthor=$result_arr['author'];
	//about
	$strlen=strlen($result_arr['about']);
	$max=287;
	if ($strlen>$max)
	{
		$bookabout="&emsp;".substr($result_arr['about'], 0, $max)."...";
	}
	else $bookabout="&emsp;".$result_arr['about'];
?>
<div class="leftdesk">
	<div class="deskbookshadow">
		<img src="<?=$result_arr['cover']?>" width="198px" height="267px">
	</div>
</div>
<div class="rightdesk">
	<div class="paper">
		<div class="bookdescription">
			<div class="booktitle">
				<center><b><?=$result_arr['title']?></b></center>
			</div>
			<div class="bookauthor">
				<center><?=$bookauthor?></center>
			</div>
			<div class="bookabout">
				<?=$bookabout?>
			</div>
		</div>
	</div>
</div>