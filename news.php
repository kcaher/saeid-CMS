<?php 
require "include/connection.php";
session_start();
?>

<html>
<head>
<link rel="stylesheet" href="include/style.css" />
<title>
</title></head>
<body>

<?php
$query="select * from news";
$result=mysqli_query($sql,$query);

$count = mysqli_num_rows($result);
?>

<center>
<ul id="nav3">
<form method=post action=search.php >
<li><a href=index.php								>Index</a></li>
<li><a href=news.php?page=<?php echo $count; ?> 	>News</a></li>
<li><a href=admin									>Admin</a></li>
<li><a href=login.php								>login</a></li>
<li><a href=register.php							>register</a></li>
<li><a href=about.php								>About us</a></li>
<li><a href=contact.php								>Contact</a></li>

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
if(!isset($_GET['page']) && isset($_GET['id']) && is_numeric($_GET['id'])) {
	$id=$_GET['id'];

	$query="select * from news where id=\"$id\" limit 0,1";
	$result=mysqli_query($sql,$query);

	while($row=mysqli_fetch_array($result))		
	{
	 $title=$row['title'];
	 $content=$row['content'];
 	 $title=str_replace('%5c','\\',$title);
	 $content=str_replace('%5c','\\',$content);
	 
	 echo "<div class='title' >title: ".$title ."</div><br>";
	

	 echo "<div class='content' >content:". $content ."</div>";
	 echo "<br>";
	
	 if($row['pic']!=NULL)
		{echo "pic:<br> <img alt=".$row['pic']." height=200 width=300 src=". $row['pic']." />";}
	
	
	 $query="select * from comments where news_id=\"$id\"";
	 $result=mysqli_query($sql,$query);

	 //start add comment
	 if(isset($_SESSION['username']))
		{
		 echo "
				<br><br>comment:<br>
				<form action='' method=post >
				
				<textarea type=text name=contentc cols=50 rows=3 ></textarea>
				<input type=submit 	name=submitc value=submit >
				</form>
			";
		}
		
	 if(isset($_POST['submitc']))
		{
		 $news_id=$_GET['id'];
		 $contentc=$_POST['contentc'];
		 $contentc=str_replace('\\','%5c',$contentc);
		 $contentc=htmlentities($contentc);
		 $query="insert into saeid.comments (news_id,title,content,username) values (\"$news_id\",\"$title\",\"$contentc\",\"$_SESSION[username]\")";

		 if(mysqli_query($sql,$query))
			{echo "<font color=green > ** Your Comment Added successfully.**</font><br>";}
	 
		}
	  //finish add comment
	 
	 
	 //start show comment
	 $query="select * from comments where news_id=$id order by id desc";
	 $result=mysqli_query($sql,$query);
	 while($row=mysqli_fetch_array($result))
		{
		 $row['content']=str_replace('%5c','\\',$row['content']);
		 echo "<font color=orange >$row[username]:</font>";
		 echo $row['content']."<br>";
		 echo "==========================================================<br>";
		}
	 //finish show comment	
		
	}		
}

if(isset($_GET['page']) && is_numeric($_GET['page']) && !isset($_GET['id']))
	{
	 $page=$_GET['page'];

	 $finish=$page*10+1;
	 $start=$finish-11;		

	 $query="select * from news order by id desc limit $start,10 ";
	 $result=mysqli_query($sql,$query);	
	 while($row=mysqli_fetch_array($result))	
		{
		 $title=$row['title'];
		 $title=str_replace('%5c','\\',$title);
		 $id=$row['id'];
		 echo "<ul id=\"nav2\"><li><a href=news.php?id=$id>$title</a></li></ul>";
		 echo "===============================================================================";

		}
			/*shomaresh tedade khabar:start*/	 
			$query="select * from news";
			$result=mysqli_query($sql,$query);
			$count=0;
			while($row=mysqli_fetch_array($result))	
				{
				$count++;
				}
			/*shomaresh tedade khabar:finish*/
			$npage=$count/10;
			echo "<br><ul id=nav4 >Pages:";
			for($z=1;$z<$npage+1;$z++)
				{
				 if($z==$page)
					{echo "<font color=#F3C70E  > $z </font>"; }
				 else
					{echo "<a href=news.php?page=$z> $z </a>";}
				}
			echo "</div>";	
	}
	
	
if(!isset($_GET['id']) && (!isset($_GET['page']) ))	
	{
		$query="select * from news order by id desc limit 0,1";
		$result=mysqli_query($sql,$query);

		while($row=mysqli_fetch_array($result))		
		{
		 $title=$row['title'];
		 $content=$row['content'];
 		 $title=str_replace('%5c','\\',$title);
		 $content=str_replace('%5c','\\',$content);
		 
		 echo "<div class='title' >title: ".$title ."</div><br>";
		 echo "<div class='content' >content:". $content ."</div>";
		
		 if($row['pic']!=null)
			{echo "pic: <br><img alt=".$row['pic']." height=200 width=300 src=". $row['pic']." />";}
			
		 echo "<br>===============================================================================<br>";	
		
		}
		
	} 
	
?>


<br><br><br><br><br><br>
<div id="footer" >

</div>
</body>

</html>
