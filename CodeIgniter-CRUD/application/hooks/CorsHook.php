<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CorsHook {
    public function handle_cors() {
        header("Access-Control-Allow-Origin: http://localhost:3000");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    }
}
