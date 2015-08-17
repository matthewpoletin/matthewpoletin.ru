<?php
$users=$_POST['users'];
	switch ($users)
	{
		case 'Удалить':
			$action_users='deleted';
			break;
		case 'Подтвердить':
			$action_users='accepted';
			break;
		case 'Отклонить':
			$action_users='denied';
			break;
	}
	$books=$_POST['books'];
	switch ($books)
	{
		case 'Удалить':
			$action_books='deleted';
			break;
		case 'Подтвердить':
			$action_books='accepted';
			break;
		case 'Отклонить':
			$action_books='denied';
			break;
	}
?>
<html>
	<head>
		<title>Панель администратора</title>
		<style>
			.header{
				width:100%;
				height:80px;
				}
			.content{
				width:100%;
				position: absolute;
				margin:0 auto;
				}
				.users{
					width:90%;
					float:left;
					position: relative;
					margin:0 auto;
					}
				.books{
					width:90%;
					float:left;
					position: relative;
					margin:0 auto;
					}
		</style>
	</head>
	<body>
		<div class="header">
			<?php
				echo 'Hello!<br>';
				require ('../db_connect.php');
				echo 'Database status: '.$db_connection;
				echo '<br>';

				$p=mysql_query("SHOW CREATE TABLE books");

			?>
			<form method="POST">
				<input type="submit" value="Обновить страницу" name="update"><br>
			</form>
		</div>
		<div class="content">
			<div class="users">
				<form method="POST">
					List of users<br>
					<input type="submit" name="users" value="Удалить">
					<input type="submit" name="users" value="Подтвердить">
					<input type="submit" name="users" value="Отклонить">
					<?php
						$get=mysql_query("SELECT * FROM users") OR die(mysql_error());
						$table="<table border='1px' cellspacing='0'><tr><td ></td><td align='center'>№</td><td align='center'>Name</td><td align='center'>Surname</td><td align='center'>Email</td><td align='center' width='40px'>Date of Birth</td><td width='100px' align='center'>Bio</td><td align='center'>Role</td><td align='center'>Personal Photo</td><td align='center'>Date</td></tr>";
						while ($row_users = mysql_fetch_assoc($get))
						{
							$checked_users=[$row_users['user_id']];
							$table .= "<tr>";
							$table .= "<td align='center'>"."<input type='checkbox' name='".$checked_users."' value='".$row_users['user_id']."'>";
							$table .= "<td align='center'>".$row_users['user_id']."</td>";
							$table .= "<td>".$row_users['name']."</td>";
							$table .= "<td>".$row_users['surname']."</td>";
							$table .= "<td>".$row_users['email']."</td>";
							$table .= "<td>".$row_users['dob']."</td>";
							$table .= "<td>".$row_users['bio']."</td>";
							$table .= "<td align='center'>".$row_users['role']."</td>";
							$table .= "<td><img src='../".$row_users['personalphoto']."' width='90px' height='120px'></td>";
							$table .= "<td>".$row_users['date']."</td>";
							$table .= "</tr>";
						}
						$table .= "</table> ";
						echo $table;
						echo $action_users;
					?>
				</form>
			</div>
			<div class="books">
				<form method="POST">
					List of books<br>
					<input type="submit" name="books" value="Удалить">
					<input type="submit" name="books" value="Подтвердить">
					<input type="submit" name="books" value="Отклонить">
					<?php
						$get=mysql_query("SELECT * FROM books") OR die(mysql_error());
						$table="<table border='1px' cellspacing='0'><tr><td></td><td>№</td><td>Title</td><td>Author</td><td>About</td><td>Cover</td><td>Owner</td><td>Rating</td><td>Status</td></tr>";
						while ($row_books = mysql_fetch_assoc($get))
						{
							$table .= "<tr>";
							$table .= '<td><input type="checkbox" name="'.$row_books['book_id'].'"</td>';
							$table .= "<td>".$row_books['book_id']."</td>";
							$table .= "<td>".$row_books['title']."</td>";
							$table .= "<td>".$row_books['author']."</td>";
							$table .= "<td>".$row_books['about']."</td>";
							$table .= "<td><img src='../".$row_books['cover']."' width='90px' height='120px'></td>";
							$table .= "<td>".$row_books['user_id']."</td>";
							$table .= "<td>".$row_books['rating']."</td>";
							$table .= "<td>".$row_books['status']."</td>";
							$table .= "</tr>";
						}
						$table .= "</table> ";
						echo $table;
						echo $action_books;
					?>
				</form>
			</div>
		</div>
	</body>
</html>