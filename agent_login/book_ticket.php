<?php
   include('session.php');
?>
<html>

<head>
  <title>Welcome </title>
</head>
<body>
  <h1>Welcome <?php echo $_SESSION['agent_id']; ?></h1>
<form class="" action="" method="post" id="i_form">
    <script type="text/javascript">
    document.body.onload = addElement;
      function addElement() {
    // Adds an element to the document
      // console.log($_SESSION['t_no']);
      var p = document.getElementById('i_form');
      var t_no = '<?php echo $_SESSION["t_no"]; ?>';
      for(var i=0;i<t_no;i++){
        var newheading=document.createElement('h3');
        var newdivision=document.createElement('div');
        // var newElement = document.createElement('button');
        var linebreak=document.createElement('br')
        newheading.innerHTML='Person '+String(i+1)+':';
        newheading.setAttribute('id', 'head'+String(i+1));
        newdivision.innerHTML='<label for=\"name\">name</label><br><input type=\"text\" id=\"name'+String(i+1)+'\" name=\"name'+String(i+1)+'\"><br><label for=\"DOB\">DOB</label><br><input type=\"text\" id=\"DOB'+String(i+1)+'\" name=\"DOB'+String(i+1)+'\"><br><label for=\"gender\">gender</label><br><input type=\"text\" id=\"gender'+String(i+1)+'\"name=\"gender'+String(i+1)+'\"><br>';
        console.log(newdivision.innerHTML);
        p.appendChild(newheading);
        p.appendChild(newdivision);
        p.appendChild(linebreak);
      }
      var submit=document.createElement('input');
      submit.setAttribute('type',"submit");
      submit.setAttribute('value',"Book Ticket");
      p.appendChild(submit);
      }
      function clear(){
        document.getElementById('train_no')='';
        document.getElementById('DOJ')='';
        document.getElementById('sleeper_seats_capacity')='';
        document.getElementById('AC_seats_capacity')='';
      }
    </script>
  </form>
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
    echo $pid[0];
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
  <button type="button" name="button" onclick="window.history.back()">Back</button>
  <h2><a href="logout.php">Sign Out</a></h2>
</body>
</html>
