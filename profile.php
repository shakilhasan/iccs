<?php
include 'function.php';
include 'connect.php';

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="profile.css">
</head>
<body>
<?php
$uid=$_POST['uid'];
$pwd=$_POST['pwd'];
$sql="SELECT * from profile where uid='$uid' and pwd='$pwd'";
$result=$conn->query($sql);
if(!$row=$result->fetch_assoc())
{
    echo "username/id  or password is invalid ???";
    header("Location:main.php?error=empty");
 // exit();
}
else
   {
   	$_SESSION['id']=$row['pk'];
     echo"<ul>
          <li><a href=''>profile</a></li>
          <li><a href=''>message</a></li>
          <li><a href=''>teachers</a></li>
          <li><a href=''>students</a></li>
          <li>
          <form method=post action='".logout($conn)."'>
          <input type='hidden' name='uid' value='".$uid."'>
          <input type='hidden' name='pwd' value='".$pwd."'>
          <input type='submit' name='logout' value='LOGOUT'>
          </li>
   	      </ul>  ";
   	  if($row['status']=='student')
        $sector=substr($uid,0,4);
   	  else
   	   	$sector=$row['dep'];
  
   	 //NAME...................	
         echo "<div class='name'></br>NAME:  ".$row['name']."</br>STATUS:  ".$row['status']."</br>DEPARTMENT:  ".$row['dep']."</div>";
      
     //POST.................
         echo "<div class='post'>";
         echo "
         <form method='post' action='".setpost($conn)."'>
         <input type='hidden' name='uid' value='".$uid."'>
         <input type='hidden' name='pwd' value='".$pwd."'>
         <input type='hidden' name='pk' value='".$row['pk']."'>
         <input type='hidden' name='sector' value='".$sector."'>
         <input type='hidden' name='catagory' value='post'>
         <textarea name='post'> </textarea></br>
         <input type='submit' name='submit' value='POST'></input>
         </form>
         </div>  ";
         getpost($conn,$sector,'post');
       
     //message...................... 
       echo "<div class='message'>
       <form action='".setmessage($conn)."' method='post'>
       <textarea name='message' placeholder='write message'></textarea></br>
       TO:<input type='text' name='tuid' placeholder='username'></br>
       <input type='hidden' name='uid' value='".$uid."'>
       <input type='hidden' name='pwd' value='".$pwd."'>
       <input type='submit' name='sent' value='SENT'>
       </form> ";
       getmessage($conn,$uid);
       echo "</div>";
    
     //NOTICE.....................
    if($row['status']!='student')
      {
              echo "
              <form mathod='post' action='".setpost($conn)."'>
              <input type='hidden' name='uid' value='".$uid."'>
              <input type='hidden' name='pwd' value='".$pwd."'>
              TEXT:<textarea name='post'></textarea></br>
              GROUPH:<input type='text' name='sector' placeholder='04/cse'></br>

              CATAGORY:<select name='catagory'>
              <option value='notice'>notice</option>
              <option value='post'>post</option>
              </select></br>
              <input type='hidden' name='pk' value='".$row['pk']."'>
              <input type='submit' name='submit' value='SUBMIT'>
              </form>
              ";
                 }
    else{
     	echo "</br>NOTICE:</br>";
        getpost($conn,$sector,'notice');
         }  
}

?>
</body>
</html>