<?php

namespace Controller;

use \Config\Config;

class TelegramController extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/logs/telegram.log", file_get_contents("php://input") . "\n", FILE_APPEND);

        $data = json_decode(file_get_contents("php://input"), true);

        //$data = json_decode('{"update_id":928317500, "message":{"message_id":7,"from":{"id":830545191,"is_bot":false,"first_name":"Elena","last_name":"Nikulina","language_code":"ru"},"chat":{"id":830545191,"first_name":"Elena","last_name":"Nikulina","type":"private"},"date":1730653785,"text":"/start","entities":[{"offset":0,"length":6,"type":"bot_command"}]}}', true);

        $chatId = 0;
        $text = "";
        $input = null;
        $from = "";

        if(isset($data["message"]) && isset($data["message"]["chat"]) && isset($data["message"]["chat"]["id"])) {
            $chatId = (int)$data["message"]["chat"]["id"];
            $from = $data["message"]["from"];
            $text = $data["message"]["text"];
            $messageId = $data["message"]["message_id"];

            if(isset($data["message"]["reply_to_message"]) && isset($data["message"]["reply_to_message"]["text"])) {
                $text = $data["message"]["reply_to_message"]["text"];
                $input = $data["message"]["text"];
            }
        }

        if(isset($data["callback_query"]) && isset($data["callback_query"]["message"]) && isset($data["callback_query"]["message"]["chat"]) && isset($data["callback_query"]["message"]["chat"]["id"])) {
            $chatId = (int)$data["callback_query"]["message"]["chat"]["id"];
            $from = $data["callback_query"]["message"]["from"];
            $text = $data["callback_query"]["data"];
            $messageId = $data["callback_query"]["message"]["message_id"];
        }

        $this->loadModel("applicant", "applicant");

        $applicant = $this->applicant->getByChatId($chatId);

        if($applicant === null) {
            $this->applicant->create([
                "firstname" => (isset($from["first_name"])) ? $from["first_name"] : "",
                "lastname" => (isset($from["last_name"])) ? $from["last_name"] : "",
                "username" => (isset($from["username"])) ? $from["username"] : "",
                "chat_id" => $chatId,
            ]);

            $applicant = $this->applicant->getByChatId($chatId);
        }

        $text = trim($text, "/");

        if($text !== "" && $chatId !== 0) {
            $routes = Config::getTelegramRoutes();
            for ($i = 0, $count = count($routes); $i < $count; $i++) {
                if(preg_match("#^" . $routes[$i]["command"] . "$#", $text)){
                    if (!class_exists($routes[$i]["controller"], true)) {
                        continue;
                    }

                    $class = $routes[$i]["controller"];

                    $obj = new $class($applicant, $messageId, $text, $input);

                    if (!method_exists($obj, $routes[$i]["action"])) {
                        continue;
                    }

                    $params = $routes[$i]["params"];

                    if(strpos($params, "$") !== false){
                        $params = preg_replace("#^" . $routes[$i]["command"] . "$#", $params, $text);
                        $params = explode("/", $params);
                    } else {
                        $params = [];
                    }

                    call_user_func_array([$obj, $routes[$i]["action"]], $params);
                }
            }
        }
    }
}