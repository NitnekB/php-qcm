<?php
/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 22/02/2017
 * Time: 16:13
 */

namespace App;


class Request
{
    private $get;
    private $method;
    private $contentType;
    private $httpAcceptLanguage;
    private $remoteAddress;

    /**
     * Request constructor.
     * @param $server
     */
    public function __construct($server)
    {
        $this->get = $server['QUERY_STRING'];
        $this->method = $server['REQUEST_METHOD'];
        $this->contentType = $server['CONTENT_TYPE'];
        $this->httpAcceptLanguage = $server['HTTP_ACCEPT_LANGUAGE'];
        $this->remoteAddress = $server['REMOTE_ADDR'];
    }

    /**
     * @return mixed
     */
    public function getGet()
    {
        return $this->get;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return mixed
     */
    public function getContentType()
    {
        return $this->contentType;
    }

}