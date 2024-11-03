<?php

namespace Controller;

class HomeController extends ApplicantAuthController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if($this->applicant !== null) {
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: /cabinet/");
            return;
        }

        $this->display("home");
    }
}