<?php

//http://junta10.dsv:8080/cfdi/php/classes/gateway/imprimir-qrcodes.php?tokenid=94ff924c950e30271f2005c3018009e7f5f44d8d&cmpid=1&qtdeqr=100
//https://elitefinanceira.com/producao/cfdi/php/classes/gateway/imprimir-qrcodes.php?tokenid=94ff924c950e30271f2005c3018009e7f5f44d8d&cmpid=1&qtdeqr=100


// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$campid = $_GET['cmpid'];
$qtdeqr = isset($_GET['qtdeqr']) ? (int)$_GET['qtdeqr'] : 100 ;

include_once '../../inc/validarTokenApp.php';

// Requires necessários para acesso ao backend de qrcodes
require_once '../usuarios/UsuarioServiceImpl.php';
require_once '../campanha/campanhaServiceImpl.php';
require_once '../campanhaqrcode/campanhaQrCodeServiceImpl.php';

// Pesquisar as informações da campanha
$campsvc = new CampanhaServiceImpl();
$campdto = $campsvc->pesquisarPorID($campid);
if(is_null($campdto)) {
  echo "<h2>Informações inválidas</h2>";
  die;
}

$usuasvc = new UsuarioServiceImpl();
$usuadto = $usuasvc->pesquisarPorId($campdto->id_usuario);

// a campanha pertence ao dono real
if($campdto->id_usuario != $sessaodto->usuariodto->id)
{
  echo "<h2>Informações inválidas do proprietário da campanha</h2>";
  die;
}

//popula dados
$parceiro = $usuadto->apelido;
$campdesc = $campdto->nome;
$premio = $campdto->recompensa;

// Buscar uma lista de QRCodes livres da campanha
$caqrsvc = new CampanhaQrCodeServiceImpl();
$qrcodepaginas = $caqrsvc->listarCampanhaQrCodeIdCampanhaPorStatus($campid,"A",1,$qtdeqr);

if(count($qrcodepaginas->lst) == 0)
{
  echo "<h2>QRCodes acabaram</h2>";
  die;

}

$qrcodes = array();
$tickets = array();
foreach ($qrcodepaginas->lst as $key => $value) {
  array_push($qrcodes, $value->qrcodecarimboImpressao);
  array_push($tickets, $value->ticket);
}

?>
<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

.tr-dash {
  border-bottom: 2px dashed #000;
}
div{
  position: relative;
  top: -50px;
  left: 35px;
}
.logo {
  position: relative;
  top: 1px;
  left: 5px;
  width: 64px;
  height: 64px;
}

.logo img {
  width: 64px;
  height: 64px;
}


</style>
</head>
<body>

<table>

<?php
    $instrucoes = "";
    $instrucoes .= "<ol>";
    $instrucoes .= "<li>baixe o aplicativo na sua loja</li>";
    $instrucoes .= "<li>Toque no botão CAPTURAR</li>";
    $instrucoes .= "<li>Aponte sua câmera para este QRCode</li>";
    $instrucoes .= "<li>ou digite o código informado</li>";
    $instrucoes .= "</ol>";
    
    $idx = 0;
    $dim = "245x245";
    while ($idx <= count($qrcodes)-1){

        // 4 QRC x linha
        $htmltrtd = "";
        $htmltrtd .= "            <tr>";
        $htmltrtd .= "                <td><span class='logo'><img src='http://junta10.com/assets/img/logo-64x64-site.png'></div><div><center>Baixe Agora o Aplicativo<br><strong>JUNTA10</strong><br>Na sua loja de aplicativos</center></div></td>";
        $htmltrtd .= "                <td><span class='logo'><img src='http://junta10.com/assets/img/logo-64x64-site.png'></div><div><center>Baixe Agora o Aplicativo<br><strong>JUNTA10</strong><br>Na sua loja de aplicativos</center></div></td>";
        $htmltrtd .= "                <td><span class='logo'><img src='http://junta10.com/assets/img/logo-64x64-site.png'></div><div><center>Baixe Agora o Aplicativo<br><strong>JUNTA10</strong><br>Na sua loja de aplicativos</center></div></td>";
        $htmltrtd .= "                <td><span class='logo'><img src='http://junta10.com/assets/img/logo-64x64-site.png'></div><div><center>Baixe Agora o Aplicativo<br><strong>JUNTA10</strong><br>Na sua loja de aplicativos</center></div></td>";
        $htmltrtd .= "            </tr>";

        $htmltrtd .= "            <tr>";
        $htmltrtd .= "                <td>Como aplicar seu selo digital" . $instrucoes ."</td>";
        $htmltrtd .= "                <td>Como aplicar seu selo digital" . $instrucoes ."</td>";
        $htmltrtd .= "                <td>Como aplicar seu selo digital" . $instrucoes ."</td>";
        $htmltrtd .= "                <td>Como aplicar seu selo digital" . $instrucoes ."</td>";
        $htmltrtd .= "            </tr>";

        $htmltrtd .= "            <tr>";

        // Checa se a 1a coluna tem elemento para evitar erro de runtime 'Undefined offset error in PHP'
        if(isset($qrcodes[$idx]))
        {
          $htmltrtd .= "                <td><center style='font-size:10px;'><img src='https://chart.googleapis.com/chart?chs=$dim&cht=qr&chl=$qrcodes[$idx]'><br><span style='font-size:20px;'>$tickets[$idx]</span><div style='font-size:12px;'>Válido por 6 horas</div></center></td>";
        } else {
          //$htmltrtd .= "                <td><center style='font-size:10px;'><img src='https://chart.googleapis.com/chart?chs=$dim&cht=qr&chl=0'><br><span style='font-size:20px;'>000.000.000-00</span><div style='font-size:12px;'>Válido por 6 horas</div></center></td>";
          $htmltrtd .= "                <td>&nbsp;</td>";
        }
        $idx++;

        // Checa se a 2a coluna tem elemento para evitar erro de runtime 'Undefined offset error in PHP'
        if(isset($qrcodes[$idx]))
        {
          $htmltrtd .= "                <td><center style='font-size:10px;'><img src='https://chart.googleapis.com/chart?chs=$dim&cht=qr&chl=$qrcodes[$idx]'><br><span style='font-size:20px;'>$tickets[$idx]</span><div style='font-size:12px;'>Válido por 6 horas</div></center></td>";
        } else {
          //$htmltrtd .= "                <td><center style='font-size:10px;'><img src='https://chart.googleapis.com/chart?chs=$dim&cht=qr&chl=0'><br><span style='font-size:20px;'>000.000.000-00</span><div style='font-size:12px;'>Válido por 6 horas</div></center></td>";
          $htmltrtd .= "                <td>&nbsp;</td>";
        }
        $idx++;

        // Checa se a 3a coluna tem elemento para evitar erro de runtime 'Undefined offset error in PHP'
        if(isset($qrcodes[$idx]))
        {
          $htmltrtd .= "                <td><center style='font-size:10px;'><img src='https://chart.googleapis.com/chart?chs=$dim&cht=qr&chl=$qrcodes[$idx]'><br><span style='font-size:20px;'>$tickets[$idx]</span><div style='font-size:12px;'>Válido por 6 horas</div></center></td>";
        } else {
          //$htmltrtd .= "                <td><center style='font-size:10px;'><img src='https://chart.googleapis.com/chart?chs=$dim&cht=qr&chl=0'><br><span style='font-size:20px;'>000.000.000-00</span><div style='font-size:12px;'>Válido por 6 horas</div></center></td>";
          $htmltrtd .= "                <td>&nbsp;</td>";
        }
        $idx++;

        // Checa se a 4a coluna tem elemento para evitar erro de runtime 'Undefined offset error in PHP'
        if(isset($qrcodes[$idx]))
        {
          $htmltrtd .= "                <td><center style='font-size:10px;'><img src='https://chart.googleapis.com/chart?chs=$dim&cht=qr&chl=$qrcodes[$idx]'><br><span style='font-size:20px;'>$tickets[$idx]</span><div style='font-size:12px;'>Válido por 6 horas</div></center></td>";
        } else {
          //$htmltrtd .= "                <td><center style='font-size:10px;'><img src='https://chart.googleapis.com/chart?chs=$dim&cht=qr&chl=0'><br><span style='font-size:20px;'>000.000.000-00</span><div style='font-size:12px;'>Válido por 6 horas</div></center></td>";
          $htmltrtd .= "                <td>&nbsp;</td>";
        }
        $idx++;

        $htmltrtd .= "            </tr>";

        $htmltrtd .= "            <tr class='tr-dash'>";
        $htmltrtd .= "                <td>$parceiro<br>Campanha: $campdesc<br>Prêmio: <strong>$premio</strong></td>";
        $htmltrtd .= "                <td>$parceiro<br>Campanha: $campdesc<br>Prêmio: <strong>$premio</strong></td>";
        $htmltrtd .= "                <td>$parceiro<br>Campanha: $campdesc<br>Prêmio: <strong>$premio</strong></td>";
        $htmltrtd .= "                <td>$parceiro<br>Campanha: $campdesc<br>Prêmio: <strong>$premio</strong></td>";
        $htmltrtd .= "            </tr>";
    
        echo $htmltrtd; 
    }

?>



</table>

</body>
</html>
