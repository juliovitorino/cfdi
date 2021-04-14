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
  '821371747148a1e936327bf4979990629d38021c',
  'ce6b55358cada7c4535054c7b99a10d82c7ffe3c',
  'e577634b98bd195b1226801f131c85bfab371ce7',
  'da9f7bed51fa3c30326ec657b69b36dff2cf5039',
  '2ef53b6870211f2d0c6cf2c64b7d74a5573cc1a7',
  '682ce161188617ad5068d8ca6e0241e8560a7439',
  '7cea2f40cc7f0d9260068357d3170419868a240d',
  '9ad02ee4fc96d50bd859afe92f1f7174c355c92e',
  '770a69d67e7d75609f8f3b82737e3691acad9009',
  'f7f97437bb6b83cfdfd616c10dcc7918b982538b',
  '1903b9f8fb80af0c2c0cc143f7a1dc861b75f764',
  'd3c88ce760f663164b89c6ef786cb96c83007a4a',
  'b2caee733adc3f5048b73e957f17327f0e9fe3c9',
  '7174ceaeb2f3f272b6ee4b489b7e6f5a7754e2e0',
  '269e86259c630108f7e4e9d4465afddec73b254b',
  'd19a0abc0edf507de3879d5d44633fccc5622c0d',
  'd52afd845bd7ea5934fb8341428bac0159b53643',
  '31cd87dd56e2dfef1297cce9f2afa73244ff41e8',
  '8991e17efa8f591cefd9f7a8b9b2afd451b4ac25',
  '0a44fad9c478295cea14d402a896a80a8c85412d',
  '6d4a80a6b2222e8b2a10d0481a2ba7a577bd56d4',
  '550c323067f05e2afe55d2e424ec1e3d7fdb9339',
  '0db5a9c5f284589adfd7cf0307cf04618c232ec5',
  '866035d3a8daff1fb4d84fc04011dcb945cb446e',
  '621b60e34e8803d8892b0da38049d1d0826beb56',
  '8c3a6390595be5c696f94f33b07c1b66ebe10171',
  '7c2b2f8475fde2c81763ae8c49b0e0ccd8334c6f',
  'a9d06390e8692502c46fd970a081f5c0998dcc54',
  'ffd45164b2a30bc75feb19d95b32c03bf4fb3944',
  'a0e9638b075d24a84783eea225f84865f1911caf',
  '134a84188405d0eb33838455643f1ca7cd6e3fa2',
  '7867bd7b891142c212842cbb46876fb5e58574c9',
  'ca3ff1b2225baeeb549c198cdd1d5140d9591bde',
  '8834479c99cd8b3c06ef785e3b11b57131b8518c',
  'ea0357497b4674095f69640e8d6ad70112f66d74',
  'afa242ed8f38106e10a198bee21a263433d61178',
  '968b11a12737e8a4c20c94d0faae3761c3b1060f',
  '311cb0ccf3eb867fbba3411eb9a5ed444299f452',
  '1f94fb0d41f5013910bd21493104adc124212c85',
  'd2e012deb51ea866923815ceca3ee7c856cdc63d',
  '4fda224001bdc33b8c0d08c25d73f24ee5061f9f',
  'f86c49e580353ac53711b954ba1ee084a45a709d',
  '00ef62a0d030f78de4bc83f5499965b42d9f76c8',
  'aa837b8291fad815dde52de8f03b219a8595bc63',
  '2d96911c6e50919de47b4318a1cab0bff74eb787',
  'c1fdcfa672287eeb44542034138b4b50f94290f6',
  'ed6afd48835febab11ad8f9d34edf80f4e814d84',
  '9d856acb59b51cc7f9c024f596a16b91857725c1',
  '4cf70b7e2904552bd4f5e3b2dad7086758d6e680',
  '5529c97019971281ad9bdf61e4a8fe4a84b0449a',
  'a982ccae714133f2551df4d45e8caf48373c8578',
  '3d10267437e0e47e786a6b0620a650b6e7785267',
  '51e7185b814ed3e4bbbb3ab470d3b45729c8b525',
  '9b4b838d9803c9d11ce9044c92c7c4dce5d717eb',
  '3902dc3468145d3ac24a9615929462b627d20497',
  '219bdb9d55dd4abeaef4d9b36e9953a66cb62416',
  '8dea7f4fd67f92e0d40c7308c240f0f1505dfb69',
  '0c46f72410a42a0b38a3b097001e18c63c78b294',
  '44e510c2a6defd7607058e571b5b606844489013',
  'b9211059b41f29d45418877b4fb1dcc2fb8ddccb',
  'd55d3b7af3c053450d0253f58bfc2062d5d7e092',
  '7729e45ea94f5023e72ac0b96767784579054294',
  '515d7af908eda7e7361acb544c1e2d6afa54122b',
  '3ceffa1af6e530ab56655e5abff839c56f1caa76',
  '957e086987e12da26d2f00e16f8bc1345879f915',
  '58521a267a2ea007e740d3ba84e14e3f37a34408',
  'a9d64e47c1c23516fb4f51311a072060876bdec8',
  'cacb23dc833a94e855e9709a8e6f5b0e4d649439',
  '359631e2b92ac500f9d85e91d8ee867349c2e1eb',
  '54b03e62b3319ad0a0a25842f90d7a3c0427a21a',
  '8b54731d9d0539d25934f13dcc15452368e5b479',
  '69f6d7bb66d6edabc116facef7a6ef348b01b1ad',
  'acb4be74605ca45d24c04260d7e8e50321761b0d',
  '93ffeb49d09137e0e5525960f8cee1ad6683b1a3',
  '9ae092de3483ed5d154bfc29830961518a324ad9',
  '45cc28de7bc4896f10f06d2a34aa0a4a940d1ecf',
  '21c9effce785055c669b0bed014491650f8bb7ce',
  '48297446eb42dce3da731ee3e2e0c9d8fe7a6872',
  'f2a5b14bab7712fbb46a0624092d0afaef61b8d3',
  'ed7058ba024b9241d86f59a5a16ff35db185ceb4',
  '52425e6ac9a9d36d7a4ffbf7f5771ddeb32a6d69',
  '7f4ee2eb53da19c4f3db6f94815ebcaaa99b38d7',
  '74ece35574f69fcb1df0ab93e8a8d75c2ca51b03',
  'b177d8265eb15a9ce2a0d4f1bb81477c5a3ac43d',
  'eac99255b9562b378fec159fc0446b34d5a23ef4',
  '5fbd30357ab20d540ea108559c0db304e4bfa2b5',
  '3abe69a8184257202fbeefe3d027073650373c80',
  'd28fd4f69381c7a79f589512eaadc7dc2448bedf',
  '833d2e1187675fddc27bd7290fc3a13a12bd987f',
  '7997c5f43c57f1e89e9837ab87fc542943a1b07b',
  '4b859fad1faf361921cc77cba2874c889d91c966',
  '70cbb57499791facad38f73f73b87b4846a12edb',
  '29a076e4cd4a4b4a6b52d27b9f8ae62d845a488f',
  'a66acb6bfb047464b3ae0903047c9704aa4419ae',
  'f13f93dc50a65daf3a1141ee996e3c6051adb2c4',
  '4582905abb6b7734e3f82c36f9c26f73c66812ac',
  'a2663b6dcde1a10b4e54d46266c371c9f85d1cfe',
  '4df578154687902917d8ad5437e818117eee1a62',
  '4bc8a1de83c1e0c815035c2be8bcca471a634610',
  '3a3998029824426caaf983caa6f6a528c4133795',
  'be02d8a5ac60b8f0ee5d42ed4437da8d0c44ac8a',
  '788a7998e036ec55c6d05b70f1cabe4bf394f17a',
  '25cf2362153ebf8e87971fa3ecfa4945a45ca67e',
  '4cc4f8d1df858da065897351739a244d2077c7be',
  'afd05fcafa23cc118deab2355a7db4d91b159572',
  '279767692d19ca9f594ff0199357d7e7e7f8cc70',
  '6476a265eab3247786386b35f8c5aa9cd6923582',
  'b067a20f32901e8ddf1724c41d69e8dc6001243c',
  'eac77061806b911fa0b3ba2bf802c40a7dc73f7d',
  '042aef4450eb3f0da4d583f77b649b2b181f0d32',
  'f1bab4741abb0dd657a0bdcd02e20ba777c0a712',
  '436d071a01ab25b9b6f201ed2cb02cc8e772903b',
  '06645e099d044f64508a72add3ca7b3b3ebd1f22',
  'aef6bb07e88f7ab953cd3df556d9e0935909e8ee',
  '0d7634f230068898368e7adc84dbe600486d4bcb',
  '5fc5840fa8f47df66924263dcdb56f8a92c5a94f',
  '3705a09a22c0133a1d36aadafbdfe8f719a98a4d',
  '3aab835c302605c4eea95c47eae2455b2ec85b5b',
  'dc003a4df1e75d05bc21ebdc83089bedc16b5b7c',
  'e60056544e364bc3d62e6a59c72bb2a1d757c56e',
  '16f2aee4d481224da4699e89c0c9f50569a42e5a',
  'e4cf85cd246ce073cb10479b0a0278028e318cc5',
  '67aa2f6bda5d24b5e287f5c167bc67093e85aba7',
  'b10fea56b6289fcf4577a78da91f54bd4ab464f1',
  '09e5d22932e60e809b3aa95f65725a31105a5112',
  '11d9abc421949ec402e075a0192f5846392161ef',
  '8a9f855bd20cb7ebeb277eaab493befe40f126ad',
  '88b93ef9606f6777434a18463d701e0b3dd517b4',
  'befef95cd213637018891761212017d6ccfd2edf',
  '903f09b0a34d2d892103e176bc68e0d46fdcf9c6',
  '9a50c88bb7cd8dff609bd08d1111569a037c4334',
  '5d6fdb28b07af648c52af9c34ecbaa82d9133945',
  'd61c24184cc58af6e9f8c782d1c03bc0a708ccd5',
  'd9d225d2823c19ac76bd5fd464d253aa41ea5c47',
  '050831c986cc1f30f2965f52268991c5d5bf105c',
  '5f15e62dc7d792f6b75398907ae9bc2e96522925',
  'bbb60997b0d5b26c5e54cca506194c68085ad8eb',
  '1703c85b241a10963ac31f65c2c02aaa36c64f2f',
  '5b73ce062e66da70e4254b8defe9ad6789cbcefb',
  '7ecfb6a576ac765b4a2d585f5ca9b63ca2613907',
  'ef651c6604673dd435514a98daec82f16b2a134d',
  'a53800a64dcd07f5b8e543b4b43ddafc15494c7c',
  'c4ea0ec91ad6d609906835b65aba4519474b3950',
  '1b11efe932a8bfa3c3a18a53d6cb01ba60807359',
  'b99c98f05aa577367e43ea2c5ccc4e50800561a6',
  '47e098ebc5509f1ffad6876b22b302ededb2e578',
  'b9058de33625af6173c85275c8d51e1861afaaff',
  '27cfd166e597fc23b9135b38cbd3bba7a2be2965',
  '39d5a8e9136e6bfc5a452b7bd7e76f06bb808fb3',
  '1f5ef9a1293ff1f59a0a47230217a35001c2ced9',
  '521f64256c6e95dfe8a936d41fdc05847de7b9a7',
  '762feed369354283932ff36fe7a8849a8531de85',
  '54c4bcc8441ffa12eb7b87c2d8e2fc572de44ee6',
  'ddae1ea426db9316a04546b1fcaf5724ee419397',
  'a71ea3a028652fd6b19b1bfc03867beb48a3bb67',
  '0eb14e990d8fdf9acb57d6e37e5c1c9aee9f82c6',
  '11860713d6f818e59e1604f3e00b6685cefde725',
  '1adac136f3db2d26eb3d5d2e99fda6578b93d8f5',
  '127e33b14a928a7a91ea867698f6d821231e6206',
  '68f47fb6649bb0eaf6993fb6303c0d420e23022e',
  '9edf1cad45c00bfd4853561e6fa774134048fb3f',
  '68c05dc68b9c1fbdee0cb93b220b4c68f81435d5',
  '3a624eeb973468ceeea90ab55da27632e93a691e',
  'b0889bc1d03aae0700f4665713abdf0801cb15e9',
  '4c736b7e63d63aabc52d88b936e8013e1c0ed2ab',
  'e4cdbe1deea57f7bbfb2eaf0a1f5c1cf4cae8e0c',
  '7132b63abc161992e6b5b065603b5e8c60dcc404',
  '230c79168f079ab3c7f233f4f9270dabd2684173',
  '94ccf04352d58f5663bd758eadd3e953061aa5c6',
  '8b83b58b7996b9cfa88b7482e3aba98d237cf035',
  '034989e67ddeb8e32dcf2995b02090a8645af52a',
  '33de1370a63131777bf32d4d6a0b85a9096d0818',
  '18ddbb5a3b75049a2ba3bbdd2f67b72031fb6391',
  'd99da55b9707e7194f786f2cc8fb958596730fb3',
  'ffd6684d3b5bf825a3f8ac2655afb7aa4e3e00b8',
  '8f44ae876d86e9866c4c6ddd0ead0aac54261e4e',
  '362b963b173a42ac24712f9606fee83acdb3f56c',
  '53d88745d74c194cf1df93a49b860a39fe44182d',
  '04a8459981b742f0a96eb0ef1324da08c344dbbb',
  'ac3c67708a32457f3f47b3edf8a656a0dd61fd7e',
  'ddd066077a3cbc2778bf574c5419bad732c89def',
  '13a64baea4cec5a6158007044bac13555171c2e5',
  '44f14bc1816e5d53ce87bbf74d32763e81619d49',
  'd83abc2903012088e22eee92d36a5d6be4b5db85',
  '7612a73a6795b434de3e2ed07c67ef3cd500c5e5',
  '163e965b7bf5e73fe679276bcbb4ea1bfff0b14f',
  '94ab5cf7a818d521ae0eedf3913c372815a94054',
  'd223b0753394c7eab48c5d1ac0ffb09d21131f1d',
  '42f17b685fce75a86fcb63f47f5f95e0659299a2',
  'ae3576bb947f8b010168e807a1498eded993a7f5',
  'ebdc3515a438bc1ae93e423dcde7d937244c53f3',
  '872952c020147434885b6422a18b6756fe8a8386',
  'af8575478fa85f396df931baa549cfe04ee3f487',
  '4f8b7ccc0cc4662f93a26771fae875b18fd4ce9a',
  '316b22686336e4895f91e895c13a7dbe6425d2e6',
  '8502fff053ff7102a4cbe64ab4235dfb90197a2c',
  'aeaca85aa25d47574f390840fd4d6a4e60098617',
  'bee65ddcfc7a5f5359bce8cbf64457c0590c59a8',
  'bf107975e3cdf141c5298a928e7e5b7be2f3aaee',
  '2bc45855aa27313390d15c421ebfc4c871603901',
  'a66ccbefc07c7972b9d28c4ffe2517017c28c038',
  '51f219b904d1161ed06a2c105c985a10e0c05fe9',
  '78965fceaa99590328304bc89986c6f32a650e0c',
  'ed4a0946e61c21137d4d903196036f69668cb6bf',
  '2a0a1cc17cf221014de89be678b8a69c67f6cf12',
  '0bc9ee56d7782d2244c7a53e1ff45326997f8f70',
  '1b93a358625a02759c460a1159925cad2e9a38b0',
  'cbc73ba64f0ef7ac0dc2586c616afd34843f5381',
  '022072a0c0a6d7dd9acacc8b7bbc4f5adae13246',
  '4c76d54d6549e6d5f37724579568474d26cbe9b1',
  '2d7b4402452bea11b1fc439c0672c490dec7714d',
  'fcfbabd5ad91d6ecdbd554e1b0a04125d0835662',
  '918d4ff73d0d78bf1f674d6eb0dcb33a8b4e7904',
  '762cf941a20c82e984a80c6e3ebff4e557ed698d',
  '83c85ed66713cb2610b289359b6e73733804ae75',
  '031655574558b52901e67d17c9e72ab74b3e9424',
  '0ec4f1a77c96d96a7e38fdcebb85e253df862aa1',
  '1f8049d128fa6c479c30d07c3d0b15960f45eed1',
  'aa74b846741d18ead00e3338355c7c1dc1266550',
  'b090b476d133db03326337ca303c2c03def03cdc',
  '66e2c31fb3d6bfff22bd216f9da37690e961f9df',
  'fc23d50c0ccb61c8b67678d51d88e34d6f5f0dbe',
  'a7a2e4b75625beeb6246f5cf75228ba96f7db51b',
  '585668194a43f214ba23bc4d20e1462e62e35085',
  '4c2e331734d3270245cec326326132b7ed14ad6d',
  '792284e8af5afff2356e902c492dd17d503e2d91',
  '4a43304308b98edc67668b950cf84c5b9b04c514',
  '124209f41fcf9f44d0761e7fcc8a9ccc3479560a',
  'e9e460ce218ee9da516f341b3cf13890384a1843',
  '2420a5b3cf6eeb432cfefe6ea377f0239b300883',
  '782005e25a684e1e304c41b43888353f636c9633',
  '59269843f692f42f8a6d3db27463ea5400ae1363',
  '60f461c9ef6a439493f09360e8517627d228bfcb',
  '41546445fc63a7bca3fd6e8d9761261c18bb289e',
  '9ffd81d74a40e41d02a84cd448189a09a0f44e56',
  '100b08c532f9fe379baa91f7f7907195bf0640ee',
  'c4e4b14bec3bc887c05fe8dc1319d58a504105c0',
  'fb53ede5d63b2ae64177e66833924aae198f5da5',
  'c6a9488a44af62abf70d76839dabcff62452085a',
  'f1b0e5e59f9ace78ac2af09264a77cf1072a4336',
  'ad600a8c443d714f0c08891932ad13229380ee41',
  'd09ac0e623595b9962628702d4343f0cdb4fb726',
  '21d2ee705a525bbbfe19ce20ebc308d7c6d4c0da',
  'f708efb8c8b3773783b25054358235beebf152c3',
  '0b00fb23db70b0d4c8f4ac605d61a013d626b231',
  '0f923b945daea96767e0f3287d394af8529f16df',
  '9d7ba317a6224e35588d13da9874c0871bce97a8',
  'f4d31192d82d1cc087885d6bf50153dc791eb50f',
  'f61ac9d627c905e79a35a4c1e3a5e313d06c9ae7',
  '449aa6e73b67dffd3caee2c920496e2dddcc91d6',
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
