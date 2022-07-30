<?php
namespace Configs\DB;
use Contracts\ModelQuery;
use Contracts\Modelimplementation;
use Configs\DB\Database;

abstract class Model implements ModelQuery,Modelimplementation{
    protected $table;
    public $pdo;
    public function __construct() {
        $this->initiateModel();
    }
    public function initiateModel(){
        $this->pdo = new Database($this->table);
    }
}
?>