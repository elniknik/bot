<?php

namespace Controller;

use \Config\Consts;

class ApplicantAuthController extends Controller {
    protected $applicant;

    public function __construct()
    {
        parent::__construct();
        $this->loadModel("Applicant", "applicant_model");
        $this->loadModel("ApplicantAuth", "applicant_auth_model");

        $this->applicant = null;

        if(isset($_COOKIE["auth_token"])) {
            $this->applicantAuth = $this->applicant_auth_model->getByToken($_COOKIE["auth_token"]);

            if($this->applicantAuth !== null) {
                $this->applicant = $this->applicant_model->getById($this->applicantAuth["applicant_id"]);

                $date = (new \DateTime("now"))->modify("+" . Consts::TOKEN_EXPIRES_SECONDS . " SECONDS");

                $this->applicant_auth_model->update($this->applicantAuth["id"], [
                    "date_expires" => $date->format("Y-m-d H:i:s"),
                ]);
            }
        }
    }
}