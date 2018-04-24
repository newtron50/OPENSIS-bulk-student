<?php
echo '<link href="./images/upload.css" rel="stylesheet" type="text/css">';

unset($data);
//require(dirname(__FILE__).'/config.php');


////////
echo '<center>';
echo '<table>';
echo '<tr><th>last name<th>first name</th><th>middle name</th><th>gender</th><th>common name</th><th>birthdate</th><th>grade id</th><th>start date</th><th>enrollment code</th><th>next school</th><th>profile id</th><th>school id</th><th>calendar id</th><th>st phone</th><th>st email</th><th>st add </th><th>stadd2</th><th>stcity</th><th>st-state</th><th>st-zip</th><th>mail-street</th><th>mail-addr2</th><th>mail-city</th><th>mail-state</th><th>mail-zip</th><th>p-title</th><th>p-first</th><th>p-last</th><th>p-middle</th><th>p-homeph</th><th>p-workph</th><th>p-cell</th><th>p-email</th><th>p-custody</th><th>p-profile</th><th>p-profile_id<th>p-relationship</th><th>p-addr</th><th>p-addr2</th><th>p-city</th><th>p-state</th><th>p-zip</th><th>s-title</th><th>s-first</th><th>s-last</th><th>s-middle</th><th>s-homeph</th><th>s-workph</th><th>s-cell</th><th>s-email</th><th>s-custody</th><th>s-profile</th><th>s-profile_id</th><th>s-relationship</th><th>s-addr</th><th>s-addr2</th><th>s-city</th><th>s-state</th><th>s-zip</th></tr>';


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

foreach ($chk as $row)
{
	 echo '<tr><td>'.$row['last name'].'</td><td>';
	 echo $row['first name'].'</td><td>';
	 echo $row['middle name'].'</td><td>';
	 echo $row['gender'].'</td><td>';
	 echo $row['common name'].'</td><td>';
	 echo $row['birthdate'].'</td><td>';
	 echo $row['grade id'].'</td><td>';
	 echo $row['start date'].'</td><td>';
	 echo $row['enrollment code'].'</td><td>';
	 echo $row['next school'].'</td><td>';
	 echo $row['profile id'].'</td><td>';
	 echo $row['school id'].'</td><td>';
	 echo $row['calendar id'].'</td><td>';
echo $row['st-email'].'</td><td>';
echo $row['st-phone'].'</td><td>';
echo $row['st-street_address'].'</td><td>';
echo $row['st-street_address2'].'</td><td>';
echo $row['st-city'].'</td><td>';
echo $row['st-state'].'</td><td>';
echo $row['st-zipcode'].'</td><td>';
echo $row['mail-street_address'].'</td><td>';
echo $row['mail-street_address2'].'</td><td>';
echo $row['mail-city'].'</td><td>';
echo $row['mail-state'].'</td><td>';
echo $row['mail-zipcode'].'</td><td>';
echo $row['p-title'].'</td><td>';
echo $row['p-first name'].'</td><td>';
echo $row['p-last name'].'</td><td>';
echo $row['p-middle name'].'</td><td>';
echo $row['p-home_ph'].'</td><td>';
echo $row['p-work_ph'].'</td><td>';
echo $row['p-cell'].'</td><td>';
echo $row['p-email'].'</td><td>';
echo $row['p-custody'].'</td><td>';
echo $row['p-profile'].'</td><td>';
echo $row['p-profile_id'].'</td><td>';
echo $row['p-relationship'].'</td><td>';
echo $row['p-street_address'].'</td><td>';
echo $row['p-street_address2'].'</td><td>';
echo $row['p-city'].'</td><td>';
echo $row['p-state'].'</td><td>';
echo $row['p-zipcode'].'</td><td>';
echo $row['s-title'].'</td><td>';
echo $row['s-first name'].'</td><td>';
echo $row['s-last name'].'</td><td>';
echo $row['s-middle name'].'</td><td>';
echo $row['s-home_ph'].'</td><td>';
echo $row['s-work_ph'].'</td><td>';
echo $row['s-cell'].'</td><td>';
echo $row['s-email'].'</td><td>';
echo $row['s-custody'].'</td><td>';
echo $row['s-profile'].'</td><td>';
echo $row['s-profile_id'].'</td><td>';
echo $row['s-relationship'].'</td><td>';
echo $row['s-street_address'].'</td><td>';
echo $row['s-street_address2'].'</td><td>';
echo $row['s-city'].'</td><td>';
echo $row['s-state'].'</td><td>';
echo $row['s-zipcode'].'</td></tr>';
}
echo '</table>';

echo '<br><br>';




echo '</div></center><br><br><br><br><br><br>';

?>
