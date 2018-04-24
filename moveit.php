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
$chk=(csv_to_array('enhanced_upload.csv'));
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
    $student="INSERT INTO students (last_name, first_name, middle_name,birthdate,common_name,gender) VALUES ('$s1','$s2','$s3','$s6','$s5','$s4')";
mysqli_query($mysqli,$student);

//////  Get the newly inserted student's id number for other table entries
$newcid2=$mysqli->query("SELECT MAX(student_id) as id FROM students ");
$newid = $newcid2->fetch_assoc();
$os_id=$newid['id'];

//////  Get the current school year from Opensis

$newcal2=$mysqli->query("SELECT MAX(syear) as syear FROM school_years");
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

$nsenroll1="INSERT INTO student_enrollment (syear,school_id,student_id,grade_id,start_date,enrollment_code,next_school,calendar_id,updated_by) VALUES ($syear,$sch_id,$os_id,$gid,'$sdate',$ecd,$nxts,$calid,'OS_mass')";
mysqli_query($mysqli,$nsenroll1);

/////////   SCreate login authentication

$nslogin="INSERT INTO login_authentication (user_id,profile_id) VALUES ($os_id,$pid)";
mysqli_query($mysqli,$nslogin);

//////// Section 8 ====  Student Medical info creation


$nsmed1="INSERT INTO medical_info (student_id,syear,school_id) VALUES ($os_id,$syear,$sch_id)";
mysqli_query($mysqli,$nsmed1);

////// ---- ***** OPTIONAL STUDENT VARIABLE -- PHONE AND EMAIL
$stemail=$row['st-email'];
$stphone=$row['st-phone'];

if ($stemail!='') {
$nsemail="UPDATE students set email = '$stemail'";
mysqli_query($mysqli,$nsemail);
}

if ($stphone!='') {
$nsphone="UPDATE students set phone = '$stphone'";
mysqli_query($mysqli,$nsphone);
}

////  Student Street address read into variables

$stadd=$row['st-street_address'];
$stadd2=$row['st-street_address2'];
$stcity=$row['st-city'];
$ststate=$row['st-state'];
$stzip=$row['st-zipcode'];
if ($stadd!='') {
$nssthome="INSERT INTO student_address (student_id,syear,school_id,street_address_1,street_address_2,city,state,zipcode,type) VALUES ($os_id,$syear,$sch_id,'$stadd','$stadd2','$stcity','$ststate','$stzip','Home Address')";
mysqli_query($mysqli,$nssthome);
}

$mailadd=$row['mail-street_address'];
$mailadd2=$row['mail-street_address2'];
$mailcity=$row['mail-city'];
$mailstate=$row['mail-state'];
$mailzip=$row['mail-zipcode'];

if ($mailadd=='*') {
$nssthome="INSERT INTO student_address (student_id,syear,school_id,street_address_1,street_address_2,city,state,zipcode,type) VALUES ($os_id,$syear,$sch_id,'$stadd','$stadd2','$stcity','$ststate','$stzip','Mail')";
mysqli_query($mysqli,$nssthome);
} else {
$nsmail="INSERT INTO student_address (student_id,syear,school_id,street_address_1,street_address_2,city,state,zipcode,type) VALUES ($os_id,$syear,$sch_id,'$mailadd','$mailadd2','$mailcity','$mailstate','$mailzip','Mail')";
mysqli_query($mysqli,$nsmail);
}



/////////*** Primary contact Info read into variables
$ptitle=$row['p-title'];
$pfirst=$row['p-first name'];
$plast=$row['p-last name'];
$pmiddle=$row['p-middle name'];
$phome=$row['p-home_ph'];
$pwork=$row['p-work_ph'];
$pcell=$row['p-cell'];
$pemail=$row['p-email'];
$pcust=$row['p-custody'];
$pprofile=$row['p-profile'];
$pprofile_id=$row['p-profile_id'];
$prelationship=$row['p-relationship'];

//  Insert primary contact into people table
$npeople1="INSERT INTO people (current_school_id,first_name,last_name,middle_name,home_phone,work_phone,cell_phone,email,custody,profile,profile_id) VALUES ($sch_id,'$pfirst','$plast','$pmiddle','$phome','$pwork','$pcell','$pemail','$pcust','$pprofile',$pprofile_id)";
mysqli_query($mysqli,$npeople1);

//new parent ID Primary
$newparent=$mysqli->query("SELECT MAX(staff_id) as id FROM people");
	$np1 = $newparent->fetch_assoc();
	$staff1=$np1['id'];

////
if ($ptitle!=''){
$p1title="UPDATE people SET title='$ptitle' where staff_id = $staff1";
mysqli_query($mysqli,$p1title);
}

//  Insert primary contact into students_join_people

$npprimary1="INSERT INTO students_join_people (student_id,person_id,emergency_type,relationship) VALUES ($os_id,$staff1,'Primary','$prelationship')";
mysqli_query($mysqli,$npprimary1);

//////////////

$padd=$row['p-street_address'];
$padd2=$row['p-street_address2'];
$pcity=$row['p-city'];
$pstate=$row['p-state'];
$pzip=$row['p-zipcode'];

if ($padd=='*'){    // copy home address into parent address
$nssthomeprimary="INSERT INTO student_address (student_id,syear,school_id,street_address_1,street_address_2,city,state,zipcode,type,people_id) VALUES ($os_id,$syear,$sch_id,'$stadd','$stadd2','$stcity','$ststate','$stzip','Primary',$staff1)";
mysqli_query($mysqli,$nssthomeprimary);
} else {
$nssthomeprimary="INSERT INTO student_address (student_id,syear,school_id,street_address_1,street_address_2,city,state,zipcode,type,people_id) VALUES ($os_id,$syear,$sch_id,'$padd','$padd2','$pcity','$pstate','$pzip','Primary',$staff1)";
mysqli_query($mysqli,$nssthomeprimary);
}


/////////*** Secondary contact Info read into variables
$stitle=$row['s-title'];
$sfirst=$row['s-first name'];
$slast=$row['s-last name'];
$smiddle=$row['s-middle name'];
$shome=$row['s-home_ph'];
$swork=$row['s-work_ph'];
$scell=$row['s-cell'];
$semail=$row['s-email'];
$pcust=$row['s-custody'];
$sprofile=$row['s-profile'];
$sprofile_id=$row['s-profile_id'];
$srelationship=$row['s-relationship'];



$sadd=$row['s-street_address'];
$sadd2=$row['s-street_address2'];
$scity=$row['s-city'];
$sstate=$row['s-state'];
$szip=$row['s-zipcode'];


/////// check if Second contact available

if ($sfirst!='') {  //  if first name of the secondary contact is blank... skip all this

//  Insert Second contact into people table
$npeople2="INSERT INTO people (current_school_id,first_name,last_name,middle_name,home_phone,work_phone,cell_phone,email,custody,profile,profile_id) VALUES ($sch_id,'$sfirst','$slast','$smiddle','$shome','$swork','$scell','$semail','$pcust','$sprofile',$sprofile_id)";
mysqli_query($mysqli,$npeople2);

//  New Secondary contact // ID
$newparent2=$mysqli->query("SELECT MAX(staff_id) as id FROM people");
$np2 = $newparent2->fetch_assoc();
$staff2=$np2['id'];

if ($stitle!=''){    //// update people table with title if used

	$s2title="UPDATE PEOPLE SET title='$stitle' where staff_id = $staff2";
	mysqli_query($mysqli,$s2title);
}

//  Insert secondary contact into students_join_people

$npprimary1="INSERT INTO students_join_people (student_id,person_id,emergency_type,relationship) VALUES ($os_id,$staff2,'Secondary','$srelationship')";
mysqli_query($mysqli,$npprimary1);

//////////////
if ($sadd=='*'){    // copy home address into parent address
$nssthomesecond="INSERT INTO student_address (student_id,syear,school_id,street_address_1,street_address_2,city,state,zipcode,type,people_id) VALUES ($os_id,$syear,$sch_id,'$stadd','$stadd2','$stcity','$ststate','$stzip','Secondary',$staff2)";
mysqli_query($mysqli,$nssthomesecond);
} else {
$nssthomesecond="INSERT INTO student_address (student_id,syear,school_id,street_address_1,street_address_2,city,state,zipcode,type,people_id) VALUES ($os_id,$syear,$sch_id,'$sadd','$sadd2','$scity','$sstate','$szip','Secondary',$staff2)";
mysqli_query($mysqli,$nssthomesecond);
}


}  //end os second contact stuff
echo '<br>student: '.$os_id.' Student: '.$s1.', '.$s2;

}  ////// foreach line

//  +++++++++++++++++++++++++++++++++++++++++++

//    erase student from queue & change enroll status to 10

echo '<br><br><br><center>Success - Check OPENSIS for your students ';

echo '</div><br><br><br><br><br><br>';

?>
