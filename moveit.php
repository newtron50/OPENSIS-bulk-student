<?php
echo '<link href="./images/upload.css" rel="stylesheet" type="text/css">';
echo '<div class="pad"><div class="main">';
echo '<center><h2>Opensis Mass Student Upload:: Uploading CSV File</h2></center>';
/////  read csv file data into array
require(dirname(__FILE__).'/config.php');
function csv_to_array($filename='', $delimiter=',')
{
	if(!file_exists($filename) || !is_readable($filename))
		return FALSE;
	$header = NULL;
	$data = array();
	if (($handle = fopen($filename, 'r')) !== FALSE)
	{
		while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
		{
			if(!$header)
				$header = $row;
			else
				$data[] = array_combine($header, $row);
		}
		fclose($handle);
	}
	return $data;
}
$chk=(csv_to_array('upload.csv'));
///////////////////////////  Write data to OPENSIS
foreach ($chk as $row)
{
//  write basic info into TABLE::students
$s1=$row['last name'];
$s2=$row['first name'];
$s3=$row['middle name'];
$s4=$row['gender'];
$s5=$row['common name'];
$s6=$row['birthdate'];
    $student="INSERT INTO opensis.students (last_name, first_name, middle_name,birthdate,common_name,gender) VALUES ('$s1','$s2','$s3','$s6','$s5','$s4')";
mysqli_query($mysqli,$student);

//////  Get the newly inserted student's id number for other table entries
$newcid2=$mysqli->query("SELECT MAX(student_id) as id FROM opensis.students ");
$newid = $newcid2->fetch_assoc();
$os_id=$newid['id'];

//////  Get the current school year from Opensis

$newcal2=$mysqli->query("SELECT MAX(syear) as syear FROM opensis.school_years");
$newcal = $newcal2->fetch_assoc();
$syear=$newcal['syear'];

/////// Prepare enrollment data for entry

$gid=$row['grade id'];
$sdate=$row['start date'];
$ecd=$row['enrollment code'];
$nxts=$row['next school'];
$pid=$row['profile id'];
$sch_id =$row['school id'];
$calid=$row['calendar id'];
///////  Create student enrollment

$nsenroll1="INSERT INTO opensis.student_enrollment (syear,school_id,student_id,grade_id,start_date,enrollment_code,next_school,calendar_id,updated_by) VALUES ($syear,$sch_id,$os_id,$gid,'$sdate',$ecd,$nxts,$calid,'OS_mass')";
mysqli_query($mysqli,$nsenroll1);

/////////   SCreate login authentication

$nslogin="INSERT INTO opensis.login_authentication (user_id,profile_id) VALUES ($os_id,$pid)";
mysqli_query($mysqli,$nslogin);

//////// Section 8 ====  Student Medical info creation


$nsmed1="INSERT INTO opensis.medical_info (student_id,syear,school_id) VALUES ($os_id,$syear,$sch_id)";
mysqli_query($mysqli,$nsmed1);


}







//  +++++++++++++++++++++++++++++++++++++++++++

//    erase student from queue & change enroll status to 10

echo '<br><br><br><center>Success - Check OPENSIS for your students ';

echo '</div><br><br><br><br><br><br>';

?>
