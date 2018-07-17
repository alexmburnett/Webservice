<?php
/*
 * Exemplo de XML
 *
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:hor="http://www.saude.gov.br/horus-ws/schemas/v1/HorusTypes">
   <soapenv:Header/>
   <soapenv:Body>
      <hor:informarDispensacaoMedicamentoEmLote>
         <identificacao>
            <idOrigem>E</idOrigem>
            <coIBGE>23</coIBGE>
         </identificacao>
         <!--1 or more repetitions:-->
         <registro>
            <estabelecimento>
               <idIdentificacao>CNES</idIdentificacao>
               <coCNES>5717493</coCNES>
            </estabelecimento>
            <produto>
               <coRegistroOrigem>123</coRegistroOrigem>
               <nuProduto>EBR0266630U0118</nuProduto>
               <nuLote>123</nuLote>
               <dtValidade>10-01-2020</dtValidade>
               <qtProduto>123</qtProduto>
               <dtRegistro>08-11-2017</dtRegistro>
               <sgProgramaSaude>DST</sgProgramaSaude>
               <dtCompetencia>11-2017</dtCompetencia>
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
      </hor:informarDispensacaoMedicamentoEmLote>
   </soapenv:Body>
</soapenv:Envelo
 */

//Par�metros de Conex�o
$email = "SEU E-MAIL";
$senha = "SUA SENHA";
//Par�metros do XML
$idOrigem = 'E';
$coIBGE = '23';
$idIdentificacao = 'CNES';
$coCNES = '5717493';
$coRegistroOrigem = '123';
$nuProduto = 'EBR0266630U0118';
$nuLote = '123';
$dtValidade = '10-01-2020';
$qtProduto = '123';
$dtRegistro = '08-11-2017';
$sgProgramaSaude = 'DST';
$dtCompetencia = '11-2017';
$nuCNS = '700600555663867';
$peso = '70.10';
$altura = '175';
$cid_10 = 'F20.0';
$coCNES1 = '5717493';
$nuCRM = '1234';
$ufCRM = 'DF';

try{
    $client = new SoapClient('http://horusws.treinamento.saude.gov.br/horus-ws-service/HorusWSService/HorusWS?wsdl',['login'=>$email,'password'=>$senha]);
    
    $arguments = ['hor:informarDispensacaoMedicamentoEmLote' => [
                                'identificacao' => ['idOrigem' => $idOrigem, 'coIBGE' => $coIBGE],
                                     'registro' => ['estabelecimento' => ['idIdentificacao' => $idIdentificacao,'coCNES' => $coCNES],
                                      'produto' => ['coRegistroOrigem' => $coRegistroOrigem,
                                                           'nuProduto' => $nuProduto,
                                                              'nuLote' => $nuLote,
                                                          'dtValidade' => $dtValidade,
                                                           'qtProduto' => $qtProduto,
                                                          'dtRegistro' => $dtRegistro,
                                                     'sgProgramaSaude' => $sgProgramaSaude,
                                                       'dtCompetencia' => $dtCompetencia],
                                      'paciente' => ['nuCNS' => $nuCNS,
                                                      'peso' => $peso,
                                                    'altura' => $altura,
                                                    'cid-10' => $cid_10],
                                    'prescritor' => ['coCNES' => $coCNES1,
                                                      'nuCRM' => $nuCRM,
                                                      'ufCRM' => $ufCRM]
                 ]]];
    
    $protocolo = $client->__soapCall("informarDispensacaoMedicamentoEmLote", $arguments);
    
    echo '<pre>';
    var_dump($protocolo);
    echo '</pre>';
    
} catch (SoapFault $e){
    //O erro do Web Service ou mensagem de falha para ser tratado.
    echo '<pre>';
    var_dump($e);
    echo '<pre>';
}
?>