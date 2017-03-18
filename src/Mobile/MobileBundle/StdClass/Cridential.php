<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 12/11/16
 * Time: 2:09 PM
 */

namespace Mobile\MobileBundle\StdClass;


use Symfony\Component\HttpFoundation\Request;

class Cridential
{
    public $username;
    public $password;

    public function setFromRequest(Request $request)
    {
        $this->username = $request->request->get('username');
        $this->password = $request->request->get('password');
        return $this;
    }
    public function _toJson(){
        return json_encode($this);
    }
    public function __fromJson($cridential){
        try{
            $cridential = json_decode($cridential);
            $this->password = $cridential->password;
            $this->username = $cridential->username;
            return $this;
        } catch(\Exception $e) {
            return new Cridential();
        }
    }
}