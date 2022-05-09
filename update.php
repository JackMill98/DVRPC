<!--
NAME: Jack Millman
FILE NAME: update.php
PURPOSE: updates a record in the DB
CREATION DATE: 5/3/2022

-->

<?php
$connect = mysqli_connect("localhost", "root", "", "DVRPC-DB.sql");
if(isset($_POST["id"]))
{
 $value = mysqli_real_escape_string($connect, $_POST["value"]);
 $query = "UPDATE records SET ".$_POST["column_name"]."='".$value."' WHERE id = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Updated';
 }
}
?>
