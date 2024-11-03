<?php

namespace Controller;

use \Config\Consts;
use \Responses\WidgetTelegramResponse;

class ApplicantController extends ApplicantAuthController {
    private $applicantModel;

    public function __construct() {
        parent::__construct();
        $this->loadModel("Applicant", "applicant_model");
        $this->loadModel("ApplicantAuth", "applicant_applicant_auth_model");
    }

    public function auth() {

        if(!isset($_GET["auth_date"]) || !isset($_GET["first_name"]) || !isset($_GET["id"])
            || !isset($_GET["hash"])) {
            exit();
        }

        // $response = new \Responses\WidgetTelegramResponse($_GET["auth_date"]), $_GET["first_name"], $_GET["id"], $_GET["hash"]);
        
        $hash = $_GET["hash"];

        unset($_GET["hash"]);

        $data = [];
        foreach ($_GET as $key => $value) {
            $data[] = $key . '=' . $value;
        }

        sort($data);

        $checkString = implode("\n", $data);

        $secretKey = hash('sha256', Consts::TELEGRAM_TOKEN, true);
        $hashGen = hash_hmac("sha256", $checkString, $secretKey);
        if ((strcmp($hashGen, $hash) !== 0) || ((time() - $_GET['auth_date']) > 86400)) {
            exit();
        }

        $applicant = $this->applicant_model->getByChatId($_GET["id"]);

        if($applicant === null) {
            $this->applicant_model->create([
                "firstname" => $_GET["first_name"],
                "lastname" => (isset($_GET["last_name"])) ? $_GET["last_name"] : "",
                "username" => $_GET["username"],
                "chat_id" => $_GET["id"],
            ]);

            $applicant = $this->applicant_model->getByChatId($_GET["id"]);
        }
        $applicant_id = $applicant["id"];
        $authToken = base64_encode(hash_hmac("sha256", md5(time() . $applicant_id), $applicant_id, $applicant_id));

        $date = (new \DateTime("now"))->modify("+" . Consts::TOKEN_EXPIRES_SECONDS . " SECONDS");

        $auth = null;

        if(isset($_COOKIE["auth_token"]) && (int)$applicant_id === (int)$this->applicant["id"]) {
            $auth = $this->applicant_auth_model->getByToken($_COOKIE["auth_token"]);
        }

        if($auth === null || !isset($_COOKIE["auth_token"])) {
            $this->applicant_auth_model->create([
                "applicant_id" => (int)$applicant["id"],
                "token" => $authToken,
                "date_expires" => $date->format("Y-m-d H:i:s"),
            ]);

            $auth = $this->applicant_auth_model->getByToken($authToken);
        }

        $this->applicant_auth_model->update($auth["applicant_id"], [
            "date_expires" => $date->format("Y-m-d H:i:s"),
        ]);
        setcookie("auth_token", $authToken, $date->getTimestamp(), "/");

        header("HTTP/1.1 301 Moved Permanently");
        header("Location: /cabinet/");
    }

    public function getAll() {
        $applicants = $this->applicant->getAll(); // Fetch all applicants
        $this->sendResponse($applicants);
    }

    public function getById($id) {
        $applicant = $this->applicant->getById($id); // Fetch applicant by ID
        if ($applicant) {
            $this->sendResponse($applicant);
        } else {
            $this->sendError("Applicant not found");
        }
    }

    public function create($data) {
        // Assuming $data is an associative array with applicant details
        
        if ($this->applicant->create($data)) {
            $this->sendResponse("Applicant created successfully");
        } else {
            $this->sendError("Failed to create applicant");
        }
    }

    public function update($id, $data) {
        if ($this->applicant->update($id, $data)) {
            $this->sendResponse("Applicant updated successfully");
        } else {
            $this->sendError("Failed to update applicant");
        }
    }

    public function delete($id) {
        if ($this->applicant->delete($id)) {
            $this->sendResponse("Applicant deleted successfully");
        } else {
            $this->sendError("Failed to delete applicant");
        }
    }

    private function sendResponse($message) {
        // Logic to send a response back to the client
        // This could be an API response or a message in the Telegram bot
        echo json_encode($message);
    }

    private function sendError($message) {
        // Logic to send an error message
        echo json_encode(["error" => $message]);
    }
}
