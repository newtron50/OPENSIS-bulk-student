<?php
//test csv upload
echo '<link href="./images/upload.css" rel="stylesheet" type="text/css">';
echo '<div class="pad"><div class="main">';
echo '<center><h2>Important Instructions:</h2></center>';
echo '<p><b>You will need the MYSQL Credentials and information necessary for this program to connect to your OPENSIS instance. </b></p>';
echo '<p> ** Note: this has been tested with versions 6.3 & 6.4 **</p>';
echo '<p>(1) Edit the <b>config.php</b> file with the OPENSIS server\'s MYSQL credentials.</p>';
echo '<p>(2) The next page will verify the connection and provide the required information for the student entry into the CSV (comma separated values) file.  Copy or print the results to reference  CSV entry as it will provide specific information about your setup required for the student upload. Make sure to use the template provided to create your CSV file.</p>';
echo '<p>(3)Fill out the <b>upload.csv</b> file using the provided information from the results. Do not leave anything blank otherwise it can result in problems with your software</p>';
echo '<p>(4)   Save the file in the same location as this program\'s php files. Make sure the file is readable with the file permission settings.  <i>**The next rev of this software will include the ability to upload the file directly to the server if your server supports PHP file uploads</i></p>';
echo '<p>(5)<b> **Important!! ALWAYS MAKE SURE TO BACK UP YOUR OPENSIS DATABASE BEFORE THE MASS STUDENT IMPORT. </b>Save yourself a headache: much easier to reload a saved copy of the database rather that trying to sort out a mess because of an accidental error/omission.  Utilize the database backup utility found within Opensis or MYSQLDUMP.</p>';
echo '<p>(6) After the configuration test, you will have a chance to review the data.  If you have backed up your database and everything looks good, you can select to UPLOAD the data to Opensis. The Upload button will take your data and insert it into the OPENSIS database.  No going back without a backup....';
echo '<p>(7) Check OPENSIS for the newly uploaded students. Because of differences in deployments, only the basic information has been uploaded. You will still need to do more data entry.</p>';
echo '<br><br><p style="text-align:center;"><a href="testconfig.php" class="admin_btn_diff">Check settings and the Database</a></p>';
echo '</div></center>';







?>
