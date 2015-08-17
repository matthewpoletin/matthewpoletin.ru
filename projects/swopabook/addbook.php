<div class="leftdesk">
	<div class="regerr">
		<div class="regerrtext">
			<?php
			echo $err_booktitle."<br>";
			echo $err_bookauthor."<br>";
			echo $err_bookabout."<br>";
			echo $err_file."<br>";
			?>
		</div>
	</div>
</div>
<div class="rightdesk">
	<div class="paper">
		<form method="POST" enctype="multipart/form-data" class="addbook">
			<input type="text" name="booktitle" placeholder="Название" value="<?php echo $booktitle; ?>">
			<input type="text" name="author" placeholder="Автор" value="<?php echo $bookauthor; ?>">
			<input type="text" name="bookabout" placeholder="Описание" value="<?php echo $bookabout; ?>">
			<input type="file" name="filename">
			<input type="submit" name="book_submit">
		</form>
	</div>
</div>