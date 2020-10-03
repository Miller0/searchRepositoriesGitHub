<?php

namespace system;



class Model
{
    public $errors;
    public $db;


    function __construct()
    {
        $this->db = new DB();
    }

}