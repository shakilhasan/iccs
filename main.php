<?php
include 'connect.php';
include 'function.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>UMMAH</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
<div class="head">
<div class="heading"><h1>INTRA UNI COMMUNICATION SYSTEM</h1> </div>
<div class="login">
    <?php
//login............................
   echo "
   <form method='post' action='profile.php'>
  <input type='text' name='uid' placeholder='username/id'></br>
  <input type='password' name='pwd' placeholder='password'></br>
  <input type='submit' name='login' value='LOG IN'>
  </form>
   ";
   ?>
   </div>
 </div>  
   <div class="signup">
    <?php
//logo && signup................    
echo "
<img src='cuet_logo.png'/>
<form method='post' action='".signup($conn)."' >
<input type='text' name='name' placeholder='name'></br>
<input type='text' name='uid' placeholder='username/id'></br>
<input type='password' name='pwd' placeholder='password'></br>
<select name='status'>
<option value='dept.head'>Dept.HEAD</option>
<option value='teacher'>TEACHER</option>
<option value='student'>STUDENT</option>
</select>
<select name='dep'>
<option value='cse'>CSE</option>
<option value='eee'>EEE</option>
<option value='civil'>CIVIL</option>
<option value='me'>ME</option>
<option value='urp'>URP</option>
<option value='ete'>ETE</option>
<option value='pme'>PME</option>
<option value='cwre'>CWRE</option>
<option value='mie'>MIE</option>
</select></br>
<input type='submit' name='signup' value='SIGN UP'>
</form>
";
    ?>
    </div>

</body>
</html>>