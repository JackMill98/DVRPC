
<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "DVRPC-DB.sql");
$columns = array('first_name', 'last_name');

$query = "SELECT * FROM records ";

//looks through DB with entered keywords
if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE first_name LIKE "%'.$_POST["search"]["value"].'%"
 OR last_name LIKE "%'.$_POST["search"]["value"].'%"
 ';
}


//orders the search
if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'
 ';
}
else
{
 $query .= 'ORDER BY id DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();
//get all needed rows from table
while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="ID">' . $row["ID"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="NAME">' . $row["NAME"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="ELIGIBILITY">' . $row["ELIGIBILITY"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="PURPOSE">' . $row["PURPOSE"] . '</div>';
   $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="TERMS">' . $row["TERMS"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="DEADLINE">' . $row["DEADLINE"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="FUNDINGAGENCIES">' . $row["FUNDINGAGENCIES"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="WEBSITE">' . $row["WEBSITE"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="BUCKS">' . $row["BUCKS"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="CHESTER">' . $row["CHESTER"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="DELAWARE">' . $row["DELAWARE"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="MONTGOMERY">' . $row["MONTGOMERY"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="PHILADELPHIA">' . $row["PHILADELPHIA"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="BURLINGTON">' . $row["BURLINGTON"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="CAMDEN">' . $row["CAMDEN"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="GLOUCHESTER">' . $row["GLOUCHESTER"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="MERCER">' . $row["MERCER"] . '</div>';

 $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["id"].'">Delete</button>';
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM records";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>
