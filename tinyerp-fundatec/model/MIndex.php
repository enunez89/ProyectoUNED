<?php

require_once '../../utilities/utilities.php';
require_once '../../entity/Application.php';

class MIndex {

    public function getApplicationsUsers($userId) {
        $utilitiesAux = new Utilities();
        $applicationList = array();
        try {
            $client = new SoapClient($utilitiesAux->getWSDLLogIn());
            $parametros = array('userId' => $userId);
            $result = $client->GetApplications($parametros);

            if ($result->GetApplicationsResult->WCFApplications == null) {
                
            } else {
                $arrayAux = $result->GetApplicationsResult->WCFApplications;
                if (count($arrayAux) == 1) {
                    $applicationAux = new ApplicationUser();
                    $applicationAux->setApplicationName($result->GetApplicationsResult->WCFApplications->ApplicationName);
                    $applicationAux->setApplicationId($result->GetApplicationsResult->WCFApplications->ApplicationId);
                    $applicationAux->setDescription($result->GetApplicationsResult->WCFApplications->Description);
                    $applicationAux->setURL($result->GetApplicationsResult->WCFApplications->URL);
                    $applicationAux->setNameIcon($result->GetApplicationsResult->WCFApplications->NameIcon);
                    $applicationAux->setUserID($result->GetApplicationsResult->WCFApplications->UserID);
                    array_push($applicationList, $applicationAux);
                } else {
                    foreach ($arrayAux as $key => $value) {                      
                        $applicationAux = new ApplicationUser();
                        $applicationAux->setApplicationName($value->ApplicationName);
                        $applicationAux->setApplicationId($value->ApplicationId);
                        $applicationAux->setDescription($value->Description);
                        $applicationAux->setURL($value->URL);
                        $applicationAux->setNameIcon($value->NameIcon);
                        $applicationAux->setUserID($value->UserID);
                        array_push($applicationList, $applicationAux);
                    }
                }
            }
        } catch (Exception $e) {
            print "Caught exception: " . $e->getMessage() . "\n";
        }
        return $applicationList;
    }

}
    