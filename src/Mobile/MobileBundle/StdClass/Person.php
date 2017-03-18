<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 12/11/16
 * Time: 1:23 PM
 */

namespace Mobile\MobileBundle\StdClass;

use Symfony\Component\HttpFoundation\Request;


class Person
{
   public $firstName;
   public $lastName;
   public $email;
   public $phone;
   public $address;
   public $gender;

   public function setFormRequest(Request $request){

       $this->firstName = $request->request->get('prenom');
       $this->lastName = $request->request->get('nom');
       $this->email = $request->request->get('email');
       $this->gender = $request->request->get('gender');
       $this->phone = ($request->request->get('phone'))?$request->request->get('phone'):'';
       $this->address = ($request->request->get('address'))?$request->request->get('address'):'';
       return $this;
   }
   public function __toJson(){
       return json_encode($this);
   }
   public function __fromJson($json){
       try{
           $person = json_decode($json, true);
           $this->firstname = $person->firstName;
           $this->lastname = $person->lastName;
           $this->email = $person->email;
           $this->address = $person->address;
           $this->gender = $person->gender;
           return $this;
       } catch(\Exception $e) {
            return new Person;
       }

   }
}