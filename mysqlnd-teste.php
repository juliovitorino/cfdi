 <?php

$db_name = "elite759_teste";
$db_user = "elite759_teste";
$db_pass = "^DviHwRyXT(!k$)PgJ7*";

$con = mysqli_connect("localhost",$db_user,$db_pass,$db_name);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
else {echo "Ok I can connect to the Database!<br>";};

$mysqlnd = function_exists('mysqli_fetch_assoc');

if ($mysqlnd) {
    echo '<br>mysqli_fetch_assoc enabled!';
} else {
    echo '<br>mysqli_fetch_assoc not enabled!';
}

?> 
