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

<form action="" method=post enctype="multipart/form-data"  >
title:<br>
<input name=title  type=text   /><font color=red > *</font> <br>
content:<br>
<textarea name=content type=text rows="5" cols="50"  ></textarea> <br>
<br>
<input type=file name=pic /><br><br><br><br>
<input value=Add type=submit />


</form><br>

<?php

if	(    !empty($_POST['title']) 	 &&
		 isset($_POST['content'])	
		  
	)
	{	$uppic=0;
		if(!empty($_FILES['pic']['name']) )
		{
		 $name = "uploads/".$_FILES['pic']['name'];
		 $name=str_replace(' ','_',$name);
		 $type = $_FILES['pic']['type'];
		 $size = $_FILES['pic']['size'];
	 	 $tmp = $_FILES['pic']['tmp_name'];
		 $fileEx = explode('.',$_FILES['pic']['name']);
		 $fileEx = end($fileEx);
		 $fileEx = strtolower($fileEx);
		 $path='/saeid-CMS/admin/'. $name;
		 $path=str_replace('\'','',$path);
		 $path=str_replace('\\','',$path);
		 
			if(
			 ($type   == "image/jpg"   || 
			 $type   == "image/jpeg"  || 
			 $type   == "image/png" ) && 
			 ($fileEx == 'png' 		|| 
			 $fileEx == 'jpg' 		|| 
			 $fileEx == 'jpeg'
			 )
			 )
				{if(move_uploaded_file($tmp,$name))			
					{echo "<font color=green > ** File Successfully Uploaded. **</font><br>"; $uppic=1;}
				else
					{echo "<font color=red > * There Is a Problem While Uploading The File !</font><br>";}
				} 
			else 
				{echo "<font color=red > * use just jpg , jpeg , png files!</font><br>";}
				
		}

	
	 $title=$_POST['title'];
	 $content=$_POST['content'];	
	 
	 
	 //forbidden SQL bug
	 $content=str_replace('\\','%5c',$content);
	 $title=str_replace('\\','%5c',$title);
	 

	 
	 //forbidden XSS bug
	 $title=htmlentities($title);
	 $content=htmlentities($content);
	 
	 if($uppic==1)	
		{$query="insert into saeid.news (title,content,pic) values (\"$title\",\"$content\",\"$path\")";
		 if(!mysqli_query($sql,$query))
			{echo mysqli_error($sql);}
		 else	
			{echo "<font color=green > ** Your Info Saved Successfully in Database. **</font>";}
		}	
	 else
		{$query="insert into saeid.news (title,content) values (\"$title\",\"$content\")";
		 if(!mysqli_query($sql,$query))
			{echo mysqli_error($sql);}
		 else	
			{echo "<font color=green > ** Your Info Saved Successfully in Database. **</font>";}}
	 	 
}
else
	{if(isset($_POST['title']) && empty($_POST['title']))
		{echo "<font color=red >* Title Field is Empty.</font>";}
	}
?>


<br><br><br><br><br><br>
<div id="footer" >
<li><a href="admin.php">Back</a></li>
</div>
</body>
</html>
