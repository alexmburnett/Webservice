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
      <hor:retificarEntradaMedicamentoEmLote>
         <identificacao>
            <idOrigem>E</idOrigem>
            <coIBGE>23</coIBGE>
            <nuProtocoloEntrada>17100000023000003137</nuProtocoloEntrada>
         </identificacao>
         <registro>
            <estabelecimento>
               <coCNES>5717493</coCNES>
               <coTipoEstabelecimento>A</coTipoEstabelecimento>
            </estabelecimento>
            <produto>
               <coRegistroOrigem>123</coRegistroOrigem>
               <nuProduto>EBR0266630U0118</nuProduto>
               <nuLote>12345</nuLote>
               <dtValidade>01-01-2020</dtValidade>
               <qtProduto>123</qtProduto>
               <dtRegistro>30-10-2017</dtRegistro>
               <sgProgramaSaude>DST</sgProgramaSaude>
               <nuCNPJFabricante>00530493000171</nuCNPJFabricante>
               <nuNotaFiscal>1324</nuNotaFiscal>
               <nuValorUnitario>1234.1234</nuValorUnitario>
               <nuCNPJDistribuidor>00530493000171</nuCNPJDistribuidor>
               <tpEntradaEstoque>E-O</tpEntradaEstoque>
               <coRegistro>5088</coRegistro>
            </produto>
         </registro>
      </hor:retificarEntradaMedicamentoEmLote>
   </soapenv:Body>
</soapenv:Envelope>

 */

$nuProtocoloEntrada = '17100000023000003137';               //obrigat�rio


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// array associativo de registros                                                                                                                                                                                 //
// dentro da vari�vel $registros, podem ser inseridos quantos arrays forem necess�rios, cada conjunto de arrays dentro desta vari�vel, e considerado um registro                                                  //
// cada registro � composto por:                                                                                                                                                                                  //
// Um array de estabelecimento e um array de produto:                                                                                                                                                             //
//                                                                                                                                                                                                                //
// Array de Estabelecimento:                                                                                                                                                                                      //
// coCNES, coTipoEstabelecimento                                                                                                                                                                                  //
//                                                                                                                                                                                                                //
// Array de Produto:                                                                                                                                                                                              //
// coRegistroOrigem,nuProduto,nuLote,dtValidade,qtProduto,dtRegistro,sgProgramaSaude,coIUM,nuCNPJFabricante,noFabricanteInternacional,nuNotaFiscal,nuValorUnitario,nuCNPJDistribuidor,tpEntradaEstoque,coRegistro //
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$registros = [
  [ //exemplo registro 1
     'estabelecimento'                => [                  //obrigat�rio
       'coCNES'                       => '5717493'          //opcional
      ,'coTipoEstabelecimento'        => 'A'                //opcional
    ]
    ,'produto'                        => [                  //obrigat�rio
       'coRegistroOrigem'             => '123'              //opcional
      ,'nuProduto'                    => 'EBR0266630U0118'  //obrigat�rio
      ,'nuLote'                       => '123'              //obrigat�rio
      ,'dtValidade'                   => '01-01-2020'       //obrigat�rio
      ,'qtProduto'                    => '123'              //obrigat�rio
      ,'dtRegistro'                   => '30-10-2017'       //obrigat�rio
      ,'sgProgramaSaude'              => 'DST'              //opcional
      ,'coIUM'                        => '123'              //opcional
      ,'nuCNPJFabricante'             => '00530493000171'   //opcional
      ,'noFabricanteInternacional'    => 'FABRICANTE'       //opcional
      ,'nuNotaFiscal'                 => '1324'             //obrigat�rio
      ,'nuValorUnitario'              => '1234.1234'        //obrigat�rio
      ,'nuCNPJDistribuidor'           => '00530493000171'   //obrigat�rio
      ,'tpEntradaEstoque'             => 'E-O'              //obrigat�rio
      ,'coRegistro'                   => '5088'             //obrigat�rio
    ]
  ],
  [ // exemplo registro 2
     'estabelecimento'                => [                  //obrigat�rio
       'coCNES'                       => ''                 //opcional
      ,'coTipoEstabelecimento'        => ''                 //opcional
    ]
    ,'produto'                        => [                  //obrigat�rio
       'coRegistroOrigem'             => ''                 //opcional
      ,'nuProduto'                    => 'EBR0266630U0118'  //obrigat�rio
      ,'nuLote'                       => '123'              //obrigat�rio
      ,'dtValidade'                   => '01-01-2020'       //obrigat�rio
      ,'qtProduto'                    => '123'              //obrigat�rio
      ,'dtRegistro'                   => '30-10-2017'       //obrigat�rio
      ,'sgProgramaSaude'              => ''                 //opcional
      ,'coIUM'                        => ''                 //opcional
      ,'nuCNPJFabricante'             => ''                 //opcional
      ,'noFabricanteInternacional'    => ''                 //opcional
      ,'nuNotaFiscal'                 => '1324'             //obrigat�rio
      ,'nuValorUnitario'              => '1234.1234'        //obrigat�rio
      ,'nuCNPJDistribuidor'           => '00530493000171'   //obrigat�rio
      ,'tpEntradaEstoque'             => 'E-O'              //obrigat�rio
      ,'coRegistro'                   => '5088'             //obrigat�rio
    ]
  ],
  [ // exemplo registro 3
     'estabelecimento'                => [                  //obrigat�rio
    ]
    ,'produto'                        => [                  //obrigat�rio
       'nuProduto'                    => 'EBR0266630U0118'  //obrigat�rio
      ,'nuLote'                       => '123'              //obrigat�rio
      ,'dtValidade'                   => '01-01-2020'       //obrigat�rio
      ,'qtProduto'                    => '123'              //obrigat�rio
      ,'dtRegistro'                   => '30-10-2017'       //obrigat�rio
      ,'nuNotaFiscal'                 => '1324'             //obrigat�rio
      ,'nuValorUnitario'              => '1234.1234'        //obrigat�rio
      ,'nuCNPJDistribuidor'           => '00530493000171'   //obrigat�rio
      ,'tpEntradaEstoque'             => 'E-O'              //obrigat�rio
      ,'coRegistro'                   => '5088'             //obrigat�rio
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
      'hor:retificarEntradaMedicamentoEmLote' => [
        'identificacao' => ['idOrigem' => IDORIGEM,'coIBGE' => COIBGE,'nuProtocoloEntrada' => $nuProtocoloEntrada]
        ,'registro' => $registros
      ]
  ];

  //envio da requisi��o
  $protocolo = $client->__soapCall("retificarEntradaMedicamentoEmLote", $arguments);
    

  // resposta da requisi��o
  ver($protocolo);

} catch (SoapFault $e){
  //O erro do Web Service ou mensagem de falha para ser tratado.
  ver($e);
}  

?>