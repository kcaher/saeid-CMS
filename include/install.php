<?php 


session_start(); 

if( ($_SESSION['username']!="admin" ) && ($_SESSION['username']!="<br><font color=red> ** PLEASE INSTALL DATABASE.**</font>" ) && ($_SESSION['role']!="admin") )
{
	header("Location: ../admin/");
	exit();
}

require "connection.php";

?>

<html>

<link rel=stylesheet href="style.css"  />
<title>welcome saeid</title>
<body>

<?php
$query="select * from news";
$result=mysqli_query($sql,$query);

$count = mysqli_num_rows($result);


?>

<center>
<ul id="nav3">
<form method=post action=search.php >
<li><a href=<?php echo dirname($_SERVER['PHP_SELF']);?>/../index.php							>Index</a></li>
<li><a href=<?php echo dirname($_SERVER['PHP_SELF']);?>/../news.php?page=<?php echo $count; ?>	>News</a></li>
<li><a href=<?php echo dirname($_SERVER['PHP_SELF']);?>/../admin								>Admin</a></li>
<li><a href=<?php echo dirname($_SERVER['PHP_SELF']);?>/../register.php							>register</a></li>
<li><a href=<?php echo dirname($_SERVER['PHP_SELF']);?>/../about.php							>About us</a></li>
<li><a href=<?php echo dirname($_SERVER['PHP_SELF']);?>/../contact.php							>Contact</a></li>

<input type=submit  class=search 				>
<input type=text  	class=search name=word		>
<input type=hidden 	class=search name=title		>
<input type=hidden 	class=search name=content	>
</form>
</ul>
</center>

<hr>

<br>




<?php 


$query="DROP DATABASE saeid";
mysqli_query($sql,$query);

$query="CREATE DATABASE saeid ";
	if (mysqli_query($sql,$query))
		{echo " the 'saeid' database crated successfully";echo "<br><br>";}
	else 
		{echo "an error occurred : " . mysqli_error($sql);echo "<br><br>";}

		
		
			//*************************************************//	
			
			
			
$query = "
create TABLE saeid.news(
id INT NOT NULL AUTO_INCREMENT,
title CHAR(255) NOT NULL,
content LONGTEXT NOT NULL,
pic TEXT,
UNIQUE KEY(title),
PRIMARY KEY(id)
)";

if(mysqli_query($sql,$query))
		{echo "the 'news' table created successfully<br><br>";}
	else
		{echo "an error occurred : ".mysqli_error($sql)."<br><br>";}

		
		
		//*************************************************//		

		
		
		
$query = "
create TABLE saeid.users(
id INT NOT NULL AUTO_INCREMENT,
username CHAR(30) NOT NULL,
password CHAR(50) NOT NULL,
mail CHAR(70) NOT NULL,
active_code CHAR(50),
status INT,
PRIMARY KEY(id),
UNIQUE KEY(username),
UNIQUE KEY(mail)
)";

if(mysqli_query($sql,$query))
		{echo "the 'users' table created successfully<br><br>";}
	else
		{echo "an error occurred : ".mysqli_error($sql)."<br><br>";}

		
		
			//*************************************************//	
$query = "
create TABLE saeid.comments(
id INT NOT NULL AUTO_INCREMENT,
news_id INT NOT NULL,
username CHAR(30) NOT NULL,
title CHAR(255) NOT NULL,
content LONGTEXT NOT NULL,
PRIMARY KEY(id)
)";

if(mysqli_query($sql,$query))
		{echo "the 'comments' table created successfully<br><br>";}
	else
		{echo "an error occurred : ".mysqli_error($sql)."<br><br>";}

		
		
			//*************************************************//	

			
$query = "
create TABLE saeid.admins(
id INT NOT NULL AUTO_INCREMENT,
username CHAR(30) NOT NULL,
password CHAR(50) NOT NULL,
status INT,
PRIMARY KEY(id),
UNIQUE KEY(username)
)";

if(mysqli_query($sql,$query))
		{echo "the 'admins' table created successfully<br><br>";}
	else
		{echo "an error occurred : ".mysqli_error($sql)."<br><br>";}

		
		
			//*************************************************//				


			
$query = "insert into saeid.admins (username,password,status) values ('admin','admin','1')";


if(mysqli_query($sql,$query))
		{echo "Inserted data correctly into 'admins' table. ";echo "<br><br>";}
	else 
		{echo "an error occurred : " . mysqli_error($sql);echo "<br><br>";}

		
		
			//*************************************************//	
			
			
session_destroy();			


?>
<br><br><br><br><br><br>

</div>

</body>
</html>