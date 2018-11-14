<?php
/* 
 EDIT.PHP
 Allows user to edit specific entry in database
*/

 // creates the edit record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($id, $title, $contents, $error)
 {
 ?>
 <html>
 <head>
 <title>Edit history</title>
 <style>
 body {
	 text-align: center;
 }
 .theform{
  width: 500px;
  clear: both;
  display: inline-block;
  vertical-align: middle;
}

.theform input {
  width: 100%;
  clear: both;
}
 </style>
 </head>
 <body>
 <?php 
 // if there are any errors, display them
 if ($error != '')
 {
 echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 }
 ?> 

 <form action="" method="post">
 <input type="hidden" name="id" value="<?php echo $id; ?>"/>
 <div class=theform>
 <p><strong>Announcement ID: </strong> <?php echo $id; ?></p>
 <strong>Title: *</strong> <input type="text" name="title" value="<?php echo $title; ?>"/><br/>
 <strong>Contents: *</strong> <input type="text" name="contents" value="<?php echo $contents; ?>"/><br/>
 <p>* Required</p>
 <input type="submit" name="submit" value="Submit">
 </div>
 </form> 
 </body>
 </html> 
 
 <?php
 }



 // connect to the database
 include('connect-db.php');
 
 // check if the form has been submitted. If it has, process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // confirm that the 'id' value is a valid integer before getting the form data
 if (is_numeric($_POST['id']))
 {
 // get form data, making sure it is valid
 $id = $_POST['id'];
 $title = mysqli_real_escape_string($conn, htmlspecialchars($_POST['title']));
 $contents = mysqli_real_escape_string($conn ,htmlspecialchars($_POST['contents']));
 
 // check that firstname/lastname fields are both filled in
 if ($title == '' || $contents == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 //error, display form
 renderForm($id, $title, $contents, $error);
 }
 else
 {
 // save the data to the database
 mysqli_query($conn, "UPDATE announcements SET title='$title', contents='$contents' WHERE id='$id'")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 header("Location: /wordpress/wp-admin/admin.php?page=announcement-admin-menu"); 
 }
 }
 else
 {
 // if the 'id' isn't valid, display an error
 echo 'ID Error!';
 }
 }
 else
 // if the form hasn't been submitted, get the data from the db and display the form
 {
 
 // get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
 if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
 {
 // query db
 $id = $_GET['id'];
 $result = mysqli_query($conn,"SELECT * FROM announcements WHERE id=$id")
 or die(mysql_error()); 
 $row = mysqli_fetch_array($result);
 
 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // get data from db
 $title = $row['title'];
 $contents = $row['contents'];
 
 // show form
 renderForm($id, $title, $contents, '');
 }
 else
 // if no match, display result
 {
 echo "No results!";
 }
 }
 else
 // if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
 {
 echo 'Error!';
 }
 }
?>