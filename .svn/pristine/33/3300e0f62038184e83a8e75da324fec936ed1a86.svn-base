<?php

//kinghost
$mysqli = new mysqli("localhost", "elite759_canvt50", "Fork3t56nta205cwv", "elite759_plimbo");

//meu notebook
//$mysqli = new mysqli("127.0.0.1:3306", "plimbo50", "Fork3t56nta205cwv", "plimbo");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
 
$query = 'SELECT `SESS_ID`,' 
					. ' `SESS_TX_HASH`,'
					. ' `USUA_ID`,'
					. ' `SESS_IN_STATUS`,'
					. ' `SESS_DT_CADASTRO`,'
					. ' `SESS_DT_UPDATE` '
					. ' FROM `SESSAO` ';

if ($result = $mysqli->query($query)) {

    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {
        printf ("%s (%s)\n", $row["SESS_DT_CADASTRO"], $row["SESS_TX_HASH"]);
    }

    /* free result set */
    $result->close();
}

$id=1;
		$stmt = $mysqli->prepare($query . ' where SESS_ID = ?');
		$stmt->bind_param('i', $id );
		$stmt->execute(); 

		$row = $stmt->get_result();
		var_dump($row->fetch_array(MYSQLI_ASSOC));


?>