
<?php
$connect = mysqli_connect("localhost", "root", "", "DVRPC-DB.sql");
if(isset($_POST["first_name"], $_POST["last_name"]))
{

  $id = $('#dataID').text();
  $name = mysqli_real_escape_string($connect, $_POST["first_name"]);
  $eli = mysqli_real_escape_string($connect, $_POST["first_name"]);

  $purpose = mysqli_real_escape_string($connect, $_POST["first_name"]);
  $terms = mysqli_real_escape_string($connect, $_POST["first_name"]);
  $dl = mysqli_real_escape_string($connect, $_POST["first_name"]);

  $fa = mysqli_real_escape_string($connect, $_POST["first_name"]);
  $web = mysqli_real_escape_string($connect, $_POST["first_name"]);
  $cat = mysqli_real_escape_string($connect, $_POST["first_name"]);

  $buck = $('#dataBuck').text();
  $chester = $('#dataChest').text();
  $delaware = $('#dataDela').text();
  $mont = $('#dataMont').text();
  $philly = $('#dataPhilly').text();
  $burlign = $('#dataBur').text();
  $camden = $('#dataCam').text();
  $glou = $('#dataGlou').text();
  $mercer = $('#dataMercer').text();


 $query = "INSERT INTO records (ID, NAME, ELIGIBILITY, PURPOSE, TERMS, DEADLINE, FUNDINGAGENCIES, WEBSITE, CATEGORY, BUCKS, CHESTER, DELAWARE, MONTGOMERY, PHILADELPHIA, BURLINGTON, CAMDEN, GLOUCHESTER, MERCER) VALUES('$id', '$name', '$eli', '$purpose', '$terms', '$dl', '$fa', '$web', '$cat', '$buck', '$chester', '$delaware', '$mont', '$philly', '$burlign', '$camden', '$glou', '$mercer')";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Inserted';
 }
}
?>
