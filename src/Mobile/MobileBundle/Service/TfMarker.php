<?php

namespace Mobile\MobileBundle\Service;
use \Doctrine\ORM\EntityManager;
use Mobile\MobileBundle\StdClass\Geolocation;
use JMS\Serializer\Serializer;

class TfMarker {

    private $em;

	public function __construct(EntityManager $em, Serializer $sl)
	{
		$this->em = $em;
        $this->sl = $sl;
	}
    /*public function __construct() {

    }*/
	/**
	* @param $geo Geolocation
    * @parma $url
	* @return array
	*/
	public function getEtablissementByLocation(Geolocation $geo, $url)
	{
		$result = $this->em->getRepository('AdministrationBundle:Etablissement')->findByLocation($geo->latitude, $geo->longitude);
		return $this->format($result, $url);

	}
    /**
    * @param $id
    * @return mixed
    */
    public function getEtablissement($id) 
    {
        $result = $this->em->getRepository('AdministrationBundle:Etablissement')->findOneBy(array('id' => $id));
        if($result){
            return json_decode($this->sl->serialize($result,"json"));
        } else {
            throw new  \Exception("cette etablissent n'exist pas", 1);
            
        }
    }
    /**
    * @param $search
    * @return array
    */

    public function getEtablissementBySearch($search, $url)
    {
        $result = $this->em->getRepository('AdministrationBundle:Etablissement')->recherche($search);
        return $this->format($result, $url);

    }

	/**
	* @param $result
	* @param $url
	* @return array
	*/

	protected function format($result, $url)
	{
		$ar = [];
        foreach($result as $ac){
            if(is_array($ac)) {
                $img = $url.'/uploads/'.$ac['imageEtablissement']. '.png';
                if($ac['iconeEtablissement']) {
                    $icone = $url.'/uploads/'.$ac['iconeEtablissement'];
                } else {
                    $icone = '';
                }
                array_push($ar,array(
                    'id' => $ac['idEtablissement'],
                    'address' => $ac['adresseEtablissement'].' '.$ac['postaleEtablissement'].' '.$ac['gouvernoratEtablissement'].', '.$ac['regionEtablissement'],
                    'latitude' => $ac['latEtablissement'],
                    'longitude' => $ac['longEtablissement'],
                    'icon' => array(
                        'url' => $icone,
                        'width' => 32,
                        'height' => 32
                    ),
                    'title' => $ac['titreEtablissement'],
                    'is_centered' => false,
                    'image' => $img,
                    'distance' => $ac['distance'],

                ));

            } else {
                $img = $url.'/uploads/'.$ac->getImage();
                if($ac->getIcone()) {
                    $icone = $url.'/uploads/'.$ac->getIcone();
                } else {
                    $icone = '';
                }
                array_push($ar,array(
                    'id' => $ac->getId(),
                    'address' => $ac->getAdresseEtablissement().' '.$ac->getPostaleEtablissement().' '.$ac->getGouvernorat().', '.$ac->getRegion(),
                    'latitude' => $ac->getLatEtablissement(),
                    'longitude' => $ac->getLongEtablissement(),
                    'icon' => array(
                        'url' => $icone,
                        'width' => 32,
                        'height' => 32
                    ),
                    'title' => $ac->getNomEtablissement(),
                    'is_centered' => false,
                    'image' => $img,
                    'distance' => null,

                ));

            }
            
            
        }
        return $ar;

    }
}