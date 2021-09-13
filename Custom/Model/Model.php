<?php
namespace Framework\Model;

use Framework\Helpers\Libraries\Database;

class Model {
    private string $table;
    private string $sql;

    public function __construct(string $sql = '') {
        Database::connect();
        $this->sql = $sql;
        $this->table = conCat(preg_replace('/.*\\\\/m', '', static::class), 's');
        $this->table = strtolower($this->table);
    }

    public function latest() {
        return new static;
    }

    public function where(string $key, string $opreator, string $condition) {
        $this->sql .= conCat(' WHERE ', $key, " $opreator ", "\"$condition\"");

        return new static($this->sql);
    }

    public function get() {
        return Database::prepare(conCat('SELECT * FROM ', $this->table, $this->sql));
    }
}
