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
      <hor:retificarAvaliacaoDeferidaEmLote>
         <identificacao>
            <idOrigem>E</idOrigem>
            <coIBGE>23</coIBGE>
            <nuProtocoloEntrada>17100000023000003132</nuProtocoloEntrada>
         </identificacao>
         <avaliacoes>
            <avaliacao>
               <coRegistroOrigem>123</coRegistroOrigem>
               <qtLMEavaliadaC1>31</qtLMEavaliadaC1>
               <qtLMEavaliadaC2>31</qtLMEavaliadaC2>
               <qtLMEavaliadaC3>31</qtLMEavaliadaC3>
               <coProcedimento>0604010010</coProcedimento>
               <dtAvaliacao>15-10-2017</dtAvaliacao>
               <avAdequacao>N</avAdequacao>
               <coCNES>5717493</coCNES>
               <coCNS>700600555663867</coCNS>
               <coRegistro>5083</coRegistro>
            </avaliacao>
         </avaliacoes>
      </hor:retificarAvaliacaoDeferidaEmLote>
   </soapenv:Body>
</soapenv:Envelope>
 */


$nuProtocoloEntrada = '17100000023000003132';      //obrigat�rio


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Array associativo de avalia��es                                                                                                                                  //
// dentro da vari�vel $avaliacoes, podem ser inseridos quantos arrays forem necess�rios, cada conjunto de arrays dentro desta vari�vel, e considerado uma avalia��o //
// cada avalia��o � composta por:                                                                                                                                   //
// coRegistroOrigem,qtLMEavaliadaC1,qtLMEavaliadaC2,qtLMEavaliadaC3,coProcedimento,dtAvaliacao,avAdequacao,coCNES,coCNS,coRegistro                                  //
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$avaliacoes = [
  [ //exemplo registro 1
     'coRegistroOrigem'  => '123'                  //opcional
    ,'qtLMEavaliadaC1'   => '31'                   //obrigat�rio
    ,'qtLMEavaliadaC2'   => '31'                   //opcional
    ,'qtLMEavaliadaC3'   => '31'                   //opcional
    ,'coProcedimento'    => '0604010010'           //obrigat�rio
    ,'dtAvaliacao'       => '15-10-2017'           //obrigat�rio
    ,'avAdequacao'       => 'N'                    //obrigat�rio
    ,'coCNES'            => '5717493'              //obrigat�rio
    ,'coCNS'             => '700600555663867'      //obrigat�rio
    ,'coRegistro'        => '5083'                 //obrigat�rio
  ]
 ,[ //exemplo registro 2
     'coRegistroOrigem'  => ''                     //opcional
    ,'qtLMEavaliadaC1'   => '31'                   //obrigat�rio
    ,'qtLMEavaliadaC2'   => ''                     //opcional
    ,'qtLMEavaliadaC3'   => ''                     //opcional
    ,'coProcedimento'    => '0604010010'           //obrigat�rio
    ,'dtAvaliacao'       => '15-10-2017'           //obrigat�rio
    ,'avAdequacao'       => 'N'                    //obrigat�rio
    ,'coCNES'            => '5717493'              //obrigat�rio
    ,'coCNS'             => '700600555663867'      //obrigat�rio
    ,'coRegistro'        => '5083'                 //obrigat�rio
  ]
 ,[ //exemplo registro 3
     'qtLMEavaliadaC1'   => '31'                   //obrigat�rio
    ,'coProcedimento'    => '0604010010'           //obrigat�rio
    ,'dtAvaliacao'       => '15-10-2017'           //obrigat�rio
    ,'avAdequacao'       => 'N'                    //obrigat�rio
    ,'coCNES'            => '5717493'              //obrigat�rio
    ,'coCNS'             => '700600555663867'      //obrigat�rio
    ,'coRegistro'        => '5083'                 //obrigat�rio
  ]
];

try{

  // link do webservice com as credenciais para acesso
  $client = new SoapClient(AMBIENTE,['login'=>EMAIL,'password'=>SENHA]);

  // remove campos opcionais
  removeOptional($registros);

  // Array de argumentos da requisi��o, ou "Body" do XML
  $arguments = [
    'hor:retificarAvaliacaoDeferidaEmLote' => [
      'identificacao' => ['idOrigem' => IDORIGEM,'coIBGE' => COIBGE,'nuProtocoloEntrada' => $nuProtocoloEntrada]
      ,'avaliacoes' => $avaliacoes
    ]
  ];

  //envio da requisi��o
  $protocolo = $client->__soapCall("retificarAvaliacaoDeferidaEmLote", $arguments);

  // resposta da requisi��o
  ver($protocolo);

} catch (SoapFault $e){
  //O erro do Web Service ou mensagem de falha para ser tratado.
  ver($e);
}

?>