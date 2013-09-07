<?php

namespace OAuth2\ServerBundle\Storage;

use OAuth2\Storage\ClientCredentialsInterface;
use Doctrine\ORM\EntityManager;
use OAuth2\ServerBundle\Entity\AccessToken;
use OAuth2\ServerBundle\Entity\Client;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

class ClientCredentials implements ClientCredentialsInterface
{
    private $em;

    public function __construct(EntityManager $EntityManager)
    {
        $this->em = $EntityManager;
    }

    /**
     * Make sure that the client credentials is valid.
     *
     * @param $client_id
     * Client identifier to be check with.
     * @param $client_secret
     * (optional) If a secret is required, check that they've given the right one.
     *
     * @return
     * TRUE if the client credentials are valid, and MUST return FALSE if it isn't.
     * @endcode
     *
     * @see http://tools.ietf.org/html/rfc6749#section-3.1
     *
     * @ingroup oauth2_section_3
     */
    public function checkClientCredentials($client_id, $client_secret = null)
    {
        // Get Client
        $client = $this->em->getRepository('OAuth2ServerBundle:Client')->find($client_id);

        // If client exists check secret
        if ($client) {
            return $client->getClientSecret() === $client_secret;
        }

        return FALSE;
    }

    /**
     * Get client details corresponding client_id.
     *
     * OAuth says we should store request URIs for each registered client.
     * Implement this function to grab the stored URI for a given client id.
     *
     * @param $client_id
     * Client identifier to be check with.
     *
     * @return array
     * Client details. The only mandatory key in the array is "redirect_uri".
     * This function MUST return FALSE if the given client does not exist or is
     * invalid. "redirect_uri" can be space-delimited to allow for multiple valid uris.
     * @code
     * return array(
     *     "redirect_uri" => REDIRECT_URI,      // REQUIRED redirect_uri registered for the client
     *     "client_id"    => CLIENT_ID,         // OPTIONAL the client id
     *     "grant_types"  => GRANT_TYPES,       // OPTIONAL an array of restricted grant types
     * );
     * @endcode
     *
     * @ingroup oauth2_section_4
     */
    public function getClientDetails($client_id)
    {
        // Get Client
        $client = $this->em->getRepository('OAuth2ServerBundle:Client')->find($client_id);

        if (!$client) return FALSE;

        // Normalize entity into array
        // $encoders = array();
        // $normalizers = array(new GetSetMethodNormalizer());
        //$serializer = new Serializer($normalizers, $encoders);
        // return $serializer->normalize($client);

        return array(
            'redirect_uri' => $client->getRedirectUri(),
            'client_id' => $client->getClientId()
        //    'grant_types' => array()
        );
    }

    /**
     * Check restricted grant types of corresponding client identifier.
     *
     * If you want to restrict clients to certain grant types, override this
     * function.
     *
     * @param $client_id
     * Client identifier to be check with.
     * @param $grant_type
     * Grant type to be check with
     *
     * @return
     * TRUE if the grant type is supported by this client identifier, and
     * FALSE if it isn't.
     *
     * @ingroup oauth2_section_4
     */
    public function checkRestrictedGrantType($client_id, $grant_type)
    {
        // TODO Add support for different grant types
        return TRUE;
    }
}