<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 12/11/16
 * Time: 5:20 PM
 */

namespace Mobile\MobileBundle\StdClass;


use Symfony\Component\HttpFoundation\Request;

class Geolocation
{
   public $longitude;
   public $latitude;
   public function __construct($lat=null,$long=null)
   {
       $this->latitude = $lat;
       $this->longitude = $long;
   }
   public function setFromRequest(Request $request)
   {

       $this->setLatitude($request->request->get('latitude'));
       $this->setLongitude($request->request->get('longitude'));
       return $this;
   }
   protected function setLatitude($lat)
   {

       $this->latitude = (is_float($lat))? $lat : 36.7581145;
   }
   protected function setLongitude($long)
   {
       $this->longitude =(is_float($long))? $long: 10.0169723;
   }
   public function __toJson()
   {
       return json_encode($this);
   }
   public function __fromJson($location)
   {
       try{
           $geolocation = json_decode($location);
           $this->latitude = $geolocation->latitude;
           $this->longitude = $geolocation->longitude;
           return $this;
       } catch(\Exception $e){
           return new Geolocation();
       }
   }

}