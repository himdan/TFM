<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 12/11/16
 * Time: 1:12 PM
 */

namespace Mobile\MobileBundle\Service;
use Client\ClientBundle\Entity\Client;
use \Doctrine\ORM\EntityManager;
use Mobile\MobileBundle\StdClass\Person;
use Mobile\MobileBundle\StdClass\Cridential;

class TfProfile
{
    protected $em;
    protected $encoder;
    protected $fum;
    public function __construct($em, $encoder, $fum)
    {
        $this->em = $em;
        $this->encoder = $encoder;
        $this->fum = $fum;
    }
    public function login(Cridential $cridential, $url){
        $data = array('success' => false);
        if($this->hasCridential($cridential)) {
            $user = $this->fum->findUserBy(array("username" => $cridential->username));
            $img =($user->getImage())? $url . $user->getImage()->getUrl():null;
            $result = array(
                'apikey'=> $user->getApiKey(),
                'username'=> $user->getUsername(),
                'nom' => $user->getNomClient(),
                'pernom' => $user->getPrenomClient(),
                'img' => $img
            );
            $data['success'] = true;
            $data['result'] = $result;
        }
        return $data;
    }

    public function register(Cridential $cridential,Person $person){
        $data = array('success' => false);
        if(!$this->hasCridential($cridential)) {

            $c= new Client();
            $c->setUsername($cridential->username);
            $c->setEmail($person->email);
            $c->setPlainPassword($cridential->password);
            $c->setEnabled(true);
            $c->setSexeClient($person->gender);
            $c->setNomClient($person->lastName);
            $c->setPrenomClient($person->firstName);

            try {

                $this->em->persist($c);
                $this->em->flush();
                $data = array('success' => true);

            } catch(\Exception $e) {

                $data = array('success' => false);
            }

        }
        return $data;
    }
    public function editAccount(Cridential $cridential,Person $person){
        $data = array('success' => false);
        if($this->hasCridential($cridential)) {
            $user = $this->em->getRepository('ClientBundle:Client')->findOneBy(array('username'=> $cridential->username));
            $user->setNomClient($person->lastName);
            $user->setPrenomClient($person->firstName);
            $user->setEmail($person->email);
            $user->setMobileClient($person->phone);
            try {
                $this->em->persist($user);
                $this->em->flush();
                $data['success'] = true;
            } catch(\Exception $e){
                $data['success'] = false;
            }

        }
        return $data;
    }
    public function getProfile(Cridential $cridential) {
        $data = array('success' => false);
        if($this->hasCridential($cridential)) {
            //register phase
        }
        return $data;
    }
    public function editCridential(Cridential $cridential,$newpassword){
        $data = array('success'=> false);
        if($this->hasCridential($cridential)) {
            $client = $this->em->getRepository('ClientBundle:Client')->findOneBy(array('username'=> $cridential->username));
            $user = $this->fum->findUserBy(array("username" => $cridential->username));
            $new_encoded = $this->encoder->encodePassword($user, $newpassword);
            $client->setPassword($new_encoded);
            $this->em->persist($client);
            $this->em->flush();
            $data['success'] = true;
        }
        return $data;
    }
    public function performApiKeyIntegration() {
        $clients = $this->em->getRepository('ClientBundle:Client')->findAll();
        foreach($clients as $client){
            $client->setApiKey();
            $this->em->persist($client);
            $this->em->flush();

        }
        $data = array('success' => true);
        return $data;
    }
    protected function hasCridential(Cridential $cridential){
        $user = $this->fum->findUserBy(array("username" => $cridential->username));
        $has_cridential = false;
        if($user) {
            $encoded_pass = $this->encoder->encodePassword($user, $cridential->password);
            $current_pass = $user->getPassword();
            $has_cridential = ($encoded_pass == $current_pass)? true: false;

        }
        return $has_cridential;
    }
    protected function format(){}
}