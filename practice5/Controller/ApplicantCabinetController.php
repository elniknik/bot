<?php

namespace Controller;

class ApplicantCabinetController extends ApplicantAuthController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if($this->applicant === null) {
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: /");
            return;
        }

        $this->data("applicant", $this->applicant);

        $this->display("cabinet");
    }

    public function logout() {
        if($this->applicant !== null) {
            $this->applicant_auth_model->remove($this->applicantAuth["id"]);
        }
        
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: /");
    }
}