<?php
   include('session.php');
   $_SESSION['names']=array();
   $_SESSION['DOBS']=array();
   $_SESSION['genders']=array();
   $_SESSION['pids']=array();
   for ($i=1; $i <=$_SESSION['t_no'] ; $i++) {
     // code...
     array_push($_SESSION['names'],$_SESSION['name'.$i]);
     array_push($_SESSION['DOBS'],$_SESSION['DOB'.$i]);
     array_push($_SESSION['genders'],$_SESSION['gender'.$i]);
     array_push($_SESSION['pids'],$_SESSION['pid'.$i]);
   }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
  <style>
    html, body {
    display: flex;
    justify-content: center;
    font-family: Roboto, Arial, sans-serif;
    font-size: 15px;
    }
    form {
    border: 5px solid #f1f1f1;
    margin-top: 60px;
    }
    input[type=text], input[type=password] {
    width: 100%;
    padding: 16px 8px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
    }
    button {
    background-color: #8ebf42;
    color: white;
    padding: 14px 0;
    margin: 10px 0;
    border: none;
    cursor: grabbing;
    width: 100%;
    }
    h1 {
    text-align:center;
    fone-size:18;
    }
    button:hover {
    opacity: 0.8;
    }
    .formcontainer {
    text-align: left;
    margin: 24px 50px 12px;
    }
    .container {
    padding: 16px 0;
    text-align:left;
    }
    span.psw {
    float: right;
    padding-top: 0;
    padding-right: 15px;
    }
    /* Change styles for span on extra small screens */
    @media screen and (max-width: 300px) {
    span.psw {
    display: block;
    float: none;
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
  <!-- Brand/logo -->
  <!-- <a class="navbar-brand" href="#">Railway Reservation system</a> -->

  <!-- Links -->
  <h2 class="navbar-brand">Welcome, <?php echo $_SESSION['agent_id']; ?></h2>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" href="logout.php">Logout</a>
    </li>
  </ul>
</nav>
<div class="formcontainer">
<form method="post" id="i_form">
<script type="text/javascript">
document.body.onload = addElement;
  function addElement() {
    var names=<?php echo json_encode($_SESSION['names']);?>;
    var DOBS=<?php echo json_encode($_SESSION['DOBS']);?>;
    var genders=<?php echo json_encode($_SESSION['genders']);?>;
    var pids=<?php echo json_encode($_SESSION['pids']);?>;
// Adds an element to the document
  // console.log($_SESSION['t_no']);
  var p = document.getElementById('i_form');
  var t_no = '<?php echo $_SESSION["t_no"]; ?>';
  var comman=document.createElement('div');
  comman.innerHTML=`<label><strong>PNR:- </strong><?php echo $_SESSION['pnr']?><br>
<label><strong>train_no:- </strong><?php echo $_SESSION['train_no']?><br>
<label><strong>coach_type:- </strong><?php echo $_SESSION['coach_type']?><br>
<label><strong>DOJ:- </strong><?php echo $_SESSION['DOJ']?><br>
<label><strong>Number of passengers:- </strong><?php echo $_SESSION['t_no']?><br>
<label><strong>Booking agent_id:- </strong><?php echo $_SESSION['agent_id']?><br>
  `;
  p.appendChild(comman);
  for(var i=1;i<=t_no;i++){
    var newheading=document.createElement('h3');
    var newdivision=document.createElement('div');
    // var newElement = document.createElement('button');
    var linebreak=document.createElement('br');
    newheading.innerHTML='Passenger '+String(i)+':';
    /* newheading.setAttribute('id', 'head'+String(i)); */
    newdivision.innerHTML=`<div class='formcontainer'>
    <div class='container'>
    <label for='name'><strong>name:- </strong>${names[i-1]}</label><br>
    <label for='pid'><strong>P_id:- </strong>${pids[i-1]}</label><br>
    <label for='DOB'><strong>DOB:- </strong></label>${DOBS[i-1]}<br>
    <label for='gender'><strong>Gender:- </strong></label>${genders[i-1]}<br>
    </div>`;
    // console.log(newdivision.innerHTML);
    p.appendChild(newheading);
    p.appendChild(newdivision);
    p.appendChild(linebreak);
  }
  }
  function clear(){
    document.getElementById('train_no')='';
    document.getElementById('DOJ')='';
    document.getElementById('sleeper_seats_capacity')='';
    document.getElementById('AC_seats_capacity')='';
  }
</script>

</form>
<button type='' value='back' onclick="window.location.href='welcome.php'">Back</button>
</div>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
$result = pg_query_params('Select book_pnr($1, $2, $3, $4,$5);',array(
  $_SESSION['train_no'],
  $_SESSION['coach_type'],
  $_SESSION['DOJ'],
  $_SESSION['t_no'],
  $_SESSION['agent_id']
))
        or die('Unable to CALL stored procedure: ' . pg_last_error());
$pnr=pg_fetch_row($result);
// echo $pnr[0].'\n';
for ($i=1; $i <=$_SESSION['t_no']; $i++) {
  $result = pg_query_params('Select add_psngr($1, $2, $3);',array(
    $_POST["name".$i],
    $_POST["DOB".$i],
    $_POST["gender".$i],
  ))
          or die('Unable to CALL stored procedure: ' . pg_last_error());
  $pid=pg_fetch_row($result);
  // echo $pid[0];
  $result = pg_query_params('Select book_ticket($1, $2, $3,$4,$5);',array(
    $pid[0],
    $pnr[0],
    $_SESSION['train_no'],
    $_SESSION['DOJ'],
    $_SESSION['coach_type']
  ))
          or die('Unable to CALL stored procedure: ' . pg_last_error());
}
}
?>
</body>
</html>
