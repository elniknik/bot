<?php 

namespace Config;

class Config {

    private function __construct()
    {
    }

    public static function getDatabase() {
        return [
            "class" => "\\Database\\MysqlConnect",
            "host" => "localhost",
            "database" => "abit3",
            "port" => 3306,
            "username" => "root",
            "password" => "",
            "charset" => "utf8mb4",
        ];
    }

    public static function getRoutes() {
        return [
            "GET" => [
                [
                    "uri" => "",
                    "controller" => "\\Controller\\HomeController",
                    "action" => "index",
                    "params" => "",
                ], [
                    "uri" => "auth/telegram",
                    "controller" => "\\Controller\\ApplicantController",
                    "action" => "auth",
                    "params" => "",
                ], [
                    "uri" => "logout",
                    "controller" => "\\Controller\\ApplicantCabinetController",
                    "action" => "logout",
                    "params" => "",
                ], [
                    "uri" => "cabinet",
                    "controller" => "\\Controller\\ApplicantCabinetController",
                    "action" => "index",
                    "params" => "",
                ], [
                    "uri" => "webhook/telegram",
                    "controller" => "\\Controller\\TelegramController",
                    "action" => "index",
                    "params" => "",
                ],
                // API routes for applicants
                [
                    "uri" => "api/applicants",
                    "controller" => "\\Controller\\ApplicantController",
                    "action" => "getAll",
                    "params" => "",
                ], [
                    "uri" => "api/applicants/{id}",
                    "controller" => "\\Controller\\ApplicantController",
                    "action" => "getById",
                    "params" => "{id}",
                ],
                [
                    "uri" => "api/consultants",
                    "controller" => "\\Controller\\ConsultantController",
                    "action" => "getAll",
                    "params" => "",
                ], [
                    "uri" => "api/consultants/{id}",
                    "controller" => "\\Controller\\ConsultantController",
                    "action" => "getById",
                    "params" => "{id}",
                ],
                [
                    "uri" => "api/chats",
                    "controller" => "\\Controller\\ChatController",
                    "action" => "getAll",
                    "params" => "",
                ], [
                    "uri" => "api/chats/{id}",
                    "controller" => "\\Controller\\ChatController",
                    "action" => "getById",
                    "params" => "{id}",
                ],
                [
                    "uri" => "api/messages",
                    "controller" => "\\Controller\\MessageController",
                    "action" => "getAll",
                    "params" => "",
                ], [
                    "uri" => "api/messages/{id}",
                    "controller" => "\\Controller\\MessageController",
                    "action" => "getById",
                    "params" => "{id}",
                ],
                [
                    "uri" => "api/faculties",
                    "controller" => "\\Controller\\FacultyController",
                    "action" => "getAll",
                    "params" => "",
                ], [
                    "uri" => "api/faculties/{id}",
                    "controller" => "\\Controller\\FacultyController",
                    "action" => "getById",
                    "params" => "{id}",
                ],
                [
                    "uri" => "api/programs",
                    "controller" => "\\Controller\\ProgramController",
                    "action" => "getAll",
                    "params" => "",
                ], [
                    "uri" => "api/programs/{id}",
                    "controller" => "\\Controller\\ProgramController",
                    "action" => "getById",
                    "params" => "{id}",
                ],
                [
                    "uri" => "api/applications",
                    "controller" => "\\Controller\\ApplicationController",
                    "action" => "getAll",
                    "params" => "",
                ], [
                    "uri" => "api/applications/{id}",
                    "controller" => "\\Controller\\ApplicationController",
                    "action" => "getById",
                    "params" => "{id}",
                ],
                [
                    "uri" => "api/exams",
                    "controller" => "\\Controller\\ExamController",
                    "action" => "getAll",
                    "params" => "",
                ], [
                    "uri" => "api/exams/{id}",
                    "controller" => "\\Controller\\ExamController",
                    "action" => "getById",
                    "params" => "{id}",
                ],
            ],
            "POST" => [
                [
                    "uri" => "webhook/telegram",
                    "controller" => "\\Controller\\TelegramController",
                    "action" => "index",
                    "params" => "",
                ],
                // API POST routes
                [
                    "uri" => "api/applicants",
                    "controller" => "\\Controller\\ApplicantController",
                    "action" => "create",
                    "params" => "",
                ], [
                    "uri" => "api/consultants",
                    "controller" => "\\Controller\\ConsultantController",
                    "action" => "create",
                    "params" => "",
                ], [
                    "uri" => "api/chats",
                    "controller" => "\\Controller\\ChatController",
                    "action" => "create",
                    "params" => "",
                ], [
                    "uri" => "api/messages",
                    "controller" => "\\Controller\\MessageController",
                    "action" => "create",
                    "params" => "",
                ], [
                    "uri" => "api/faculties",
                    "controller" => "\\Controller\\FacultyController",
                    "action" => "create",
                    "params" => "",
                ], [
                    "uri" => "api/programs",
                    "controller" => "\\Controller\\ProgramController",
                    "action" => "create",
                    "params" => "",
                ], [
                    "uri" => "api/applications",
                    "controller" => "\\Controller\\ApplicationController",
                    "action" => "create",
                    "params" => "",
                ], [
                    "uri" => "api/exams",
                    "controller" => "\\Controller\\ExamController",
                    "action" => "create",
                    "params" => "",
                ],
            ],
            "PUT" => [
                // API PUT routes
                [
                    "uri" => "api/applicants/{id}",
                    "controller" => "\\Controller\\ApplicantController",
                    "action" => "update",
                    "params" => "{id}",
                ], [
                    "uri" => "api/consultants/{id}",
                    "controller" => "\\Controller\\ConsultantController",
                    "action" => "update",
                    "params" => "{id}",
                ], [
                    "uri" => "api/faculties/{id}",
                    "controller" => "\\Controller\\FacultyController",
                    "action" => "update",
                    "params" => "{id}",
                ], [
                    "uri" => "api/programs/{id}",
                    "controller" => "\\Controller\\ProgramController",
                    "action" => "update",
                    "params" => "{id}",
                ], [
                    "uri" => "api/applications/{id}",
                    "controller" => "\\Controller\\ApplicationController",
                    "action" => "update",
                    "params" => "{id}",
                ], [
                    "uri" => "api/exams/{id}",
                    "controller" => "\\Controller\\ExamController",
                    "action" => "update",
                    "params" => "{id}",
                ],
            ],
            "DELETE" => [
                // API DELETE routes
                [
                    "uri" => "api/applicants/{id}",
                    "controller" => "\\Controller\\ApplicantController",
                    "action" => "delete",
                    "params" => "{id}",
                ], [
                    "uri" => "api/consultants/{id}",
                    "controller" => "\\Controller\\ConsultantController",
                    "action" => "delete",
                    "params" => "{id}",
                ], [
                    "uri" => "api/chats/{id}",
                    "controller" => "\\Controller\\ChatController",
                    "action" => "delete",
                    "params" => "{id}",
                ], [
                    "uri" => "api/messages/{id}",
                    "controller" => "\\Controller\\MessageController",
                    "action" => "delete",
                    "params" => "{id}",
                ], [
                    "uri" => "api/faculties/{id}",
                    "controller" => "\\Controller\\FacultyController",
                    "action" => "delete",
                    "params" => "{id}",
                ], [
                    "uri" => "api/programs/{id}",
                    "controller" => "\\Controller\\ProgramController",
                    "action" => "delete",
                    "params" => "{id}",
                ], [
                    "uri" => "api/applications/{id}",
                    "controller" => "\\Controller\\ApplicationController",
                    "action" => "delete",
                    "params" => "{id}",
                ], [
                    "uri" => "api/exams/{id}",
                    "controller" => "\\Controller\\ExamController",
                    "action" => "delete",
                    "params" => "{id}",
                ],
            ],
            "CONSOLE" => [
                [
                    "uri" => "remove/auth/innactive",
                    "controller" => "\\Controller\\ConsoleController",
                    "action" => "removeAuth",
                    "params" => "",
                ],
            ],
        ];
    }
}
