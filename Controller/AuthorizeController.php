<?php

namespace OAuth2\ServerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AuthorizeController extends Controller
{
    /**
     * @Route("/authorize", name="_authorize_validate")
     * @Method({"GET"})
     * @Template("OAuth2ServerBundle:Authorize:authorize.html.twig")
     */
    public function validateAuthorizeAction()
    {
        $server = $this->get('oauth2.server');

        if(!$server->validateAuthorizeRequest($this->get('oauth2.request'), $this->get('oauth2.response'))) {
            return $server->getResponse();
        }


        return array('request' => $this->get('oauth2.request')->query->all());
        //$response = $server->handleAuthorizeRequest($this->get('oauth2.request'), $this->get('oauth2.response'));

        //var_dump($response);        
    }

    /**
     * @Route("/authorize", name="_authorize_handle")
     * @Method({"POST"})
     */
    public function handleAuthorizeAction()
    {
        $server = $this->get('oauth2.server');

        return $server->handleAuthorizeRequest($this->get('oauth2.request'), $this->get('oauth2.response'), TRUE);       
    }
}