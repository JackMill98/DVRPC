<!--
NAME: Jack Millman
FILE NAME: delete.php
PURPOSE: deletes a record in the DB
CREATION DATE: 5/3/2022

-->

<?php
$connect = mysqli_connect("localhost", "root", "", "DVRPC-DB.sql");
if(isset($_POST["id"]))
{
 $query = "DELETE FROM records WHERE id = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Deleted';
 }
}
?>
