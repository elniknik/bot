<?php

namespace Controller;

use \Config\Consts;
use \Helper\TelegramHelper;

class CommandController extends Controller {

    private $applicant;
    private $messageId;
    private $text;
    private $input;

    public function __construct($applicant, $messageId, $text, $input)
    {
        parent::__construct();

        $this->applicant = $applicant;
        $this->messageId = $messageId;
        $this->text = $text;
        $this->input = $input;
    }

    public function start() {
        $this->loadModel("Account", "account");
        $this->loadModel("StudyProgram", "studyProgram");

        $totalAccounts = $this->account->getTotalByapplicantId($this->applicant["id"]);
        $totalStudyProgram = $this->studyProgram->getTotal(); 
        echo "<br>".$totalStudyProgram;
        echo "<br>0";
        $buttons = [];

        if($totalStudyProgram > 0) {
            $buttons[] = [
                [
                    "text" => "Study Programs",
                    "callback_data" => "/get/programs",
                ],
            ];
        }

        $gets = [
            "text" => Consts::TELEGRAM_WELCOME_INIT,
            "chat_id" => $this->applicant["chat_id"],
        ];

        $body = [
            "reply_markup" => json_encode([
                "inline_keyboard" => $buttons,
                'one_time_keyboard' => true,
                'resize_keyboard' => true,
            ], JSON_UNESCAPED_UNICODE),
        ];

        TelegramHelper::send("sendMessage", $gets, $body);

        $gets = [
            "message_id" => $this->messageId,
            "chat_id" => $this->applicant["chat_id"],
        ];
        TelegramHelper::send("deleteMessage", $gets);
    }

    public function getPrograms() {
        $this->loadModel("StudyProgram", "studyprogram");

        $message = "Study programs:\n\n";

        $studyprograms = $this->studyprogram->getAll();

        $studyprogramsData = [];
        for ($i = 0, $count = count($studyprograms); $i < $count; $i++) {
            $studyprogramsData[(int)$studyprograms[$i]["id"]] = $studyprograms[$i];
            $message .= $studyprogramsData[(int)$studyprograms[$i]["id"]]["name"] . "\n";
        }
        

        $gets = [
            "text" => $message,
            "chat_id" => $this->applicant["chat_id"],
        ];

        $body = [
            "reply_markup" => json_encode([
                "inline_keyboard" => [
                    [
                        [
                            "text" => "Study Programs",
                            "callback_data" => "/get/programs",
                        ],
                    ]
                ],
                'one_time_keyboard' => true,
                'resize_keyboard' => true,
            ], JSON_UNESCAPED_UNICODE),
        ];

        TelegramHelper::send("sendMessage", $gets, $body);

        $gets = [
            "message_id" => $this->messageId,
            "chat_id" => $this->applicant["chat_id"],
        ];
        TelegramHelper::send("deleteMessage", $gets);
    }
}