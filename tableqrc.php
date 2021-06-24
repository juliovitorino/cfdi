<?php

//http://www.junta10.com/tableqrc.php?p=junta10&cd=CampanhaJ10&premio=Qrcodes Teste

$parceiro = $_GET['p'];
$campdesc = $_GET['cd'];
$premio = $_GET['premio'];

/*

-- script para extrair os QRCodes abaixo pra grampear junto com folder de estimulo de consumo
SELECT concat('''',`CAQR_TX_QRCODE`,''',')
FROM `CAMPANHA_QRCODES` 
WHERE `CAMP_ID`= <codigo da campanha>
and `CAQR_IN_STATUS`='A'
and CAQR_NU_ORDER between <inicio i.e. 1> AND <fim i.e. 100>
order by CAQR_NU_ORDER DESC

*/

/**
 * ------------------------------------------------------------
 * C O M O    E X E C U T A R    O     P  R O C E D I M E N T O 
 * ------------------------------------------------------------
 * 1 - Rode a query acima no banco de dados de produção e troque os parametros colocitados
 * 2 - copie o resultado e cole na array $qrcodes
 * 3 - faça upload deste php para pasta HOME do junt10
 * 4 - execute a URL http://www.junta10.com/tableqrc.php?p=<nome-do-parceiro>&cd=<descricao-campanha>&premio=<Premio da Campanha>
 * veja exemplo: http://www.junta10.com/tableqrc.php?p=Kiriatti%20Empório&cd=Makimono dos Sonhos&premio=GANHA 1 Barco do Amor
 */

$qrcodes = [
'ee4fe0d729da77d78b1e7007d329aa4e27f613e5',
'29422e85aaa19f8556e6d0f1b2aa2a7c2068383d',
'7c903772716e9676e04f56257b33080521280cf0',
'43c3910f44ee3add861df98d280fa1fed40409dc',
'2c8cae0bb1208bece854be148f39c1b0befc9a70',
'9b6099dd313d183ce03c2d2b4853a525384b99aa',
'587aa968c14ceddf94d509227394795bf0c5704c',
'0867a2ce9569a5cad75717bc96674a03cb412a2e',
'd8e2a40786c0921b377765d5484be33d99610f59',
'50c644087329791819978f6cb8f7dfa9ed898dc9',
'cfa4eb02fba0312823616e919c6b14ec1d3dc61d',
'b1140f4824186714febf6152588826f9a9842119',
'93ae00dfab1332fba0d035e555a3465cc2c4dcc5',
'6657a69e70968f684ffdfc28dc0d627382287291',
'42acabd13afb991cb9f433dfba563ef3c9bb0177',
'71dbfdccab975515f3e364f5206e910bde217eb1',
'7cec4502aed48696e996f21bbcdb357716bae7cc',
'a6c9f5d9b3d0ba99e541811b66bc3d4e60cd1498',
'ff353d1f6c588b20976a9e7421f842cbed080f43',
'c9bde3e36de838543eecdacdde635541be030f96',
'0044d94379f38c124597a34fe2c11251d72acdf6',
'33acdf48ddee9c0f9362b7928bbfc27fbf652714',
'a397abc7d4d23cf7705f51d16a12a437f0182abe',
'5e75c8fda29104463434d415636287adcd8d45c6',
'd4f25e05c27b3d1852331af46067fbb4c562f7cb',
'bc54112bcc09a2044996425baafdfe8028e8fe11',
'01b48abb64a72a91793f0f313812f0ed12f18a12',
'7cd1d7eb2e79c4bb422956c91a85709d2ae26fb9',
'5278900debb1d4450abca90909a6f31f3512574e',
'4ca4f562d5c558a0f5d72e992b20aeee4cc89a33',
'25c43183b9c8cc07ae469cc9dfe7793ee2ad4475',
'7d3dcfc72f2f77c8f74b37df386e385380bf565d',
'4c8f90c94a812a55181cb531cb7ec9e5c3bc3592',
'0d137fd610e801a3fef532b3ace63c3a30afdcdc',
'd42123c09babadbab9c826bcf1a29eff034618bb',
'2e9765358c4b52dcac6285eb307d508c5d707af2',
'5ec097026043746fbfdd553edb95e824a59558c4',
'f3425a33f5ecbb2b24efde26af20dc25d866403a',
'c48d75bc104af94bb20e9bff7e600b76868c5004',
'49eaab76960c3132061815a5a787f25ec5c29f0e',
'5716363548a6c70d9753d8d176bc2b7865180ad6',
'd4d39af98e4f888dfa49745dc54c13159d6ed7b7',
'73f29f0858112833c6ead96e70c9b7c5a662da65',
'c43d8861eaa5cdd11a6f1eccadbc4515f74101e6',
'2888077e3ac11f65bbb68afc606be60c549cf4ca',
'329dae8d292ce2f296f4298ba69b26ef6d77c0cf',
'7887f4545a01c968b09ed466a71e3ddd3d819d8a',
'8d812f4a496ddd3e46128aa9b2ade48258bcb53a',
'f62557f17af574f627e4ec45ad36231524fc875e',
'6038fccc095a2f3cda18d0c0e6658aadaf9b2d30',
'e4e39f35f031a1529cd52222f86d46780fdf5e51',
'56fb8bceeafab771c4aa3d9766a135c9fda83d2a',
'5946bbbbc1ae1ca2deca68bd2e9bb1c3582e9fa3',
'050bd68756ca90a5d664660f02dbb3dd7246c554',
'39d20371947b2492891958ee2ee3714b2c671f89',
'b599c6c578a87b5f7740db3e4510253603fbefde',
'4a1d5be0aa1c02c68ba7d3349dbbda8dddd28773',
'069add0ca3bb4ffb3e63b991f595908a303a8a92'
];

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

<h3>Imprima os carimbos, corte e distribua aos clientes que consumirem seus produtos</h3>
<h3>Peça ao cliente para baixar e instalar o junta10 e capturar o QR Code</h3>

<table>

<?php
    $idx = 0;
    $dim = "245x245";
    while ($idx < count($qrcodes)-1){

        // 4 QRC x linha
        $htmltrtd = "";
        $htmltrtd .= "            <tr>";
        $htmltrtd .= "                <td><span class='logo'><img src='http://junta10.com/img/logo-640x640.png'></div><div><center>Baixe Agora o Aplicativo<br><strong>JUNTA10</strong><br>Na sua loja de aplicativos</center></div></td>";
        $htmltrtd .= "                <td><span class='logo'><img src='http://junta10.com/img/logo-640x640.png'></div><div><center>Baixe Agora o Aplicativo<br><strong>JUNTA10</strong><br>Na sua loja de aplicativos</center></div></td>";
        $htmltrtd .= "                <td><span class='logo'><img src='http://junta10.com/img/logo-640x640.png'></div><div><center>Baixe Agora o Aplicativo<br><strong>JUNTA10</strong><br>Na sua loja de aplicativos</center></div></td>";
        $htmltrtd .= "                <td><span class='logo'><img src='http://junta10.com/img/logo-640x640.png'></div><div><center>Baixe Agora o Aplicativo<br><strong>JUNTA10</strong><br>Na sua loja de aplicativos</center></div></td>";
        $htmltrtd .= "            </tr>";

        $htmltrtd .= "            <tr>";
        $htmltrtd .= "                <td><center style='font-size:10px;'><img src='https://chart.googleapis.com/chart?chs=$dim&cht=qr&chl=$qrcodes[$idx]'><br>$qrcodes[$idx]</center></td>";
        $idx++;
        $htmltrtd .= "                <td><center style='font-size:10px;'><img src='https://chart.googleapis.com/chart?chs=$dim&cht=qr&chl=$qrcodes[$idx]'><br>$qrcodes[$idx]</center></td>";
        $idx++;
        $htmltrtd .= "                <td><center style='font-size:10px;'><img src='https://chart.googleapis.com/chart?chs=$dim&cht=qr&chl=$qrcodes[$idx]'><br>$qrcodes[$idx]</center></td>";
        $idx++;
        $htmltrtd .= "                <td><center style='font-size:10px;'><img src='https://chart.googleapis.com/chart?chs=$dim&cht=qr&chl=$qrcodes[$idx]'><br>$qrcodes[$idx]</center></td>";
        $idx++;
        $htmltrtd .= "            </tr>";

        $htmltrtd .= "            <tr class='tr-dash'>";
        $htmltrtd .= "                <td>$parceiro<br>Campanha: $campdesc<br>Prêmio: $premio</td>";
        $htmltrtd .= "                <td>$parceiro<br>Campanha: $campdesc<br>Prêmio: $premio</td>";
        $htmltrtd .= "                <td>$parceiro<br>Campanha: $campdesc<br>Prêmio: $premio</td>";
        $htmltrtd .= "                <td>$parceiro<br>Campanha: $campdesc<br>Prêmio: $premio</td>";
        $htmltrtd .= "            </tr>";
    
        echo $htmltrtd;
    }

?>



</table>

</body>
</html>
