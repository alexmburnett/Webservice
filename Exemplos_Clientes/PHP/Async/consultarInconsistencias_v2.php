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
      <hor:protocolo>
         <nuProtocoloEntrada>17100000023000003132</nuProtocoloEntrada>
         <dtRecebimento>31-10-2017 15:34:12</dtRecebimento>
      </hor:protocolo>
   </soapenv:Body>
</soapenv:Envelope>
 
 */


//Par�metros do XML
$nuProtocoloEntrada = '17100000023000003132';
$dtRecebimento = '31-10-2017 15:34:12';

try{

  // link do webservice com as credenciais para acesso
  $client = new SoapClient(AMBIENTE,['login'=>EMAIL,'password'=>SENHA]);

  // Array de argumentos da requisi��o, ou "Body" do XML
  $arguments = ['hor:protocolo' => ['nuProtocoloEntrada' => $nuProtocoloEntrada, 'dtRecebimento' => $dtRecebimento]];

  //envio da requisi��o
  $protocolo = $client->__soapCall("consultarInconsistencias", $arguments);

  // resposta da requisi��o
  ver($protocolo);

} catch (SoapFault $e){
  //O erro do Web Service ou mensagem de falha para ser tratado.
  ver($e);
}

?>