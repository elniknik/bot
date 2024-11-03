<?php

namespace Model;

class Chat extends Model {
    protected $table = "chats"; // Name of the table

    public function __construct() {
        parent::__construct();
    }
}
