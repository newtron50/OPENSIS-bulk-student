<?php
echo '<link href="./images/upload.css" rel="stylesheet" type="text/css">';

unset($data);
//require(dirname(__FILE__).'/config.php');


////////
echo '<center>';
echo '<table><tr><th>last name<th>first name</th><th>middle name</th><th>gender</th><th>common name</th><th>birthdate</th><th>grade id</th><th>start date</th><th>enrollment code</th><th>next school</th><th>profile id</th><th>school id</th><th>calendar id</th></tr>';


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
	 echo $row['calendar id'].'</td></tr>';

}
echo '</table>';

echo '<br><br>';




echo '</div></center><br><br><br><br><br><br>';

?>
