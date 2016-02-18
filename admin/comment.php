<?php
session_start();
if(!isset($_SESSION['username']) || !isset($_SESSION['password']) || ($_SESSION['role']!='admin') )
	{header("Location: ../login.php"); exit();}

require "../include/connection.php";

?>

<html>
<head>
<title>ADMIN-COMMENTS</title>

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
<li><a href=admin.php									>Admin</a></li>
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

if(isset($_GET['page']) && is_numeric($_GET['page']) )
{$page=$_GET['page'];


/*shomaresh tedade comment:start*/

$query="select * from comments";
$result=mysqli_query($sql,$query);

$count = mysqli_num_rows($result);

/*shomaresh tedade comment:finish*/

$finish=$page*10+1;
$start=$finish-11;	

$query="select * from comments order by id desc limit $start,10 ";
$result=mysqli_query($sql,$query);	
while($row=mysqli_fetch_array($result))	
	{
	 $title=$row['title'];
	 $title=str_replace('%5c','\\',$title);
	 $content=$row['content'];
	 $content=str_replace('%5c','\\',$content);
	 $news_id=$row['news_id'];
	 $id=$row['id'];
	 
	 echo $username.":";
	 echo "<ul id=\"nav2\"><li><font color=orange > New's Title : </font><a href=../news.php?id=$news_id>$title<br></a> <font color=orange >Your Content:</font> <font color=green >$content</font><br>";
	 echo "<a href=comment.php?page=1&delid=$id> Remove</a>";
	 echo "<a href=manager.php?ediid=$id> Edit</a></li></ul><br>";
	}

$npage=$count;
$npage=$npage/10;

echo "<br><ul id=nav4 >Pages:";
for($z=1;$z<$npage+1;$z++)
	{
	 if($z==$page)
		{echo "<font color=#F3C70E  > $z </font>"; }
	 else
		{echo "<a href=comment.php?page=$z> $z </a>";}
	}
echo "</div>";	
}




//*********************************************//


if(!isset($_GET['page']))
{
$query="select * from comments order by id desc";
$result=mysqli_query($sql,$query);
while($row=mysqli_fetch_array($result))
	{ 
	 $username=$row['username'];
	 $title=$row['title'];
	 $title=str_replace('%5c','\\',$title);
	 $content=$row['content'];
	 $content=str_replace('%5c','\\',$content);
	 $news_id=$row['news_id'];
	 $id=$row['id'];
	 
	 echo $username.":";
	 echo "<ul id=\"nav2\"><li><font color=orange > New's Title : </font><a href=../news.php?id=$news_id>$title<br></a> <font color=orange >Your Content:</font> <font color=green >$content</font><br>";
	 echo "<a href=comment.php?page=1&delid=$id> Remove</a>";
	 echo "<a href=comment_edit.php?ediid=$id> Edit</a></li></ul><br>";
	}


}	

if(isset($_GET['delid']) && is_numeric($_GET['delid']))
	{
	 $id=$_GET['delid'];
	 $query="delete from comments where id=$id";
	 if(!mysqli_query($sql,$query))
		{echo mysqli_error($sql);}
	}
	
?>



<br><br><br><br><br><br>
<div id="footer" >

</div>
</body>
</html>