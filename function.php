<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="function.css">
</head>
<body>
<?php
session_start();
function signup($conn)
{
	
if(isset($_POST['signup']))
  {
	echo "<div class='info'>";
$name=$_POST['name'];
$uid=$_POST['uid'];
$pwd=$_POST['pwd'];
$dep=$_POST['dep'];
$status=$_POST['status'];
if(empty($name)||empty($uid)||empty($pwd)||empty($pwd)||empty($status))
{
	header("Location:main.php?error=empty");
	exit();
}
else{
echo"</div>";
$sql="INSERT INTO profile(name,uid,pwd,dep,status) VALUES('$name','$uid','$pwd','$dep','$status')";
$result=$conn->query($sql);
  }
}
else
  echo "not set";
}
function setpost($conn)
{
if(isset($_POST['submit']))
{
$post=$_POST['post'];
$pk=$_POST['pk'];
$sector=$_POST['sector'];
$catagory=$_POST['catagory'];
$sql="INSERT into post(pk,post,sector,catagory) VALUES('$pk','$post','$sector','$catagory')";
$result=$conn->query($sql);
}


}

function getpost($conn,$sector,$catagory)
{
$sql="SELECT * from post where sector='$sector' and catagory='$catagory' order by pk desc";
$result=$conn->query($sql);
if(mysqli_num_rows($result)>0)
	{ 
         echo "News Feed</br>";
     while ($row=$result->fetch_assoc()) {
     	$p=$row['pk'];
     	$sql1="SELECT name from profile where pk='$p'";
     	$result1=$conn->query($sql1);
     	$row1=$result1->fetch_assoc();
   	
     	echo "<div class='post'><p>".$row1['name']."</br>".nl2br($row['post'])."</br>".$row['date']."</br></br></p></div>";
      }
    }
}
function logout($conn)
{
	if(isset($_POST['logout']))
  {
	session_destroy();
    header("Location:main.php");
  }
}

function setmessage($conn)
{
if(isset($_POST['sent']))
{

$fuid=$_POST['uid'];
$tuid=$_POST['tuid'];
$message=$_POST['message'];
    if(empty($fuid)||empty($tuid)||empty($message)||$fuid==$tuid)
      echo "condition: not sent...</br>";
    else{
	$sql="INSERT into message(fuid,tuid,message) values('$fuid','$tuid','$message')";
    $result=$conn->query($sql);
    echo "condition: sent !!</br>";
    }
}
}
function getmessage($conn,$uid){
$sql="SELECT * from message where tuid='$uid'";
$sql2="SELECT * from message where fuid='$uid'";
$result=$conn->query($sql);
$result2=$conn->query($sql2);
if (mysqli_num_rows($result)>0)
while($row=$result->fetch_assoc())
	echo "<div class='message'><p>Received from:".$row['fuid']."</br>".nl2br($row['message'])."</br>".$row['date']."</br>";
if (mysqli_num_rows($result2)>0)
while($row2=$result2->fetch_assoc())
	echo "Sent to:".$row2['tuid']."</br>".nl2br($row2['message'])."</br>".$row2['date']."</br></p></div>";


}





?>
</body>
</html>