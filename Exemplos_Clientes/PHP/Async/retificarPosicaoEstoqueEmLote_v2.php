<?php

//////////////////////////////////////////////////////////////////////
// O Arquivo 'functions' possui fun��es comuns � todos os arquivos, //
// assim como vari�veis de conex�o e identifica��o                  //
//////////////////////////////////////////////////////////////////////
include_once '../Common/functions.php';

/*
 * Exemplo de XML
 * 
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:hor="http://www.saude.gov.br/horus-ws/schemas/v1/HorusTypes">
   <soapenv:Header/>
   <soapenv:Body>
      <hor:retificarPosicaoEstoqueEmLote>
         <identificacao>
            <idOrigem>E</idOrigem>
            <coIBGE>23</coIBGE>
            <nuProtocoloEntrada>17110000023000003228</nuProtocoloEntrada>
         </identificacao>
         <!--1 or more repetitions:-->
         <registro>
            <estabelecimento>
               <coCNES>5717493</coCNES>
               <coTipoEstabelecimento>A</coTipoEstabelecimento>
            </estabelecimento>
            <produto>
               <coRegistroOrigem>123</coRegistroOrigem>
               <nuProduto>EBR0266630U0118</nuProduto>
               <nuLote>1234</nuLote>
               <dtValidade>11-10-2020</dtValidade>
               <qtProduto>132</qtProduto>
               <dtRegistro>30-11-2017</dtRegistro>
               <sgProgramaSaude>DST</sgProgramaSaude>
               <coRegistro>90580</coRegistro>
            </produto>
         </registro>
      </hor:retificarPosicaoEstoqueEmLote>
   </soapenv:Body>
</soapenv:Envelope>
 */

$nuProtocoloEntrada = '17110000023000003228';               //obrigat�rio


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// array associativo de registros                                                                                                                                //
// dentro da vari�vel $registros, podem ser inseridos quantos arrays forem necess�rios, cada conjunto de arrays dentro desta vari�vel, e considerado um registro //
// cada registro � composto por:                                                                                                                                 //
// Um array de estabelecimento e um array de produto:                                                                                                            //
//                                                                                                                                                               //
// Array de Estabelecimento:                                                                                                                                     //
// coCNES, coTipoEstabelecimento                                                                                                                                 //
//                                                                                                                                                               //
// Array de Produto:                                                                                                                                             //
// coRegistroOrigem,nuProduto,nuLote,dtValidade,qtProduto,dtRegistro,sgProgramaSaude,coIUM,coRegistro                                                            //
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$registros = [
  [ //exemplo registro 1
     'estabelecimento'          => [                        //obrigat�rio
       'coCNES'                 => '5717493'                //opcional
      ,'coTipoEstabelecimento'  => 'A'                      //opcional
    ]
    ,'produto'                  => [                        //obrigat�rio
       'coRegistroOrigem'       => '123'                    //opcional
      ,'nuProduto'              => 'EBR0266630U0118'        //obrigat�rio
      ,'nuLote'                 => '123'                    //obrigat�rio
      ,'dtValidade'             => '01-01-2020'             //obrigat�rio
      ,'qtProduto'              => '123'                    //obrigat�rio
      ,'dtRegistro'             => '30-10-2017'             //obrigat�rio
      ,'sgProgramaSaude'        => 'DST'                    //opcional
      ,'coIUM'                  => '123'                    //opcional
      ,'coRegistro'             => '90580'                  //obrigat�rio
    ]
  ],
  [ // exemplo registro 2
     'estabelecimento'          => [                        //obrigat�rio
       'coCNES'                 => ''                       //opcional
      ,'coTipoEstabelecimento'  => ''                       //opcional
    ]
    ,'produto'                  => [                        //obrigat�rio
       'coRegistroOrigem'       => ''                       //opcional
      ,'nuProduto'              => 'EBR0266630U0118'        //obrigat�rio
      ,'nuLote'                 => '123'                    //obrigat�rio
      ,'dtValidade'             => '01-01-2020'             //obrigat�rio
      ,'qtProduto'              => '123'                    //obrigat�rio
      ,'dtRegistro'             => '30-10-2017'             //obrigat�rio
      ,'sgProgramaSaude'        => ''                       //opcional
      ,'coIUM'                  => ''                       //opcional
      ,'coRegistro'             => '90580'                  //obrigat�rio
    ]
  ],
  [ // exemplo registro 3
     'estabelecimento'          => [                        //obrigat�rio
    ]
    ,'produto'                  => [                        //obrigat�rio
       'nuProduto'              => 'EBR0266630U0118'        //obrigat�rio
      ,'nuLote'                 => '123'                    //obrigat�rio
      ,'dtValidade'             => '01-01-2020'             //obrigat�rio
      ,'qtProduto'              => '123'                    //obrigat�rio
      ,'dtRegistro'             => '30-10-2017'             //obrigat�rio
      ,'coRegistro'             => '90580'                  //obrigat�rio
    ]
  ]
];

try{

  // link do webservice com as credenciais para acesso
  $client = new SoapClient(AMBIENTE,['login'=>EMAIL,'password'=>SENHA]);

  // remove campos opcionais
  removeOptional($registros);

  // Array de argumentos da requisi��o, ou "Body" do XML
  $arguments = [
    'hor:retificarPosicaoEstoqueEmLote' => [
      'identificacao' => ['idOrigem' => IDORIGEM,'coIBGE' => COIBGE,'nuProtocoloEntrada' => $nuProtocoloEntrada]
      ,'registro' => $registros
    ]
  ];

  //envio da requisi��o
  $protocolo = $client->__soapCall("retificarPosicaoEstoqueEmLote", $arguments);

  // resposta da requisi��o
  ver($protocolo);

} catch (SoapFault $e){
  //O erro do Web Service ou mensagem de falha para ser tratado.
  ver($e);
}

?>