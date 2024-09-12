<?php
    class Response {
        public function __construct() {
        }
        public function redirect($url) {
            header("Location: " . BASE_URL . $url);
            die();
        }
    }