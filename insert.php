<!--
NAME: Jack Millman
FILE NAME: insert.php
PURPOSE: inserts a new record into DB
CREATION DATE: 5/3/2022

-->
<?php
$connect = mysqli_connect("localhost", "root", "", "DVRPC-DB.sql");
if(isset($_POST["id"], $_POST["name"]))
{

  $id = $_POST["id"];

  $queryID = "SELECT ID FROM records WHERE ID='$id'";
  $IDresult = mysqli_query($connect, $queryID);

  $name = mysqli_real_escape_string($connect, $_POST["name"]);
  $eli = mysqli_real_escape_string($connect, $_POST["eligibility"]);

  $purpose = mysqli_real_escape_string($connect, $_POST["purpose"]);
  $terms = mysqli_real_escape_string($connect, $_POST["terms"]);
  $dl = mysqli_real_escape_string($connect, $_POST["deadline"]);

  $fa = mysqli_real_escape_string($connect, $_POST["fundingagencies"]);
  $web = mysqli_real_escape_string($connect, $_POST["website"]);
  $cat = mysqli_real_escape_string($connect, $_POST["category"]);

  $buck = $_POST["bucks"];
  $chester = $_POST["chester"];
  $delaware = $_POST["delaware"];
  $mont = $_POST["montgomery"];
  $philly = $_POST["philadelphia"];
  $burlign = $_POST["burlington"];
  $camden = $_POST["camden"];
  $glou = $_POST["glouchester"];
  $mercer = $_POST["mercer"];

  $queryCounty = "SELECT * FROM records WHERE ID='$id'";
  $IDresult = mysqli_query($connect, $queryID);
  $queryCounty = "SELECT * FROM records WHERE BUCKS=1 OR BUCKS=0 AND CHESTER=1 OR CHESTER=0 AND DELAWARE=1 OR DELAWARE=0 AND MONTGOMERY=1 OR MONTGOMERY=0 AND PHILADELPHIA=1 OR PHILADELPHIA=0 AND BURLINGTON=1 OR BURLINGTON=0 AND CAMDEN=1 OR CAMDEN=0 AND GLOUCHESTER=1 OR GLOUCHESTER=0 AND MERCER=1 OR MERCER=0";
  $Countyresult = mysqli_query($connect, $queryCounty);

  if(mysqli_num_rows($IDresult) != 0)
  {
    echo 'ID already exists';
  } elseif(mysqli_num_rows($Countyresult) == 0)
  {
    echo 'one of the counties was not a number';
  } else
  {
    $query = "INSERT INTO records (ID, NAME, ELIGIBILITY, PURPOSE, TERMS, DEADLINE, FUNDINGAGENCIES, WEBSITE, CATEGORY, BUCKS, CHESTER, DELAWARE, MONTGOMERY, PHILADELPHIA, BURLINGTON, CAMDEN, GLOUCHESTER, MERCER) VALUES('$id', '$name', '$eli', '$purpose', '$terms', '$dl', '$fa', '$web', '$cat', '$buck', '$chester', '$delaware', '$mont', '$philly', '$burlign', '$camden', '$glou', '$mercer')";
    if(mysqli_query($connect, $query))
    {
     echo 'Data Inserted';
    }
  }
}
?>
