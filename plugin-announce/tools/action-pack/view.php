<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>View Records</title>
</head>
<body>

<?php

/*
VIEW.PHP
Displays all data from 'announcements' table
*/
// connect to the database
include('connect-db.php');

// get results from database
$result = mysqli_query($conn,"SELECT * FROM announcements")
or die(mysqli_error());
// display data in table
echo "<table border='1' cellpadding='10'>";
echo "<tr> <th>ID</th> <th>Title</th> <th>Contents</th> <th></th> <th></th></tr>";

// loop through results of database query, displaying them in the table

while($row = mysqli_fetch_array( $result )) {

// echo out the contents of each row into a table
echo "<tr>";
echo '<td>' . $row['id'] . '</td>';
echo '<td>' . $row['title'] . '</td>';
echo '<td>' . $row['contents'] . '</td>';
echo '<td><a href="/wordpress/wp-content/plugins/plugin-announce/tools/action-pack/db-edit.php?id=' . $row['id'] . '">Edit</a></td>';
echo '<td><a href="/wordpress/wp-content/plugins/plugin-announce/tools/action-pack/db-delete.php?id=' . $row['id'] . '">Delete</a></td>';
echo "</tr>";
}

// close table>
echo "</table>";
?>
<p><strong> *Any action here will be immediate! </strong></p>
</body>
</html>