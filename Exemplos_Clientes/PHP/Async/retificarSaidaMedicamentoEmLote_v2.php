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
      <hor:retificarSaidaMedicamentoEmLote>
         <identificacao>
            <idOrigem>E</idOrigem>
            <coIBGE>23</coIBGE>
            <nuProtocoloEntrada>17110000023000003262</nuProtocoloEntrada>
         </identificacao>
         <!--1 or more repetitions:-->
         <registro>
            <estabelecimento>
               <coCNES>5717493</coCNES>
               <coTipoEstabelecimento>A</coTipoEstabelecimento>
            </estabelecimento>
            <produto>
               <coRegistroOrigem>1234</coRegistroOrigem>
               <nuProduto>EBR0266630U0118</nuProduto>
               <nuLote>123</nuLote>
               <dtValidade>10-10-2020</dtValidade>
               <qtProduto>123</qtProduto>
               <dtRegistro>08-11-2017</dtRegistro>
               <sgProgramaSaude>DST</sgProgramaSaude>
               <nuCNPJFabricante>10176265000107</nuCNPJFabricante>
               <tpSaida>S-AE</tpSaida>
               <coRegistro>20506</coRegistro>
            </produto>
            <estabelecimento-destino>
               <idIdentificacao>CNES</idIdentificacao>
               <coCNES>5717493</coCNES>
            </estabelecimento-destino>
         </registro>
      </hor:retificarSaidaMedicamentoEmLote>
   </soapenv:Body>
</soapenv:Envelope>

 */

$nuProtocoloEntrada = '17110000023000003228';                    //obrigat�rio


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// array associativo de registros                                                                                                                                                                //
// dentro da vari�vel $registros, podem ser inseridos quantos arrays forem necess�rios, cada conjunto de arrays dentro desta vari�vel, e considerado um registro                                 //
// cada registro � composto por:                                                                                                                                                                 //
// Um array de estabelecimento, um array de produto e um array de estabelecimento-destino:                                                                                                       //
//                                                                                                                                                                                               //
// Array de Estabelecimento:                                                                                                                                                                     //
// coCNES, coTipoEstabelecimento                                                                                                                                                                 //
//                                                                                                                                                                                               //
// Array de Produto:                                                                                                                                                                             //
// coRegistroOrigem,nuProduto,nuLote,dtValidade,qtProduto,dtRegistro,sgProgramaSaude,coIUM,nuCNPJFabricante,noFabricanteInternacional,tpSaida,coRegistro                                         //
//                                                                                                                                                                                               //
// Array de Estabelecimento-destino:                                                                                                                                                             //
// idIdentificacao,coCNES,nuCNPJ                                                                                                                                                                 //
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$registros = [
  [ //exemplo registro 1
     'estabelecimento'               => [                        //obrigat�rio
       'coCNES'                      => '5717493'                //opcional
      ,'coTipoEstabelecimento'       => 'A'                      //opcional
    ]
    ,'produto'                       => [                        //obrigat�rio
       'coRegistroOrigem'            => '123'                    //opcional
      ,'nuProduto'                   => 'EBR0266630U0118'        //obrigat�rio
      ,'nuLote'                      => '123'                    //obrigat�rio
      ,'dtValidade'                  => '01-01-2020'             //obrigat�rio
      ,'qtProduto'                   => '123'                    //obrigat�rio
      ,'dtRegistro'                  => '08-11-2017'             //obrigat�rio
      ,'sgProgramaSaude'             => 'DST'                    //opcional
      ,'coIUM'                       => '123'                    //opcional
      ,'nuCNPJFabricante'            => '10176265000107'         //opcional
      ,'noFabricanteInternacional'   => 'FABRICANTE'             //opcional
      ,'tpSaida'                     => 'S-AE'                   //obrigat�rio
      ,'coRegistro'                  => '20506'                  //obrigat�rio
    ]
    ,'estabelecimento-destino'       => [                        //obrigat�rio
       'idIdentificacao'             => 'CNES'                   //obrigat�rio
      ,'coCNES'                      => '5717493'                //opcional
      ,'nuCNPJ'                      => '10176265000107'         //opcional
    ]
  ]
 ,[ //exemplo registro 2
     'estabelecimento'               => [                        //obrigat�rio
       'coCNES'                      => ''                       //opcional
      ,'coTipoEstabelecimento'       => ''                       //opcional
    ]
    ,'produto'                       => [                        //obrigat�rio
       'coRegistroOrigem'            => ''                       //opcional
      ,'nuProduto'                   => 'EBR0266630U0118'        //obrigat�rio
      ,'nuLote'                      => '123'                    //obrigat�rio
      ,'dtValidade'                  => '01-01-2020'             //obrigat�rio
      ,'qtProduto'                   => '123'                    //obrigat�rio
      ,'dtRegistro'                  => '08-11-2017'             //obrigat�rio
      ,'sgProgramaSaude'             => ''                       //opcional
      ,'coIUM'                       => ''                       //opcional
      ,'nuCNPJFabricante'            => ''                       //opcional
      ,'noFabricanteInternacional'   => ''                       //opcional
      ,'tpSaida'                     => 'S-AE'                   //obrigat�rio
      ,'coRegistro'                  => '20506'                  //obrigat�rio
    ]
    ,'estabelecimento-destino'       => [                        //obrigat�rio
       'idIdentificacao'             => 'CNES'                   //obrigat�rio
      ,'coCNES'                      => ''                       //opcional
      ,'nuCNPJ'                      => ''                       //opcional
    ]
  ]
 ,[ //exemplo registro 3
     'estabelecimento'               => [                        //obrigat�rio
    ]
    ,'produto'                       => [                        //obrigat�rio
       'nuProduto'                   => 'EBR0266630U0118'        //obrigat�rio
      ,'nuLote'                      => '123'                    //obrigat�rio
      ,'dtValidade'                  => '01-01-2020'             //obrigat�rio
      ,'qtProduto'                   => '123'                    //obrigat�rio
      ,'dtRegistro'                  => '08-11-2017'             //obrigat�rio
      ,'tpSaida'                     => 'S-AE'                   //obrigat�rio
      ,'coRegistro'                  => '20506'                  //obrigat�rio
    ]
    ,'estabelecimento-destino'       => [                        //obrigat�rio
     'idIdentificacao'               => 'CNES'                   //obrigat�rio
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
    'hor:retificarSaidaMedicamentoEmLote' => [
      'identificacao' => ['idOrigem' => IDORIGEM,'coIBGE' => COIBGE,'nuProtocoloEntrada' => $nuProtocoloEntrada]
      ,'registro' => $registros
    ]
  ];

  //envio da requisi��o
  $protocolo = $client->__soapCall("retificarSaidaMedicamentoEmLote", $arguments);

  // resposta da requisi��o
  ver($protocolo);

} catch (SoapFault $e){
  //O erro do Web Service ou mensagem de falha para ser tratado.
  ver($e);
}
    
?>