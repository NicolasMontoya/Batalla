<?php

class Win extends MY_CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function player()
    {
        echo "GANO USTED";
    }
    public function machine()
    {
        echo "GANO LA MAQUINA";
    }

}
