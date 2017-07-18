<?php

namespace OAuth2\ServerBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class OauthTokenResponseErrorEvent extends Event
{
    const NAME = 'oauth.token.response.error';

    /*
     * @var int
     */
    protected $statusCode;

    /**
     * @var string
     */
    protected $error;

    /**
     * @var string
     */
    protected $errorDescription;

    /**
     * @var array
     */
    protected $requestParameters;

    public function __construct($statusCode, $error, $errorDescription, array $requestParameters)
    {
        $this->statusCode = $statusCode;
        $this->error = $error;
        $this->errorDescription = $errorDescription;
        $this->requestParameters = $requestParameters;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @return string
     */
    public function getErrorDescription()
    {
        return $this->errorDescription;
    }

    /**
     * @return array
     */
    public function getRequestParameters()
    {
        return $this->requestParameters;
    }

    /**
     * @param string $parameterName
     * @return mixed|null
     */
    public function getRequestParameter($parameterName)
    {
        return isset($this->requestParameters[$parameterName]) ? $this->requestParameters[$parameterName] : null;
    }
}
