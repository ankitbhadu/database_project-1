<?php
  include('../config.php');
  session_start();
  // $sql="select * from agent";
   // $result = pg_query($sql);
   $error="";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      $myagent_id = $_POST['agent_id'];
      $mypassword = $_POST['password'];
      $name=$_POST['name'];
      $cc_no=$_POST['cc_no'];
      $sql = "insert into agent values('$myagent_id','$mypassword');";
      $result = pg_query($db,$sql);
      if (!$result) {
        echo "An error occurred.\n";
        exit;
      }
      $sql = "insert into booking_agent values('$myagent_id','$name','$cc_no','$mypassword');";
      $result = pg_query($db,$sql);
      if (!$result) {
        echo "An error occurred.\n";
        exit;
      }
   }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Agent Registration form</title>
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
    <form method="post">
      <h1>Agent Registration</h1>
      <div class="formcontainer">
      <hr/>
      <div class="container">
        <label for="uname"><strong>Username</strong></label>
        <input type="text" placeholder="Enter Username" name="agent_id" required>
        <label for="name"><strong>Name</strong></label>
        <input type="text" placeholder="Enter name" name="name" required>
        <label for="cc_no"><strong>cc_no</strong></label>
        <input type="text" placeholder="Enter credit card number" name="cc_no" required>
        <label for="psw"><strong>Password</strong></label>
        <input type="password" placeholder="Enter Password" name="password" required>
        <div style = "font-size:14px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
      </div>
      <button type="submit" value="submit">Register</button>
    </form>
    <button onclick="window.location.href='../index.php'">Go Back</button>
  </body>
</html>
