<?php
session_start();
if(!isset($_SESSION['username']) || !isset($_SESSION['password']) || ($_SESSION['role']!='user') )
	{header("Location: ../login.php"); exit();}

require "../include/connection.php";

?>

<html>
<head>
<title>USER-COMMENTS</title>

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

<?php 
$username=$_SESSION['username'];
$query="select * from comments where username='$username'";
$result=mysqli_query($sql,$query);
while($row=mysqli_fetch_array($result))
	{
	 $title=$row['title'];
	 $title=str_replace('%5c','\\',$title);
	 $content=$row['content'];
	 $content=str_replace('%5c','\\',$content);
	 $news_id=$row['news_id'];
	 $id=$row['id'];
	 
	 echo "<ul id=\"nav2\"><li><font color=orange > New's Title : </font><a href=../news.php?id=$news_id>$title<br></a> <font color=orange >Your Content:</font> <font color=green >$content</font><br>";
	 echo "<a href=comment.php?delid=$id> Remove</a>";
	 echo "<a href=comment_edit.php?ediid=$id> Edit</a></li></ul><br>";
	}

if(isset($_GET['delid']))
	{
	 $id=$_GET['delid'];
	 $query="select username from comments where id=$id";
	 $result=mysqli_query($sql,$query);
	 if($result=$username)
		{
		 $query="delete from comments where id=$id";
		 mysqli_query($sql,$query);
		}
	}
?>



<br><br><br><br><br><br>
<div id="footer" >

</div>
</body>
</html>