<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Response
 *
 * @author enunezs89
 */
class Response {

    //propiedades
    public $Code;
    public $UserMsj;
    public $ObjResp;

    function __construct() {
        
    }

    function getCode() {
        return $this->Code;
    }

    function getUserMsj() {
        return $this->UserMsj;
    }

    function getObjResp() {
        return $this->ObjResp;
    }

    function setCode($Code) {
        $this->Code = $Code;
    }

    function setUserMsj($UserMsj) {
        $this->UserMsj = $UserMsj;
    }

    function setObjResp($ObjResp) {
        $this->ObjResp = $ObjResp;
    }

}
