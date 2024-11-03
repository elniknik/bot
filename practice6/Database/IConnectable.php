<?php

namespace Database;

interface IConnectable {

    public function exec($sql);

    public function prepare($value);

    public function getLastId();

    public function close();
}