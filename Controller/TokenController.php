<?php

namespace OAuth2\ServerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// this imports the "@Route" annotation
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TokenController extends Controller
{
    /**
     * This is called by the client app once the client has obtained
     * an authorization code from the Authorize Controller (@see OAuth2\ServerBundle\Controller\AuthorizeController).
     * returns a JSON-encoded Access Token or a JSON object with
     * "error" and "error_description" properties.
     *
     * @Route("/token", name="_token")
     */
    public function tokenAction()
    {
        // get the oauth server (@see OAuth2/ServerBundle/Resources/config/services.xml)
        $server = $this->get('oauth2.server');

        // get the oauth response object (@see OAuth2/ServerBundle/Resources/config/services.xml)
        $response = $this->get('oauth2.response');

        // let the oauth2-server-php library do all the work!
        return $server->handleTokenRequest($this->get('oauth2.request'), $response);
    }
}