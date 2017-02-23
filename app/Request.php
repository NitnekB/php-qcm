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
    public $get;
    public $post;

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

        $this->post = $_POST;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param mixed $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return mixed
     */
    public function getContentType()
    {
        return $this->contentType;
    }

}