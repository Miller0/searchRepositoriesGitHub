<?php

namespace system;

use DB;

class Model
{
    public $errors;
    public $db;


    function __construct()
    {
        $this->db = new DB();
    }

}