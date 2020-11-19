<html>
    <head>
    <title>My first PHP Website</title>
    </head>
    <body>
      <?php
         $host        = "host = 127.0.0.1";
         $port        = "port = 5432";
         $dbname      = "dbname = academic";
         $credentials = "user = postgres password=newpassword";

         $db = pg_connect( "$host $port $dbname $credentials"  );
         if(!$db) {
            echo "Error : Unable to open database\n";
         } else {
            echo "Opened database successfully\n";
         }
         $sql="SELECT * FROM course";
         $result = pg_query($sql);
         if (!$result) {
           echo "An error occurred.\n";
           exit;
         }
         while ($row = pg_fetch_row($result)) {
           echo "$row[0] $row[1] $row[2]";
           echo "<br />\n";
         }
      ?>
    </body>
</html>
