<?php
session_start();
if(!isset($_SESSION['username']) || !isset($_SESSION['password']) || $_SESSION['role']!='admin')
{header("Location: index.php");exit();}

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

<ul id="nav">

<li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/../index.php							">Index</a></li>
<li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/../news.php?page=<?php echo $count;?>	">News</a></li>
<li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>										">Admin</a></li>
<li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/../about.php							">About us</a></li>
<li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/../contact.php							">Contact</a></li>

</ul>
</center>
<hr>
<br>

<?php 
//editor news
if(isset($_GET['eid']) && is_numeric($_GET['eid'])) 
	{$eid=$_GET['eid'];

				$query="select * from news where id=$eid ";
				$result=mysqli_query($sql,$query);

				while($row=mysqli_fetch_array($result))
				{	$eid=$row['id'];
					$title=$row['title'];
					$content=$row['content'];
				    $title=str_replace('%5c','\\',$title);
					$content=str_replace('%5c','\\',$content);
				}
		
		echo "
		<form action='' method=post >
		title :   <input type=text name=title value=$title ><br><br>
		content :<br> <textarea  cols=50 rows=5 type=text name=content value=$content >$content</textarea>
		<input type=submit name=submit value=Edit >
		</form>";	
			
		if(isset($_POST['submit']))
			{
				$title=$_POST['title'];
				$content=$_POST['content'];
				
				//forbidden SQL bug
				$content=str_replace('\\','%5c',$content);
				$title=str_replace('\\','%5c',$title);
	 

	 
				//forbidden XSS bug
				$title=htmlentities($title);
				$content=htmlentities($content);
				
				$redirect=$_SERVER['HTTP_REFERER'];
				$query="update saeid.news set title='$title' , content='$content' where id='$eid' ";
				if(mysqli_query($sql,$query))
					{header("Location: $redirect");exit();}
				
			}
	}
?>
 
<?php 
//remove and delete news
if(isset($_GET['rid']) && is_numeric($_GET['rid']) )
	{$rid=$_GET['rid'];
 	 $redirect=$_SERVER['HTTP_REFERER'];
	 $query="delete from news where id=$rid ";
	 if(mysqli_query($sql,$query))
		{header("Location: $redirect");exit();}
		
	}
?>
 
 
<?php 
//editor comment
$username=$_SESSION['username'];
if(isset($_GET['ediid']) && is_numeric($_GET['ediid'])) 
	{
	 $ediid=$_GET['ediid'];
	 $query="select * from comments where id=$ediid ";
	 $result=mysqli_query($sql,$query);
	 while($row=mysqli_fetch_array($result))
		{	
		 $eid=$row['id'];
		 $content=$row['content'];
		 $content=str_replace('%5c','\\',$content);
		}
		
	 echo "
		 <form action='' method=post >
		 comment :<br> <textarea  cols=50 rows=3 type=text name=content value=$content >$content</textarea>
		 <input type=submit name=submit value=Edit >
		 </form>";	
	
		 if(isset($_POST['submit']))
			 {
			 $content=$_POST['content'];
			
			 //forbidden SQL bug
			 $content=str_replace('\\','%5c',$content);
 	 
			 //forbidden XSS bug
			 $content=htmlentities($content);
			
			 $query="update comments set content='$content' where id='$ediid' ";
			 if(mysqli_query($sql,$query))
				{echo "<font color=green > ** Your Content Edited Successfully. **</font>";}
			}
				

	}
?> 
<br><br><br><br><br><br>
<div id="footer" >
<li><a href="admin.php ">Back</a></li>
</div>
</body>
</html>
	
		