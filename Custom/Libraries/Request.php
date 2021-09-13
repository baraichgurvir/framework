<?php

namespace Framework\Libraries;

use Rakit\Validation\Validator;
use Exception;

class Request {
    private array $all = [];

    public function __construct() {
        $_SERVER['REQUEST_METHOD'] == 'POST' ? $this->variables($_POST) : $this->variables($_GET);    
    }

    public function all() {
        return $this->all;
    }

    public function validate(array $rules) {
        $validator = new Validator();
        $validation = $validator->make($this->all, $rules);
        $validation->validate();

        if ($validation->fails()) {
            foreach ($validation->errors() as $error) {
                foreach ($error as $key => $skip) {
                    foreach ($error[$key] as $rule) {
                        throw new Exception($rule);
                    }
                }
            }
        }
    }

    private function variables(array $array) {
        foreach ($array as $key => $value) {
            $this->$key = $value;
            $this->all[$key] = $value;
        }
    }
}
