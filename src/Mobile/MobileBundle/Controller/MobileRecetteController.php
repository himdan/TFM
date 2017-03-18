<?php

namespace Mobile\MobileBundle\Controller;

use Mobile\MobileBundle\StdClass\Cridential;
use Mobile\MobileBundle\StdClass\Geolocation;
use Mobile\MobileBundle\StdClass\Person;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
class MobileRecetteController extends Controller
{


    public function connectAction()
    {
            try {
                $this->validateRequest();

                $request = $this->getRequest();
                $cridential = (new Cridential())->setFromRequest($request);
                $url = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . '/uploads/' ;
                $ar = $this->get('mobile.tfProfile')->login($cridential, $url);

                return $this->getJsonResponse($ar);

            } catch(\Exception $e){

               return $this->getJsonException($e);
            }
    }


    public function inscriptionAction()
    {
        try {
            $this->validateRequest();

            $request = $this->getRequest();
            $person = (new Person())->setFormRequest($request);
            $cridential = (new Cridential())->setFromRequest($request);
            $ar = $this->get('mobile.tfProfile')->register($cridential, $person);

            return $this->getJsonResponse($ar);
        } catch(\Exception $e) {

            return $this->getJsonException($e);
        }
        


    }

    public function setApiKeyAction() {
        try {
            $this->validateRequest();
            $ar = $this->get('mobile.tfProfile')->performApiKeyIntegration();

            return $this->getJsonResponse($ar);
        } catch(\Exception $e) {

            return $this->getJsonException($e);
        }
    }
    public function getProfileAction()
    {
        try {
            $this->validateRequest();

            $request = $this->getRequest();

        } catch(\Exception $e) {
            return $this->getJsonException($e);
        }
    }
    public function editProfileAction()
    {
        try {
            $this->validateRequest();
            $request = $this->getRequest();

        } catch(\Exception $e) {

            return $this->getJsonException($e);
        }
    }

    public function editAccountAction()
    {
        try {
            $this->validateRequest();

            $request = $this->getRequest();

            $person = (new Person())->setFormRequest($request);
            $cridential = (new Cridential())->setFromRequest($request);

            $ar = $this->get('mobile.tfProfile')->editAccount($cridential, $person);

            return $this->getJsonResponse($ar);

        } catch(\Exception $e) {

            return $this->getJsonException($e);
        }
    }

    public function editCridentialAction()
    {
        try {
            $this->validateRequest();
            $request = $this->getRequest();
            $cridential = (new Cridential())->setFromRequest($request);
            $newpassword = $request->request->get('newpassword');

            $ar = $this->get('mobile.tfprofile')->editCridential($cridential, $newpassword);

            return $this->getJsonResponse($ar);
            
        } catch(\Exception $e){

            return $this->getJsonException($e);
        }

    }

    public function searchAction()
    {
        try {
            $this->validateRequest();
            $request = $this->getRequest();
            $term = $request->request->get('term');
            $url = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath();
            //$term = $request->get('term');

            $data = $this->container->get('mobile.tfmarker')->getEtablissementBySearch($term, $url);

            $ar = array('success' => true, 'data' => $data);

            return $this->getJsonResponse($ar);


            
        } catch(\Exception $e) {

            return $this->getJsonException($e);
        }

    }

    public function etablissementMobileAction()
    {
        try {
            $this->validateRequest();

            $request = $this->getRequest();
            $url = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath();
            $geolocation = (new Geolocation())->setFromRequest($request);
            
            $data = $this->container->get('mobile.tfmarker')->getEtablissementByLocation($geolocation, $url);
            $ar = array('success' => true, 'data' => $data);

            return $this->getJsonResponse($ar);

        } catch(\Exception $e) {
            return $this->getJsonException($e);
        }
        

    }
    public function etablissementDetailsMobileAction(){
        try {
            $this->validateRequest();

            $request = $this->getRequest();
            $id = $request->request->get('id');
            
            
            
            $data = $this->container->get('mobile.tfmarker')->getEtablissement($id);
            $ar = array('success' => true, 'data' => $data);

            return $this->getJsonResponse($ar);

        } catch(\Exception $e) {
            return $this->getJsonException($e);
        }
    }
    public function routesMobileAction()
    {
        
         try {
            $this->validateRequest();
            $kernel = $this->get('kernel');
            $application = new Application($kernel);
            $application->setAutoExit(false);

            $input = new ArrayInput(array(
               'command' => 'debug:router',
               '-e' =>'prod',
               '--format' =>'json',
               '--process-isolation' =>'',
            ));
            // You can use NullOutput() if you don't need the output
            $output = new BufferedOutput();
            $application->run($input, $output);

            // return the output, don't use if you used NullOutput()
            $content = $output->fetch();
            $content_obj = json_decode($content);
            $content_array = [];
            foreach($content_obj as $route => $instance) {
                $content_array[] = array('name' => $route, 'instance' => $instance);
            }

            $ar = array('success' => true, 'routes' => $content_array);
            
            return $this->getJsonResponse($ar);

        } catch(\Exception $e) {
            
            return $this->getJsonException($e);

        }
        
    }

    private function getJsonResponse($ar)
    {
        $response = new JsonResponse();
        $response->headers->set('Access-Control-Allow-Origin','*');
        $response->setData($ar);
        return $response;
    }

    private function validateRequest()
    {
        $request = $this->getRequest();
        if($request->getMethod() != 'POST') {
            throw new \Exception('Access Denied');
        }
    }

    private function getJsonException(\Exception $e){

        $ar = array('success' => false, 'message' => $e->getMessage());
        return $this->getJsonResponse($ar);
    }


}
