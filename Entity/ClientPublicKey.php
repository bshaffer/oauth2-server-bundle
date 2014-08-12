<?php

namespace OAuth2\ServerBundle\Entity;

/**
 * Client
 */
class ClientPublicKey
{
    /**
     * @var \OAuth2\ServerBundle\Entity\Client
     */
    private $client;

    /**
     * @var integer
     */
    private $client_id;

    /**
     * @var string
     */
    private $public_key;

    /**
     * Set client
     *
     * @param  \OAuth2\ServerBundle\Entity\Client $client
     * @return ClientPublicKey
     */
    public function setClient(\OAuth2\ServerBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \OAuth2\ServerBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set client
     *
     * @param  $client_id
     * @return ClientPublicKey
     */
    public function setClientId($client_id)
    {
        $this->client_id = $client_id;

        return $this;
    }

    /**
     * Get client_id
     *
     * @return integer $client_id
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * Set public key
     *
     * @param  string  $public_key
     * @return Client
     */
    public function setPublicKey($public_key)
    {
        $this->public_key = $public_key;

        return $this;
    }

    /**
     * Get public key
     *
     * @return string
     */
    public function getPublicKey()
    {
        return $this->public_key;
    }
}
