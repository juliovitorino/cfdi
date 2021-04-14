<?

$banco = "elite759_plimbo";

$usuario = "elite759_canvt50";

$senha = "Fork3t56nt@205c";

//$hostname = "localhost";

$hostname = "br428.hostgator.com.br";

$conn = mysql_connect($hostname,$usuario,$senha); mysql_select_db($banco) or die( "Não foi possível conectar ao banco MySQL");

if (!$conn)

{

echo "Não foi possível conectar ao banco MySQL. ";

exit;

}

else

{

echo "Conexão com o banco Mysql estabelecida!. ";

}

mysql_close();

?>
