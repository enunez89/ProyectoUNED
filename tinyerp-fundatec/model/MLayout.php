<?php

/**
 * Description of MLogin
 *
 */
require_once '../../../utilities/utilities.php';

class MLayout {
      public function getMenu() {    
        $utilitiesAux = new Utilities();
        $_SESSION['menuModulo'] ="";
        try {
            $client = new SoapClient($utilitiesAux->getWSDLLogIn());
            $parametros = array('userName' => $_SESSION['username'], 'applicationID' => (string)$_SESSION['applicationGlobal']);
            $result = $client->GetMenu($parametros);

            if (empty($result->GetMenuResult->WCFDetailProcess)) {
                $_SESSION['menuModulo'] = "";
            } else {                
                if(count($result->GetMenuResult->WCFDetailProcess) == 1 ){
                    $arrayAux = $result->GetMenuResult;
                }else{
                    $arrayAux = $result->GetMenuResult->WCFDetailProcess;
                }
                foreach ($arrayAux as $key => $value) {
                    $_SESSION['menuModulo'][] = array(
                        $value->ProcessId,
                        $value->Code,
                        $value->NameMainProcess,
                        $value->DescriptionMainProcess,
                        $value->urlItem,
                        $value->ImageIcon,
                        $value->NameDetailProcess,
                        $value->View,
                        $value->Controler,
                        $value->RawUrl,
                        $value->CodeDetail);
                }
            }
        } catch (Exception $e) {
             $_SESSION['menuModulo']= "";
            print "Caught exception: " . $e->getMessage() . "\n";
        }
    }
}

//fin del class
