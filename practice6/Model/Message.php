<?php

namespace Model;

class Message extends Model {
    protected $table = "messages"; // Name of the table

    public function __construct() {
        parent::__construct();
    }
}
