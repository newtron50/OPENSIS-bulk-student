<?php
//test csv upload
echo '<link href="./images/upload.css" rel="stylesheet" type="text/css">';
echo '<div class="pad"><div class="main">';
echo '<center><h2>Important Instructions:</h2></center>';
echo '<p><b>You will need the MYSQL Credentials and information necessary for this program to connect to your OPENSIS instance. </b></p>';
echo '<p> ** Note: this has been tested with versions 6.3 & 6.4 **</p>';
echo '<p> You will need to determine how much data you want to import to OPENSIS. This program will either upload the minimal basic information required for a student or create Student Addresses with Primary and Secondary Contacts.</p>';
echo '<h2>There are two different file transfers available.  <i>Basic and Enhanced</i> --  Use Caution</h2>';
echo '<p> -- Basic will import the necessary minimal data to create a student account.<br> -- Enhanced will also import and create:<ul><li>Primary & Secondary Contact information</li><li>Student Address & Mailing Address</li><li>Student email and phone</li><li>Associate Contacts to Student</li></ul></p>';
echo '<p><b>(1)</b> Edit the <b>config.php</b> file with the OPENSIS server\'s MYSQL credentials.</p>';
echo '<p><b>(2)</b> The next page will verify the connection and provide the required information for the student entry into the CSV (comma separated values) file.  Copy or print the results to reference CSV entry as it will provide specific information about your setup required for the student upload. Make sure to use the template provided to create your CSV file.</p>';
echo '<p><b>(3)</b> Fill out/migrate your data into the <b>upload.csv or enhanced_upload.csv</b> file using the provided information from the results.  The files with this code have test information to help you either edit the current CSV file or create your own CSV file. As noted before, the current CSV files contain test data.</p>';
echo '<p><b><i>BASIC ONLY:</i></b> Do not leave any datapoints blank. Doing so will cause a failed upload with corrupted data.</p>';
echo '<p><b><i>ENHANCED:</i> The first 13 datapoints are required on each student</b> (last_name through calendar_id) otherwise it can result in a corrupted database.</p>';
echo'<p><b><i>ENHANCED ONLY: </i></b>Data Conventions: <ul><li>If you have an student address that is repeated for any of the following... mail, primary contact address & secondary contact address and you wish to use the student address <i>(st-street_address) in any of those instances,</i> place 1 asterisk * in the first column of the street_address (mail , primary p-, secondary s-) and leave the remaining address delimiters blank.  This will instruct the program to utilize the student\'s first address entry in the other instances.</li><li>If you do not wish to include a Primary/Secondary contact, leave blank. If only only contact is available, it must be included as a primary (p-) contact.</li></ul></p>';




echo '<p><b>(4) </b>Save the file in the same location as this program\'s php files. Make sure the file is readable with the file permission settings.  <i>**The next rev of this software will include the ability to upload the file directly to the server if your server supports PHP file uploads</i></p>';
echo '<p><b>(5) **Important!! ALWAYS MAKE SURE TO BACK UP YOUR OPENSIS DATABASE BEFORE THE BULK STUDENT IMPORT. </b>Save yourself a headache: much easier to reload a saved copy of the database rather that trying to sort out a mess because of an accidental error/omission.  Utilize the database backup utility found within Opensis or MYSQLDUMP.</p>';
echo '<p><b>(6)</b> After the configuration test, you will have a chance to review the data.  If you have backed up your database and everything looks good, you can select to UPLOAD the data to Opensis. The Upload button will take your data and insert it into the OPENSIS database.  No going back without a backup....';
echo '<p><b>(7)</b> Check OPENSIS for the newly uploaded students. Because of differences in deployments, customization of the bulk upload should be performed outside of this program.  Consult Opensis.com support or bs.techconsult@gmail.com.</p>';
echo '<br><br><p style="text-align:center;"><a href="testconfig.php" class="admin_btn_diff">Check settings and the Database</a></p>';
echo '</div></center>';







?>
