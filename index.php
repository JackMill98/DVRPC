<!--
NAME: Jack Millman
FILE NAME: index.php
PURPOSE: Looks for a record(s) in the DB
CREATION DATE: 5/3/2022

-->

<html>
 <head>
  <title>Search Record</title>

  <!--Libraries being used -->
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
  <style>
  body
  {
   margin:0;
   padding:0;
   background-color:#f1f1f1;
  }
  .box
  {
   width:1270px;
   padding:20px;
   background-color:#fff;
   border:1px solid #ccc;
   border-radius:5px;
   margin-top:25px;
   box-sizing:border-box;
  }


  /* Dropdown Button */
.dropbtn {
  background-color: #3498DB;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

/* Dropdown button on hover & focus */
.dropbtn:hover, .dropbtn:focus {
  background-color: #2980B9;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #ddd}

/* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
.show {display:block;}

  </style>
 </head>
 <body>
  <div class="container box">

<div class="dropdown">
  <button onclick="DDMenu()" class="dropbtn">button</button>
  <div id="myDropdown" class="dropdown-content">
   <form method="POST" action = "get.php"> <button type="submit" name="logout">Logout</button></form>

  </div>
</div>


   <h1 align="center">Add Edit Delete Datatables Records </h1>
   <br />
   <div class="table-responsive">
   <br />
    <div align="right">
     <button type="button" name="add" id="add" class="btn btn-info">Add</button>
    </div>
    <br />
    <div id="alert_message"></div>
    <table id="user_data" class="table table-bordered table-striped">
     <thead>
      <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Eligibility</th>
                      <th>Purpose</th>
                      <th>Terms</th>
                      <th>Deadline</th>
                      <th>Funding Agencies</th>
                      <th>Website</th>
                      <th>Category</th>
                      <th>Bucks</th>
                      <th>Chester</th>
                      <th>Delaware</th>
                      <th>Montgomery</th>
                      <th>Philadelphia</th>
                      <th>Burlington</th>
                      <th>Camden</th>
                      <th>Glouchester</th>
                      <th>Mercer</th>
      <th></th>
      </tr>
     </thead>
    </table>
   </div>
  </div>
 </body>
</html>


<script type="text/javascript" language="javascript" >
 $(document).ready(function(){

  fetch_data();

  function fetch_data()
  {
   var dataTable = $('#user_data').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "ajax" : {
     url:"fetch.php",
     type:"POST"
    }
   });
  }

  function update_data(id, column_name, value)
  {
   $.ajax({
    url:"update.php",
    method:"POST",
    data:{id:id, column_name:column_name, value:value},
    success:function(data)
    {
     $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
     $('#user_data').DataTable().destroy();
     fetch_data();
    }
   });
   setInterval(function(){
    $('#alert_message').html('');
   }, 5000);
  }

 //updates table row
  $(document).on('blur', '.update', function(){
   var id = $(this).data("id");
   var column_name = $(this).data("column");
   var value = $(this).text();
   update_data(id, column_name, value);
  });

//Code to add the row for the add button
  $('#add').click(function(){
   var html = '<tr>';
   html += '<td contenteditable id="dataID"></td>';
   html += '<td contenteditable id="dataName"></td>';
   html += '<td contenteditable id="dataEli"></td>';
   html += '<td contenteditable id="dataPurp"></td>';
   html += '<td contenteditable id="dataTerm"></td>';
   html += '<td contenteditable id="dataDL"></td>';
   html += '<td contenteditable id="dataFA"></td>';
   html += '<td contenteditable id="dataWeb"></td>';
   html += '<td contenteditable id="dataCat"></td>';
   html += '<td contenteditable id="dataBuck"></td>';
   html += '<td contenteditable id="dataChest"></td>';
   html += '<td contenteditable id="dataDela"></td>';
   html += '<td contenteditable id="dataMont"></td>';
   html += '<td contenteditable id="dataPhilly"></td>';
   html += '<td contenteditable id="dataBur"></td>';
   html += '<td contenteditable id="dataCam"></td>';
   html += '<td contenteditable id="dataGlou"></td>';
   html += '<td contenteditable id="dataMercer"></td>';
   html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
   html += '</tr>';
   $('#user_data tbody').prepend(html);
  });

//store inserted data in variables
  $(document).on('click', '#insert', function(){
   var id = $('#dataID').text();
   var name = $('#dataName').text();
   var eli = $('#dataEli').text();

   var purpose = $('#dataPurp').text();
   var terms = $('#dataTerm').text();
   var dl = $('#dataDL').text();

   var fa = $('#dataFA').text();
   var web = $('#dataWeb').text();
   var cat = $('#dataCat').text();

   var buck = $('#dataBuck').text();
   var chester = $('#dataChest').text();
   var delaware = $('#dataDela').text();
   var mont = $('#dataMont').text();
   var philly = $('#dataPhilly').text();
   var burlign = $('#dataBur').text();
   var camden = $('#dataCam').text();
   var glou = $('#dataGlou').text();
   var mercer = $('#dataMercer').text();

   //validation
   if(id != '' && name != '')
   {

    if (isNan(id)) {

       alert("ID is not a Number")
    } else {



    $.ajax({
     url:"insert.php",
     method:"POST",
     data:{ID:id, NAME:name, ELIGIBILITY:eli, PURPOSE:purpose, TERMS:terms, DEADLINE:dl, FUNDINGAGENCIES:fa, WEBSITE:web, CATEGORY:cat, BUCKS:buck, CHESTER:chester, DELAWARE:delaware, MONTGOMERY:mont, PHILADELPHIA:philly, BURLINGTON:burlign, CAMDEN:camden, GLOUCHESTER:glou, MERCER:mercer},
     success:function(data)
     {
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
 }
   else
   {
    alert("All Fields required");
   }
  });

  $(document).on('click', '.delete', function(){
   var id = $(this).attr("id");
   if(confirm("Are you sure you want to remove this?"))
   {
    $.ajax({
     url:"delete.php",
     method:"POST",
     data:{id:id},
     success:function(data){
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
  });
 });




 /* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function DDMenu() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
