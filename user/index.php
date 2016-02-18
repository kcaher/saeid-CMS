<?php
session_start();
if(!isset($_SESSION['username']) || !isset($_SESSION['password']) || ($_SESSION['role']!='user') )
	{header("Location: ../login.php"); exit();}

require "../include/connection.php";

?>

<html>
<head>
<title></title>

<link rel="stylesheet" href="../include/style.css" />
</head>
<body>
<?php
$query="select * from news";
$result=mysqli_query($sql,$query);

$count = mysqli_num_rows($result);

?>

<center>
<ul id="nav3">
<form method=post action=../search.php >
<li><a href=../index.php								>Index</a></li>
<li><a href=../news.php?page=<?php echo $count; ?> 		>News</a></li>
<li><a href=../about.php								>About us</a></li>
<li><a href=../contact.php								>Contact</a></li>

<input type=submit  class=search 				>
<input type=text  	class=search name=word		>
<input type=hidden 	class=search name=title		>
<input type=hidden 	class=search name=content	>
</form>
</ul>
</center>

<hr>
<br>








<?php echo "welcome ". $_SESSION['username']."\n"; ?>

<br>


<ul id="nav2">
<li><a href=user_pass.php			>Change Password</a></li>
<br>
<li><a href=comment.php				>comment</a></li>
<br>
<li><a href=logout.php			 	>Log Out</a></li>

</ul>


<br><br><br><br><br><br>
<div id="footer" >

</div>
</body>
</html>