<?php

class Request {
    public $url;
    public $method;
    public $params;
    public $query;
    public $body;
    public $user;

    public function __construct() {
        $this->url = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->params = [];
        $this->query = $_GET;
        $this->body = json_decode(file_get_contents('php://input'));
        $this->user = null;
    }
}