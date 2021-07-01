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
'45ca9f20f74de481ce531f8989f6c606d598f996',
'4653b396b16e1b10c6a6ae9811dc8364a326ac80',
'471a90c66ae3bd93537be4fb15cb696d3c4b28ca',
'475a858d5fc32a79da56c29401d15c94372b58d3',
'47f5512bd44e86c991362101b08f483d63e9a2a7',
'4868db738a57a29233cb599a1a196187a93b4778',
'49c6223e43be7bf8bab3ab8f8ca8774b086487f4',
'4a63ec03f722b8b95d19e86f164f3072f1e2f845',
'4b243300d4fc66e28ecf788b61da785f96afb69e',
'4bd37efec484fd80ef78658629a846419e90a758',
'4c4a3c035f07e6414bf7a048eb8c1dcd44fbe8d8',
'4c8a2d563deeeddf61f038e5af8f379845b22b58',
'4cd2d37f4abc67f5bdb74fd549c7d0a6711cd0f8',
'4d2544faa278e610c89bd3720007ee16ad03243f',
'4de8c1eb1b069de7a87c5f613300924d6d7f0afb',
'4e6789f3a53dd6211ae9dacfeb63a3fc4642dcbc',
'4f4f443028f36b04e6b71b1ad1fb23f8db2e230b',
'4f501ec4f4434aa56bc3907a6545cb5d5074f30b',
'503454d5d69abb05bb69d0af5b8c9cc641c1ee82',
'513c873f30f9da5026bbfa8712456ee84260bed9',
'51d20316980413c86586f3fdcdac41c257d80056',
'538edbd51b788b333cb665725843e749b00a0166',
'53c96815efeedff163671fb285bb18bdce0f2409',
'541c5353829c67d336beaa31c13d7a52ed7b96c4',
'54a66131f28f9c02881897dab29a7ba98d589a71',
'54c03e5bd88165660dad0e694e8ee01387027231',
'5506645d696ef1a0b30ec8b579d2bbcd8ccd0e2d',
'56190c7b354ed78005de8a2cac34a5a046f8b3cc',
'56a938d5426e8a61a28f71fcc1fc3d949a8d75ed',
'56d1662d023c535cd84647e5b0883277f69d2d5d',
'5719fae65c95e67cda89cdc5fa087a437703ee29',
'575a77f93825a43163ae1b41c0a4508783a48c90',
'59eb7f010b331aa860c35f5a62031e4c4d00b2b7',
'5a494c09e29f2f52cdd47f26f94b6499f6829036',
'5ac19dd5a421e6d183afe7d8135e3bbd3ca8a1ff',
'5ce5f51677e2ba9795faed35d3f59d7bd2ddf148',
'5d558bfc0eb8cd1b92f0776938c82318c3c6cf46',
'5d5ba51d6d011efe878ed38be9616a98844423d3',
'5d6adbf98e0cdf334a4e351868ceb3d13e083bd6',
'5e0621d68b87e714804538f16c3779251d95cb54',
'5ecc47523bd9945f966bcc4cf64e40b6846a0abf',
'5fa7bca1b63fdeeb7aeee362c603e21a37791317',
'60a2b91b448c11cddbbcf196dc1f735b31271f3e',
'6155777773f3ca488bd345d8ae8204223d5c38eb',
'61b7329a0f89bb8544b045e5d60b39305cec7841',
'61fdf984f8317d934a43d1226a84a6d628c0307f',
'620391a06c8314823a0ebf787ba2d6e671fc6058',
'62090a770d1885f44d271713c21b55798d2f7f6d',
'641b94b0882b52ce8c372ebb678028e258a3af30',
'64385cedde0443c506ca60beba5037b7424be73a',
'64c20f7d1404593a65ed05d024559db80d776e2b',
'64ca54ab3daffb42be521229399940563aa86a9b',
'654d711a84b7fe5c6c6b9d677711a1198a80549f',
'67763456c81071e0cd5863b745751933183eb3b3',
'68332fa1804bc375b636e17b28773fda99a70d64',
'69d4bb739387da1656848e48400c770ad9793c44',
'6a33dc00f6f6d87a83f5fe4eb806c223a85c4f5b',
'6b15f35a8eeee0e84efe75380ae18a6ab78bfea9',
'6b8f1ce26d31f2b2be32585819bd020ae031c069',
'6bebc6b866d5cf3a448824f23dc2f2c52b3e74ac',
'6c18053e9ef47feed72375c50281a02ed624fb5f',
'6c4be89acff69238dcae52fd7209f6148d1ab994',
'6d2a0e61711c1279dfb39e6a173c9b6be2d4c72f',
'6da80668744bb25be556e1c8d4871b7852fa931d',
'6ddc643ebd2123c2df1acfbeb0539415eb3af683',
'6e5e50fcde19419bbb838af173b8a2a9c57aa010',
'6ec3a0259438b16a317b0d97c02bc0856c498b86',
'6ff98c063435d9fe68bf47671efe25d27b578dc7',
'70409a82962ef899ec5bf8768cfa0d0905504112',
'71fcc2bdec380f6f6dcefc184a92dc629476a61f',
'71ff2496c4f97aef0d548f309f2c54e3ce84adcd',
'7246e3b3361a22963f519188a80ec6b698a474fc',
'72a04b9f4957abb346781720def1046016e0a62e',
'7397c8b7ae6c5a970f7fc7a6868b98dde28f5977',
'74201174077f711e9e871132e73eca495c0839f8',
'745df1b9ecfab66e6f3c403a184c306df8256167',
'748eadafdac505f1bd14f06cfd1f39a15bd59d49',
'74f799659139564a71cccaab7a4497ce8915b442',
'7619b916bfeb1d837c081b0aa5b94ed3c0f2b841',
'7714e2a206cc22b19d8b8e3276862becb283861d',
'77703959120fa603ed671ac8ce0f4a0f02409296',
'7801db083c7f1a1893f2e1c2b0a53d1d620dfd2e',
'7832eb03ee3ca66c84f7cdf22fd33dfa00488dd9',
'784cfa86aed4014286e789686640182d82915620',
'788064c2d194f6f5654ea45d120507102d1a325b',
'791edf0d335e17fef317932ca700443773e11373',
'797b76fc7a6f3e7aa0b4a20e7a81b7e0cd38e251',
'7a06903f81217ef47fcb5b6597a6e65eb1c7f610',
'7a53a0a2439392bcc9398bebdd4e4078a3b8765c',
'7a8ff3801e36c70fcc9acddd66e7d2b8273afba9',
'7baf6338d9d7b29ccc82708789781578e9ec2923',
'7ce842c071f2ffe2ff7ca0a745af8a50b018cd37',
'7d35210a9599b3ede64d8ad4fec8c4a1cf09c686',
'7d95f0329ac5ccd3024011a08a1c018d89636811',
'7e0a83ab8b4dbd2e7ca660b04b855d3eeaaa8f71',
'7ebc3bd123ab01c1b52fd5f374e622c9c379db57',
'7fbd573f704a166eab0419a5f0de403ccc0469c7',
'802d1bdf0da1c3a4458a7c43984e8facb668d0f0',
'8032480468e0b71d5f4ee42ed1b75ea2656ea3db',
'803b6bee5526674c58f0f0749e7d644345049cba',
'8139b074e61dc3467827c1d5a6414ba29ef19cf2',
'8143e1aab1169110097f4eb1df6e9adebdfa131b',
'82371ede5c9a49e53543366c8b96b90e4330e1b9',
'82a76edad88847a9af2b61657f1f67d3f8cd5aae',
'82fbfae76d1b11b2f0c2432af39e19596ca89707',
'84ee5fd5028c4ed225f10a132bfbc11c1c213b94',
'85d8599dddc8886b3ae9139f5bb07ce47fee09c1',
'8604dd896d6cd2ba1914d757ccc36192fdda6515',
'873df5e7a20c008db7c4bef61f37f6395e689fb4',
'8768ca8e3f3adbc096a1fa6d42168da76ddab53e',
'8796cbaff3f64e5fce8836aba892c05e25d748b3',
'879a9ac6dd4db91cff637daa2d392a50612fde7c',
'88d3e487fcf4a59ecabb5a719db44ac312fa28eb',
'8900a024ca605cf585eeef7f7c7c2fdb744a8541',
'8945d3e1bac1d77cb74de15f1f8d44fde8cdf12f',
'89840060a813f8954a4df9d6cea9f7bad594f0f4',
'89b01444e4ea1e582da5b45e23b0f685c6689693',
'8aa7639a087a97f0f5a2dd080ad5320b6d9d18ec',
'8bce4aea2b1865804d0fbc9dc589f81a12a993d3',
'8bd0935da2b930c63c7515da7f243639e9ebd464',
'8d6ce5cd1c8049910433f9e0536416be7cadf400',
'8d74bf7b41ef01ab1604ce2ac2c9a67e245b6d36',
'8e664cccc558c976fefed4467cb9c66436fbf81c',
'8e97cbc60768d9840c13134b7a5a5ff67b8f8777',
'8f09f779324b4a1bb354f23433d9594817eb6719',
'8f6c39ce254acbc398011b4e39619e21e8c68abf',
'8fc68742164dad146c375ccaf6875d679481e170',
'9078d7354db416ed84f1b4e0fbd87abc0d5c4b35',
'91bd532366a564364115d5ae1a6d2b1d84ee9231',
'91f6282f1005ecf79854a8c1c4d34bdb7cf5aac0',
'92a67ec43bccf7839d8f2e4fb14d16113cef86ba',
'93e88c1d8c1bb45b9ab578fdd1f890f5363ce60b',
'9417627d6dee3c7ab11f51f96272c0089b0f86fe',
'944fc723bb8cb46ee1c1d62779613b88a009003c',
'9580219a0e9016e0f4a571f287d61bb0e915fa2b',
'9684cfd68d3717f54311f909c84aa693ac502371',
'96dbd92d5dd4879ce3984eaa449090552196c301',
'97777e62ed4ae78951264c28b2b127c3845a7280',
'99827b5fd34a8635203d8e81b16d64dacc02a62b',
'9b84475b6e323b69e5b0696e8589ae1d53f1229f',
'9c08ec821717311305489130eccf76ed8f8f4256',
'9c62cb04836bf3d6eb9b5870df91a36f39723cb2',
'9d2be4cab9ff8e81d67d594e779b0a270210baf2',
'9dbffbf301ce54d689497aace74ea07e22f06bed',
'9f915f768cc3fdf45f2d8d03104a8abac9569f20',
'9fbcbe187ac5e02f4f3c9c3c77a2ad3fb7cfaf18',
'a036ec98ab61d0f688c42abf980f74dee7721368',
'a0c00ccfc4fb3be0fa058320efbf6219f80da580',
'a2b20f8537720ff33df92ca1f96e94962d58f974',
'a2cd15ae0198681aeeb6f632a1b23f2b1e05c871',
'a323736ea48345ec5c94e7f418d3913b68e2ee5c',
'a54d9f1e084035c18c4c0bc97593ad98307d0566',
'a62eb3e0d72bb8342251f14ac44e79130feb2691',
'a70600a168e72e2b6aefa4ec1aed45958db1b8d7',
'a7d500ea4172b4b2d768136965a9ed53ca186771',
'a7ec4092467c87a85eb48e00965677f9eaa83398',
'a8fa1f9b7ba24f942bae6065dd8364cc36cc19ad',
'a9737d3dd27009a452f482706393e4b69469bb57',
'a9adcc94916bcf642bc3f4ca1ad2106b63d6f90b',
'aa9041b5e44141e59c08a2faf85697ad817d82d3',
'ab0a36c36f400046aa9bb932d0c44a35fcbe5524',
'ab7bac8b60d541e531aa68dac27100fd0c5c6385',
'abf289f517d3b1f599b9746c7dba7e3b18a9a661',
'ac3c64114e9adcd30d6a43aa370c5a1a7a22aacd',
'acba292b2e58fb1c1977e925b525406d1dad9732',
'ad77a9868496df34c1e8dfd9a60e893013a954e8',
'ade88123e0779568cec66a4ff46e65687950be18',
'af0276b6b5f122592b4753c5965be4273dc9e905',
'b02823c9711b4d45aa86d8a84910f816c044c08e',
'b1584847f86079194a700d938908c8f0232ae5df',
'b1655a5596c5e478e8fb2c70540694cced37d0f1',
'b2319b956d2a1a63e335c25d75fea024817d112d',
'b245057366161b2aec9086a4e9441b7d322e40a8',
'b306433e48b2bbc916314f6d572be669dd330519',
'b4703a33227851f471c585660e4c5c77f78518e5',
'b4cf5f688ae48116c855270dbf9f2aa46157f7ba',
'b4f947635f1c06af9da429cc112bc8fd2220a0f9',
'b554ecbf0fb4bacc91857e0d5408115af06e209f',
'b5cd27a985b72ae2e2e7fe1061015424e4668477',
'b703879336f2518c66daad3a44ae861e3b148cb6',
'b770ae2a70fa0b673761e7084188425986886345',
'b789852ee58cdb961602b45423f9c15e386344cc',
'b7cde99a9d1c701582854cdc13cf8fd28b44f6cc',
'b99b72ee91b6c52a30d0373aee8bf1c8b82d9de0',
'b9cd0c07420eb862ff2768b976da46cdc669ef60',
'ba0028b25059791b066ab127666e408978cec13d',
'ba510c9585d5ca90f73066f17c79ac73e3eb473e',
'bc62dc9ad802fe4915e08b2127fb06697fd3f644',
'be2571bf9ef208365a5a2b439825905c7d84d1a7',
'be274f4bf34410c72a7abd746b22fc291a1f95ed',
'be540b37bf75086f0db685116ec2961882916a8c',
'be7fccb4754bc2e45acfd33e210310c54eada8c4',
'bec51187561022c9bf23beb4e79e8fae974f509c',
'bf0b2e2e37ebf344c93187c52e4fc54fb9538ea7',
'bfa07f9a94a88b80f06d213e17604a789b7b6acf',
'c064595af2c71f525429ca5f98fa0951104f0aff',
'c1807f2953071295a1e236a3ca859dc6588c7756',
'c20b7ea8e1c052553212fc7fe5a42e320d2e29f9',
'c2110ffd94e072200b584abdbbc74d8fa0e27824',
'c249743409b107df7a608700ff4dd3dd55202df2',
'c2e35e591e817a357b7baae720217c54972e4e72',
'c374d958fdb0a49c353e4261426c843573a7f930',
'c40b143f4cb5ee6d2a2613cf6bba6ac8b004ff5d',
'c4578114a84903c7e1be7dae6d8dd1bab9e6bb19',
'c59e322a5d51214cae714225f81fa959cb13d586',
'c61b574b6de8e8aa8aeb6a084111a18bd351ebdd',
'c6827e36a5ae88dfbde7638130741814c55e52e4',
'c7020ca90d1590e2796b02ffabe573f09ebb865c',
'c780e95b6b44c487ebda46ee2fcab42e2db5f4ab',
'c7d8152f9419a60c3bdb005b1b91243607352586',
'c7ddcc496dc0f2679438a2566555e7c03eb0fa30',
'c814e0f734590f489ca4aeabc687bfa0492bf8c8',
'c8c1b6ebaf6f8f1128a8ee359bc405d5ada6c32f',
'c91ac5447d9f28bc33af2592675850079a416b90',
'c94ed79736ddc37aba5b5aa6902c7ae35b6e8c13',
'c96d11a746f0a0f51cfe1105078f2c43567d8bb9',
'ca338d591b5846dea30bf05f841119368da41153',
'cad76de4c9649b2fa43fbf188e9bda87d8f01d22',
'cb830bbcb505d36fc34e537adea5bf202db86b00',
'cbe77b195c89a59f7bd3589161f28af7c233775a',
'cc27d960fa35bcaca78096efbebb9897d4b73958',
'cc4a2f014887e4633bbb2922701ca879ba3a8f3e',
'cd1721282985e707a19d3b977e06c96011e560a5',
'cdbf3e0d6be71cc3a99d089bfab3291286ad8661',
'ce1da9ecf4ce8c62499cc2d38533a708f0894552',
'ce5620554387f626c7b2fa5451e45a5f62c95d6b',
'ce8c7fee728bc30ebd69ce399ca0315ffb19d3f7',
'cf0b5fc2f2e3e81cd4da037b45ddee638a2f81dc',
'cf78885601e2fa0cb4a83630b8efc5dc173f24ca',
'cfd86c4f94d8944b2a76ea7d36c3754955eef2df',
'd0673045e0c0fa0bf67d596a1d897ce74ba0950e',
'd1778510e83561e2eff49a87d3bd3911786a9f3b',
'd2b925e2b2e1777444aa8cc6b7c4565c21120274',
'd2c7d02da683bd5d9e58be4d48bb2168d7302c4e',
'd3712b70c69b56c5e15756b8c05268eac24c97d3',
'd3f92deddbbf817d72e6e5000fa1b293f232a592',
'd415743a192e6fd1abb329fa356893b7fb3fe42b',
'd46707ee3abbeecb0499bbb1ed48f610d59267e2',
'd5024e9a04d76c33b96092cfb83f9218e5759469',
'd7355566d02e365a86a3224f82fee1f3a6b01d3f',
'd7de64a1540a937a9f2a65f44f1cf3522186a7dd',
'd7fe8ad73985215b1f19e2ecbdb3473457106025',
'd87060efd9f3a4c5537fc5e7e945350c549a2d28',
'd96ecf0e098b9abe0567c38bedb3c592c2659727',
'd9a24697e904b71125e958ff54ee29d819665652',
'd9ab157f2bf4b0ebe44e02d75f95e0c9e4c361bb',
'da5c8f8c99481b8f2731abd196970366beb1acae',
'db1b7293b208ec0312a4ba3a8f01691343cb0d73',
'dbadf5093a0cfc251e498d4af91c9fe7da081b2c',
'dd9e2b81b15aece3ca4c2593c51eecc3c7cb0836',
'ddedd09da772c4ce84351dc8fbc0fb5059c89f3e',
'de42e928284214837723d41ae7072a784ed31164',
'df37fe1cb0224243995351b36fcadc929d15533a',
'dfd881f149ac5ee574ddb56ffec54d0ac6733101',
'e059710d0fa0e881da12122be4dc9b971ae18d6e',
'e2967e53bcdf054750c4e998c0adc3f7ab14d8c7',
'e379e7fae70f47efd4ce7beabf13ab7c6b16f6af',
'e3899395d5013b2d74949f5a5f71641394be19ea',
'e3da850f93705f13a9afe0f8cf9b03ed78e6e010',
'e48b57a95bd6f0fc291aa7749e5daeee8088cc90',
'e5077321205c320ef4dd7a79c4fdd10ec721845e',
'e567738f7db012ceb7d65ec1f2f89fd66a23e449',
'e7568c4cf5744497fe7c84471f1332bc5f1e812c',
'e8a683e3d4d367021e4e109e32344070ac6d733c',
'e8fcb6d91d1ac369407a0f6a33785f755c0653e6',
'eaebccbf750a8bf20f8166656bb5abcbfa497e27',
'eb76a9773ab284834c127e1e0cb6ee9cc29cf497',
'ebf0532f0b1bef93eb5043f7c6430b18a14f6540',
'ecd501d6fe5556168637c80724a721b99eb3525d',
'ed8b902cb05a0ab0650f1c49207b9131e20ba140',
'ee0570c21378cf90d98fb4bb6b867163b99818cb',
'ef253f356694be1b0f43c256ad0db1383e116c3b',
'ef41235a583650c5e0f3408f8103e8a7605e7f71',
'f1fcd65d008d74dc751a28743327779eaf7ade30',
'f22caaa48dec9b2f5b03d4c61f920be5466b721f',
'f2855124bfdc2081f15ae1e3a7da9fa3e7aed966',
'f3580b66bc3acc35bc9ac5c728da0c2fa667c00c',
'f3ae02204294afc9ee14a2571c40dc7e979a2eff',
'f42a0b9103b41d262cc1b6f2b962d3965dc2435a',
'f468e54aeb8e82231aaebb2cad91d63045216fba',
'f4f4cdb830abe2926e99864059c22ac04db9c487',
'f5d44d67378dc078e363d045d3bffa14119a5dd1',
'f605b03e406d1dac22dc162886db44c54714ce51',
'f6bb22737dfdcb33939695e4d5d96718b16b67ff',
'f708fb9e68e400ee264ec5c9014bef6731269434',
'f71d5d93b8ce3eaa139f65ca6c88561617172d20',
'f91d689112f7fb4ae6e50ab5e7158129e0fe2a37',
'fad510e6b80917e43ed4f8562ec3f6c857e1c259',
'fbe478bbd3adfb0cb0c86a6c6b12f83be74708fb',
'fd3e1921c2c78c0752b54942a13a75d8a405b88d',
'fd452753411c22f6ac74604821d946feaae89ba9',
'fe939be6c88de84e98cffacb6b99fa7778cbd279',
'fea47bb18b24e1d2b896f35ea4fc8cb91f5ed0b7',
'ff49fabd8f800253148be2d7728827c363051880',
'ff5dc75e333cfe83fea3581a4266c25396d15be7',
'ffc85d83cfdcb648d3c2b5c993e9419d2296e422',
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
