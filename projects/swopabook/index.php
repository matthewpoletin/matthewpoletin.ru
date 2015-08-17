<?php
	session_start();
	require('verifications.php');
	require('whatpage.php');
?>
<html>
	<head>
		<title>Swop a Book | <?=$p_title?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"/>
		<link rel="stylesheet" type="text/css" href="style.css"/>
	</head>
	<body>
		<div class="content">
			<?php switch ($p_type)
			{
				case 'shelf':
					echo "<div class='shelf'>";
					break;
				case 'desk':
					echo "<div class='desk'>";
					break;
				case 'wall':
					echo "<div class='wall'>";
					break;
				default:
					echo "<div class='shelf'>";
					break;
			}
			?>
				<div class="header">
					<a href="/?"><div class="title"></div></a>
					<div class="diary">
						<?php
							if ($_SESSION['status']==1) require('diary.php');
							else require('auth.php');
						?>
					</div>
					<div class="personalinfo">
						<?php
							if($_SESSION['status']==1)
							{
								require('db_connect.php');
								$user_id=$_SESSION['user_id'];
								$query="SELECT personalphoto FROM users WHERE user_id='$user_id'";
								$result=mysql_query($query);
								$result_arr=mysql_fetch_array($result);
								$personalphoto=$result_arr['personalphoto'];
								require('db_disconnect.php');
								$personalname=$_SESSION['name']." ".$_SESSION['surname'];
							}
							else $personalphoto="images/q.png";
						?>
						<div class="personalimage">
							<img src="<?=$personalphoto?>" width="80px" height="71px">
						</div>
						<div class="personalframe">
							<div class="personalname">
								<?=$personalname?>
							</div>
						</div>
					</div>
				</div>
				<div class="main">
					<?php
						switch ($p_type)
						{
							case 'shelf':
								require('name2.php');
								require('line2.php');
								require('name3left.php');
								require('name3right.php');
								echo '<div class="line3">';
								require('line3left.php');
								require('line3right.php');
								echo "</div>";
								break;
							case 'desk':
								echo '<div style="width:890px; height:14px;"></div>';
								require('maindesk.php');
								break;
							case 'wall':
								require('mainwall.php');
								break;
							default:
								require('name2.php');
								require('line2.php');
								require('name3left.php');
								require('name3right.php');
								echo '<div class="line3">';
								require('line3left.php');
								require('line3right.php');
								echo "</div>";
								break;
						}
					?>
				</div>
				<div class="footer">
					<div class="sidemenu">
						<a href="?p=map"><div class="map"></div></a>
					</div>
					<div class="users">
					</div>
					<div class="social">
						<a href="http://twitter.com/swopabook"><div class="twitter"></div></a>
						<a href="http://vk.com/swopabook"><div class="vk"></div></a>
						<a href="http://facebook.com/swopabook"><div class="fb"></div></a>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>