<?php

//http://www.junta10.com/table.php?p=Kiriatti%20Empório&cd=Makimono dos Sonhos&premio=GANHA 1 Barco do Amor

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
order by CAQR_NU_ORDER
LIMIT 100

*/

/**
 * ------------------------------------------------------------
 * C O M O    E X E C U T A R    O     P  R O C E D I M E N T O 
 * ------------------------------------------------------------
 * 1 - Rode a query acima no banco de dados de produção e troque os parametros colocitados
 * 2 - copie o resultado e cole na array $qrcodes
 * 3 - faça upload deste php para pasta HOME do junt10
 * 4 - execute a URL http://www.junta10.com/table.php?p=<nome-do-parceiro>&cd=<descricao-campanha>&premio=<Premio da Campanha>
 * veja exemplo: http://www.junta10.com/table.php?p=Kiriatti%20Empório&cd=Makimono dos Sonhos&premio=GANHA 1 Barco do Amor
 */

$qrcodes = [
  'd0c07c1fee14548ce22dbdc72cd343b4f6705120',
  'f224f4b682ad3c987330ec783a95f8c46c6042e6',
  'faf8be26bcf16c20ccae1107df73ab40c3e75a64',
  'fcc8295a0b6a19309e02021dbf83390e44336994',
  '9668377ae5f9576391943a73774aba555696735f',
  '0cf9c70e65fd4442225fe981e1e099fcc5fcbb0d',
  '9809b37c0c202106a4c88a81bcb123cc49342921',
  '22b406ee579f2c6e7ca7cc23acad4d9941c3e258',
  '95229f3f24d0558257f3fab39cefe25409ee9489',
  '839a6c6618d4d67064c52522f9f0a2344c7ac8a7',
  'a08ef2a5ec8f83fff006826cabae6bfc09eef1f4',
  'aefbb53ead7ef0d2e1381a6951d1066acc3e3dd7',
  '9ac9863ec023147afa0061b69a9885eabba9b164',
  '4650caf4b8311cc1d431307a4b6c4a1e0da5772f',
  'fb3f36ee95eaec403864b7fa40355d87cec1fcd0',
  '4cfd156e9f02a375d27e4c84464db1228128eba6',
  'f2ee8824fb05a06ec4a9410f6516f635a2a47ad7',
  '0597f6676fbe62a2eaaa06ced68c03745f8c8445',
  '819fe3b5f44b0dc152b672afbc5389f2673d9c30',
  '35c4031aa8cf2c97a26449333cb68bf7111c28a6',
  '5165a5ad2c51368348a74fc8ddb5cc8f6054230f',
  'f665f7f606e7096461d7600612eccd5a3ae19fe0',
  'cbde090c6dd3c5319a6f33b6eaaa6e6a9cf79209',
  '5e2a84ba6deaffbccf5433f242688bf08b627582',
  'a6a3540280972602e7b78f9110e480ba09aad52f',
  '0c55498598dc00ff021975219e91f689a9f9c37b',
  '59f770a61c7b7d2fad5606ad834245ec5cc64762',
  'fe2016ea5ba05ac5cb0ded9ec20bd7d981256e62',
  '0b0bd7ba9749448ff2118ab54c4ba3a3c7eb529b',
  '3439b1b17b0f27a3a99ce5b3b6a4529f864ff002',
  'e5ebd450f96501433f5d04f81100283897152a9e',
  '099058779b64da2826973db3007d8df4fe362ccf',
  '8c8c258ff544c00e8fe767943b589d1bea299749',
  '4069eecb3cc1d76b5a729adb42f8992c96ee761e',
  '3865d8ac945c6d6ebc03f9b72e449b04679fb68f',
  '67aad2022b28ea821ea224a1442b7d2a8e1c0ea6',
  'd82006476a4b507c568f8902fb85f21589f27ee5',
  '85074b2c895f89ba73c29f57a989c91c80ec7d3c',
  '4df71893011cd0862c269871ecb02a9296e58fe9',
  '2f0bea28789a0013806a417df6248763a7590912',
  'c60592f7b739f6dfb2d5995e1dbce4dc9273d604',
  '600e1a8f26cd9f6c5684df39265711d3bbb90ccf',
  'a3e8576da6af14464e728fd383c023f4cfaabe2d',
  'c8b014ba51c69f06055b9d2109e8b1b72538017d',
  'caff83097ab667e098c6056a6b2a0b998f1508f9',
  '30f703c320ea0d41608d7cd9425d571160697245',
  'bc351ccfe240f3c08569d9c5d3c8e08aa616c823',
  '3e88ba7b6233947c9f754132b16285c9bb7fd204',
  '8a1d5ecc2dbb1cbb20ee5b8b75cc29bc5aece58a',
  '6a92a0db07ea48d1aeebfbf3c1a51504146a3400',
  '33286862a55593d75f16c9ab1f68183f1de83b93',
  '2e1259c94e21f06af2dad406067474b153978934',
  '216714a1de0b188fcd7289b7ee19ae8c0d3d63d6',
  'b4e07a829319de4d6630e5601cc959398b1ffc86',
  'fd520d435e6f23f80e300ba6a19975584eee5efe',
  'de447bfe111a27e1d882a7a65c051e00e3605b19',
  '6350c092ed2d8025a02c173fdb3ef5cd20a97345',
  '5e9437cfff586d46fb267db0a55b7b637a51e870',
  '48cbea266d60cbba5ab6f739eee648b34ba315f7',
  '99a415036da6e3691d2e2a038021c2641e710fa3',
  '514ddec74a0c805472f37a08f61661e7c06c29b8',
  'b5b56f29063c181d7e278890d3617179f88f5635',
  'ff1b37d40fb5176ef496249de80f821cdb92e834',
  '5bfd31ea9acffff17e8940c2ad5433e7b1e719cf',
  '7c4ed9a138e2c49fcfe82d3d88547d11902e32fc',
  '88d244199a968a74e3c6b10b4049cbb1a1413524',
  '502cec9b392a824a4b01cea7214a512dd8da9d2b',
  'bffc4fd9e5f3d4b3b1c6790800aeab036072a35c',
  '615627c4bd5824fe5f2abe62d5d56f205931ab82',
  'bb0649bdc2a9795d81676b47dd8f8698508e4e09',
  '40ae893001e7116ed3de3a2399d8a747e1cd8015',
  '4dcd9acf8d9f2a9fea527e626f651494b138594c',
  'caf27fdadf6eed9b9fd776c875cb7dcaa5e5a4bb',
  '1c15c364c662651a4ff066b6ad2c20819dc6dbe9',
  'd41e34877636e7ebdd66d29796b2fe6e567de4a6',
  'e8d3611e6e8d5402a89dc6521e4bc453873b9a04',
  '3eb3b562b686dcdc45220e8a94249f06177f3724',
  'e79dd06feb2eef1827a3e01dbe34341fd0b940e9',
  'a121463742bece0f34ca2f701467cd69b8fba437',
  '43d5fd0147e55f183dc2cb5da80268ba9eb2de6c',
  'd1c51be809b1728b7b4f737563fd5ce416d4e435',
  '2f81f4f64641b0a3ffd0a5965a54ca5d97db4adc',
  '00ce21b89661009b86e721dfa68cee1eebbd7bd5',
  '6487ebb48878c6b6af5e4ff407b36bfc9dda9e95',
  'a1ed7f618e978a8bada86d3fef3886dfa95eef03',
  'a844e23b81a9ad8605df431b6585d4bf089571cd',
  '553ae3370afbfa7b26c15d6e6596d861359f288c',
  '6334c81c7ff38085acb9aac62fa42e6e9813e07d',
  'a93ee0d69e1f5f497073174a53e3cb1c526d50d0',
  '5e527915b35eb1131fcfe8cab0b43c702c09a745',
  '72c4ead377ea2cc9f7576053737aa62dddc0de31',
  'ac764db1fe26e9475f54978a3d4afaefe0b9fdae',
  '06ec96998de492b080795d0bfa98bd69a9fa30aa',
  '9fdf792c85dc7d3d9760b6b3f1de00e96223d0ef',
  '3bc427e63ecba0abf0cc0608da278f6be7bfb4ea',
  '100ee737443db80e477c9cb26cecf621c1065d01',
  '20e43fcebf6e43a2e2b2cfe8f2fd0d05ff3d5c1b',
  '94d7b47d6dc172660938eaa0bb330ee5dee7c0b4',
  '1b6f7c90b120d8255ada4e33a4b5040756274fd5',
  '2d941b68c8443337f1a282894a66792fec75f1cf',
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

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<h3>Imprima os carimbos, corte e distribua aos clientes que consumirem seus produtos</h3>
<h3>Peça ao cliente para baixar e instalar o junta10 e capturar o QR Code</h3>

<table>
  <tr>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[0] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[1] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[2] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[3] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[4] ?>"></td>
  </tr>
  <tr>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
  </tr>

  <tr>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[5] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[6] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[7] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[8] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[9] ?>"></td>
  </tr>
  <tr>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
  </tr>

  <tr>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[10] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[11] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[12] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[13] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[14] ?>"></td>
  </tr>
  <tr>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
  </tr>

  <tr>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[15] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[16] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[17] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[18] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[19] ?>"></td>
  </tr>
  <tr>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
  </tr>

  <tr>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[20] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[21] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[22] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[23] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[24] ?>"></td>
  </tr>
  <tr>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
  </tr>

  <tr>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[25] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[26] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[27] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[28] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[29] ?>"></td>
  </tr>
  <tr>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
  </tr>

  <tr>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[30] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[31] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[32] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[33] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[34] ?>"></td>
  </tr>
  <tr>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
  </tr>

  <tr>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[35] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[36] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[37] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[38] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[39] ?>"></td>
  </tr>
  <tr>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
  </tr>


  <tr>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[40] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[41] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[42] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[43] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[44] ?>"></td>
  </tr>
  <tr>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
  </tr>

  <tr>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[45] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[46] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[47] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[48] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[49] ?>"></td>
  </tr>
  <tr>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
  </tr>

  <tr>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[50] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[51] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[52] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[53] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[54] ?>"></td>
  </tr>
  <tr>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
  </tr>

  <tr>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[55] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[56] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[57] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[58] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[59] ?>"></td>
  </tr>
  <tr>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
  </tr>

  <tr>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[60] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[61] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[62] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[63] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[64] ?>"></td>
  </tr>
  <tr>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
  </tr>

  <tr>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[65] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[66] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[67] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[68] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[69] ?>"></td>
  </tr>
  <tr>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
  </tr>

  <tr>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[70] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[71] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[72] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[73] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[74] ?>"></td>
  </tr>
  <tr>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
  </tr>

  <tr>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[75] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[76] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[77] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[78] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[79] ?>"></td>
  </tr>
  <tr>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
  </tr>

  <tr>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[80] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[81] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[82] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[83] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[84] ?>"></td>
  </tr>
  <tr>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
  </tr>

  <tr>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[85] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[86] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[87] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[88] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[89] ?>"></td>
  </tr>
  <tr>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
  </tr>


  <tr>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[90] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[91] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[92] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[93] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[94] ?>"></td>
  </tr>
  <tr>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
  </tr>

  <tr>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[95] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[96] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[97] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[98] ?>"></td>
    <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $qrcodes[99] ?>"></td>
  </tr>
  <tr>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
    <td><?php echo $parceiro ?><br>Campanha: <?php echo $campdesc ?><br>Prêmio: <?php echo $premio ?></td>
  </tr>


</table>

</body>
</html>
