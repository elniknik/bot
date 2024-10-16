<?php
/*

Classes:
1. Описують сутність у загальному вигляді
2. Повинен описувати одну і тільки одну сутність
*/

class User {
    private $firstname;
    private $dateBirth;
    private $email;
    private $password;
    private $info;

    public function __construct($user)
    {
        $this->firstname = $user["firstname"];
        $this->dateBirth = $user["dateBirth"];
        $this->email = $user["email"];
        $this->password = $user["password"];
        $this->info = $user["info"];
    }

    public function isAuth($email, $password) {
        return $email === $this->email && $password === $this->password;
    }

    public function getInfo() {
        return $this->info;
    }
}

if(!isset($_GET["email"]) || !isset($_GET["password"])) {
    exit();
}

$users = [
    new User([
        "firstname" => "Alex",
        "dateBirth" => "1995-01-02",
        "password" => "qwerty",
        "email" => "alex@email.com",
        "info" => "1111111111"
    ]),
    new User([
        "firstname" => "Alex",
        "dateBirth" => "1995-01-02",
        "password" => "ytrew",
        "email" => "alex@email.com",
        "info" => "22222"
    ]),
];

for($i = 0, $count = count($users); $i < $count; $i++) {
    if($users[$i]->isAuth()) {
        echo $users[$i]->getInfo();
    }
}
