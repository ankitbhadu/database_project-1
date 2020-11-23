<?php
   include('session.php');
?>
<html>

<head>
  <title>Welcome </title>
</head>
<body>
  <h1>Welcome <?php echo $_SESSION['admin_id']; ?></h1>
<form class="" action="" method="post">
    <label for="train_no">train_no</label><br>
    <input type="text" id="train_no" name="train_no"><br>
    <label for="source_id">source_id</label><br>
    <input type="text" id="source_id" name="source_id"><br>
    <label for="destination_id">destination_id</label><br>
    <input type="text" id="destination_id" name="destination_id"><br>
    <label for="coaches_capacity">coaches_capacity</label><br>
    <input type="text" id="coaches_capacity" name="coaches_capacity"><br>
    <input type="submit" value="Submit" onclick="clear()">
    <script type="text/javascript">
      function clear(){
        document.getElementById('train_no')='';
        document.getElementById('source_id')='';
        document.getElementById('destination_id')='';
        document.getElementById('coaches_capacity')='';
      }
    </script>
  </form>
  <button type="button" name="button" onclick="window.history.back()">Back</button>
  <h2><a href="logout.php">Sign Out</a></h2>
  <?php
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    if($_POST['train_no']=='' or $_POST['source_id']=='' or $_POST['destination_id']=='' or $_POST['coaches_capacity']==''){
      echo '<script>alert("No field should be empty")</script>';
      die();
    }
    if(strlen($_POST['train_no'])!=5 and is_numeric($_POST['train_no'])){
      echo '<script>alert("train_no should have length 5")</script>';
      die();
    }
    if(strlen($_POST['source_id'])!=5 and is_numeric($_POST['source_id'])){
      echo '<script>alert("source_id should have length 5")</script>';
      die();
    }
    if(strlen($_POST['destination_id'])!=5 and is_numeric($_POST['destination_id'])){
      echo '<script>alert("destination_id should have length 5")</script>';
      die();
    }
    $sql = "SELECT * FROM train WHERE train_no = '{$_POST['train_no']}'";
    $result = pg_num_rows(pg_query($db,$sql));
    if ($result!=0) {
      echo '<script>alert("train_no already exists")</script>';
      die();
    }
    if($_POST['source_id']==$_POST['destination_id']){
      echo '<script>alert("Source and Destination id cannot be same")</script>';
      die();
    }
      $result = $result = pg_query_params('CALL Insert_Train($1, $2, $3, $4)',
                array($_POST['train_no'],$_POST['source_id'],$_POST['destination_id'],$_POST['coaches_capacity']))

              or die('Unable to CALL stored procedure: ' . pg_last_error());
      echo 'train_added successfully.';
  }
  ?>
</body>
</html>
