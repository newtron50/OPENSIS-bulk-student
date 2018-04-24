<?php
echo '<link href="./images/upload.css" rel="stylesheet" type="text/css">';
echo '<div style="padding-top:50px;margin-left:250px;"><div style="width:60%;padding-top:40px;padding-bottom:20px;padding-left:30px;padding-right:30px;border:1px solid;background-color:#d7dee8;font-family:arial;">';
echo '<center><h2>Opensis Mass Student Upload:: testconfig</h2></center>';
$dbcheck=3;
require(dirname(__FILE__).'/config.php');
if ($dbcheck==1) {
echo '<p style="color:green;font-style:bold;">Ready to upload csv file</p>';
} else {
  echo '<p style="color:red;font-style:bold;">Check your MYSQL Database settings in the config.php file</p>';
}
if ($dbcheck==1) {
$version=$mysqli->query("SELECT * from app where name='version'");
$ver = $version->fetch_assoc();
echo '<p> Your Opensis Version: '.$ver['value'];
if ($ver['value']>=6.0 && $ver['value']<=6.4) {
	echo '<span style="padding-left:20px"></span><img src="./images/green-ck.png" width="20px" heigth="20px">';
} else {
	echo '<span style="padding-left:20px"></span><img src="./images/red-x.png" width="20px" heigth="20px">';
}
echo '</p>';
echo '<h4>Use the data presented below to help you fill out the upload.csv file with the correct information</h4>';
echo '<p><b>The basic upload CSV form will require the following:</b><br>
<ul><li>Grade ID</li><li>Enrollment Code</li><li>Next School ID -<i> usually your current school id</i></li><li>Profile ID</li><li>School ID</li><li>Calendar ID</li></p>';
echo '<p><b>For the upload CSV form with Address & Parental data, the following is required in addition to the data listed above:</b><br>
<ul><li>Profile ID for Parents</li><ul>Information not listed here:<li>Custody (Y/N)</li></p>';
$sch="SELECT * FROM schools";
$sch1= mysqli_query($mysqli,$sch);
echo '<p>OPENSIS schools available:</p>';
while ($school=mysqli_fetch_array($sch1, MYSQLI_ASSOC)) {
	echo '<h3><span style="padding-left:20px;"></span>--> '.$school['title'].'</h3>';
	$sid = $school['id'];
	echo '<span style="padding-left:50px;"></span><b>ID number: '.$sid.'</b><br>';
$calen=$mysqli->query("SELECT * FROM school_calendars where syear=(SELECT MAX(syear) FROM school_calendars where school_id = $sid)");
$cal = $calen->fetch_assoc();
$syear=$cal['syear'];
	echo '<span style="padding-left:50px;"></span><b>Year: '.$cal['title'].'</b><br>';
	echo '<span style="padding-left:50px;"></span><b>--> Calendar ID: '.$cal['calendar_id'].'</b><br>';
	$enr="SELECT * FROM student_enrollment_codes where syear = $syear";
	$enr1= mysqli_query($mysqli,$enr);
while ($enroll=mysqli_fetch_array($enr1, MYSQLI_ASSOC)) {
	echo '<span style="padding-left:50px;"></span>Enrollment ID: <b>'.$enroll['id'].'</b><span style="padding-left:15px;"></span>Title: '.$enroll['title'].'<br>';
}
$prof=$mysqli->query("SELECT * FROM user_profiles where profile='student'");
$profile = $prof->fetch_assoc();
	echo '<br><h3><span style="padding-left:50px;"></span>--> Student profile ID: '.$profile['id'].'</h3><br>';
$prof5="SELECT * FROM user_profiles";
$prof1= mysqli_query($mysqli,$prof5);
	echo '<div style="padding-left:70px;"><i>Other system profiles: (only needed if you don\'t have a student profile listed above)</i><br><span style="padding-left:70px;"><table>';
while ($profiles=mysqli_fetch_array($prof1, MYSQLI_ASSOC)) {
	echo '<tr><td>';
$titleid=$profiles['title'];
if ($titleid=='Parent' OR $titleid=='Student') {
  echo '<b>--> ';
}
echo  $profiles['title'].'</td><td> ';
if ($titleid=='Parent' OR $titleid=='Student') {
  echo '<b>--> ';
}
echo 'ID#: '.$profiles['id'].'</b></td></tr>';

}
echo '</table></div>';
echo '<h4>Available Grades (and associated grade_id):</h4>';
$gr="SELECT * FROM school_gradelevels";
$gra= mysqli_query($mysqli,$gr);
echo '<div style="padding-left:70px;"><table>';
while ($gradeid=mysqli_fetch_array($gra, MYSQLI_ASSOC)) {
	echo '<tr><td>'.$gradeid['title'].'</td><td> ID#: <b>'.$gradeid['id'].'</b></td></tr>';

}
echo '</table></div>';

echo '<center><br><br><a href="csv_go.php" class="admin_btn_diff">Got Everything Done - Let go to the final step!<br>Next page will confirm your actions<br>and allow for data review</a><br><br>';
echo '<a href="instruct.php" class="admin_btn_red">NO - Take me back to the instructions</a></center><br><br>';
}  // end of each school listing

} else {
	echo '<p>Review your MYSQL entries in the config.php file</p>';
	echo '<center><a href="instruct.php" class="admin_btn_red">NO - Take me back to the instructions</a></center><br><br></center>';
}

echo '</div><br><br><br><br><br><br>';

?>
