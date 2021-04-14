 <?php

$db_name = "elite759_plimbo";
$db_user = "elite759_canvt50";
$db_pass = "Fork3t56nta205cwv";

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
