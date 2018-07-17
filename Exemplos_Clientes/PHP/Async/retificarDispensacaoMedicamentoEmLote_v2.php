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
      <hor:retificarDispensacaoMedicamentoEmLote>
         <identificacao>
            <idOrigem>E</idOrigem>
            <coIBGE>23</coIBGE>
            <nuProtocoloEntrada>17110000023000003262</nuProtocoloEntrada>
         </identificacao>
         <!--1 or more repetitions:-->
         <registro>
            <estabelecimento>
               <idIdentificacao>CNES</idIdentificacao>
               <coCNES>5717493</coCNES>
            </estabelecimento>
            <produto>
               <coRegistroOrigem>132</coRegistroOrigem>
               <nuProduto>EBR0266630U0118</nuProduto>
               <nuLote>123</nuLote>
               <dtValidade>10-10-2020</dtValidade>
               <qtProduto>123</qtProduto>
               <dtRegistro>08-11-2017</dtRegistro>
               <sgProgramaSaude>DST</sgProgramaSaude>
               <dtCompetencia>11-2017</dtCompetencia>
               <coRegistro>854785</coRegistro>
            </produto>
            <paciente>
               <nuCNS>700600555663867</nuCNS>
               <peso>70.10</peso>
               <altura>175</altura>
               <cid-10>F20.0</cid-10>
            </paciente>
            <prescritor>
               <coCNES>5717493</coCNES>
               <nuCRM>1234</nuCRM>
               <ufCRM>DF</ufCRM>
            </prescritor>
         </registro>
      </hor:retificarDispensacaoMedicamentoEmLote>
   </soapenv:Body>
</soapenv:Envelope>
 */

$nuProtocoloEntrada = '17110000023000003262';           //obrigat�rio


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// array associativo de registros                                                                                                                                                                //
// dentro da vari�vel $registros, podem ser inseridos quantos arrays forem necess�rios, cada conjunto de arrays dentro desta vari�vel, e considerado um registro                                 //
// cada registro � composto por:                                                                                                                                                                 //
// Um array de estabelecimento, um array de produto, um array de paciente e um array de prescritor:                                                                                              //
//                                                                                                                                                                                               //
// Array de Estabelecimento:                                                                                                                                                                     //
// idIdentificacao, coCNES, nuCNPJ                                                                                                                                                               //         
//                                                                                                                                                                                               //
// Array de Produto:                                                                                                                                                                             //
// coRegistroOrigem,nuProduto,nuLote,dtValidade,qtProduto,dtRegistro,sgProgramaSaude,coIUM,dtCompetencia,coRegistro                                                                              //
//                                                                                                                                                                                               //
// Array de Paciente:                                                                                                                                                                            //
// nuCNS,peso,altura,cid-10                                                                                                                                                                      //
//                                                                                                                                                                                               //
// Array de Prescritor:                                                                                                                                                                          //
// coCNES,nuCRM,ufCRM                                                                                                                                                                            //
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$registros = [
  [ //exemplo registro 1
     'estabelecimento'        => [                      //obrigat�rio
       'idIdentificacao'      => 'CNES'                 //obrigat�rio
      ,'coCNES'               => '5717493'              //opcional
      ,'nuCNPJ'               => ''                     //opcional
    ]
    ,'produto'                => [                      //obrigat�rio
       'coRegistroOrigem'     => '123'                  //opcional
      ,'nuProduto'            => 'EBR0266630U0118'      //obrigat�rio
      ,'nuLote'               => '123'                  //obrigat�rio
      ,'dtValidade'           => '01-01-2020'           //obrigat�rio
      ,'qtProduto'            => '123'                  //obrigat�rio
      ,'dtRegistro'           => '30-10-2017'           //obrigat�rio
      ,'sgProgramaSaude'      => 'DST'                  //opcional
      ,'coIUM'                => '123'                  //opcional
      ,'dtCompetencia'        => '10-2017'              //opcional
      ,'coRegistro'           => '854785'               //obrigat�rio
    ]
    ,'paciente'               => [                      //obrigat�rio
       'nuCNS'                => '700600555663867'      //obrigat�rio
      ,'peso'                 => '70.10'                //opcional
      ,'altura'               => '175'                  //opcional
      ,'cid-10'               => 'F20.0'                //opcional
    ]
    ,'prescritor'             => [                      //obrigat�rio
       'coCNES'               => '5717493'              //opcional
      ,'nuCRM'                => '1234'                 //opcional
      ,'ufCRM'                => 'DF'                   //opcional
    ]
  ],
  [ //exemplo registro 2
     'estabelecimento'        => [                      //obrigat�rio
       'idIdentificacao'      => 'CNES'                 //obrigat�rio
      ,'coCNES'               => ''                     //opcional
      ,'nuCNPJ'               => ''                     //opcional
    ]
    ,'produto'                => [                      //obrigat�rio
       'coRegistroOrigem'     => ''                     //opcional
      ,'nuProduto'            => 'EBR0266630U0118'      //obrigat�rio
      ,'nuLote'               => '123'                  //obrigat�rio
      ,'dtValidade'           => '01-01-2020'           //obrigat�rio
      ,'qtProduto'            => '123'                  //obrigat�rio
      ,'dtRegistro'           => '30-10-2017'           //obrigat�rio
      ,'sgProgramaSaude'      => ''                     //opcional
      ,'coIUM'                => ''                     //opcional
      ,'dtCompetencia'        => ''                     //opcional
      ,'coRegistro'           => '854785'               //obrigat�rio
    ]
    ,'paciente'               => [                      //obrigat�rio
       'nuCNS'                => '700600555663867'      //obrigat�rio
      ,'peso'                 => ''                     //opcional
      ,'altura'               => ''                     //opcional
      ,'cid-10'               => ''                     //opcional
    ]
    ,'prescritor'             => [                      //obrigat�rio
       'coCNES'               => ''                     //opcional
      ,'nuCRM'                => ''                     //opcional
      ,'ufCRM'                => ''                     //opcional
    ]
  ],
  [ //exemplo registro 3
     'estabelecimento'        => [                      //obrigat�rio
       'idIdentificacao'      => 'CNES'                 //obrigat�rio
    ]
    ,'produto'                => [                      //obrigat�rio
       'nuProduto'            => 'EBR0266630U0118'      //obrigat�rio
      ,'nuLote'               => '123'                  //obrigat�rio
      ,'dtValidade'           => '01-01-2020'           //obrigat�rio
      ,'qtProduto'            => '123'                  //obrigat�rio
      ,'dtRegistro'           => '30-10-2017'           //obrigat�rio
      ,'coRegistro'           => '854785'               //obrigat�rio
    ]
    ,'paciente'               => [                      //obrigat�rio
       'nuCNS'                => '700600555663867'      //obrigat�rio
    ]
    ,'prescritor'             => [                      //obrigat�rio
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
    'hor:retificarDispensacaoMedicamentoEmLote' => [
      'identificacao' => ['idOrigem' => IDORIGEM,'coIBGE' => COIBGE,'nuProtocoloEntrada' => $nuProtocoloEntrada]
      ,'registro' => $registros
    ]
  ];

  //envio da requisi��o
  $protocolo = $client->__soapCall("retificarDispensacaoMedicamentoEmLote", $arguments);

  // resposta da requisi��o
  ver($protocolo);

} catch (SoapFault $e){
  //O erro do Web Service ou mensagem de falha para ser tratado.
  ver($e);
}

?>