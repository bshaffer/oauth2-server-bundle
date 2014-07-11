<?php

namespace OAuth2\ServerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// this imports the "@Route" annotation
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ResourceController extends Controller
{
    /**
     * This is called by the client app once the client has obtained an access
     * token for the current user.  If the token is valid, the resource (in this
     * case, the "friends" of the current user) will be returned to the client
     *
     * @Route("/token", name="_token")
     */
    public function resource(Application $app)
    {
        // get the oauth server (configured in src/OAuth2Demo/Server/Server.php)
        $server = $app['oauth_server'];

        // get the oauth response (configured in src/OAuth2Demo/Server/Server.php)
        $response = $app['oauth_response'];

        if (!$server->verifyResourceRequest($app['request'], $response)) {
            return $server->getResponse();
        } else {
            // return a fake API response - not that exciting
            // @TODO return something more valuable, like the name of the logged in user
            $api_response = array(
                'friends' => array(
                    'john',
                    'matt',
                    'jane'
                )
            );

            return new Response(json_encode($api_response));
        }
    }
}
