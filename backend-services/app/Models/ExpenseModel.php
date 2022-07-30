<?php
namespace App\Models;
use Configs\DB\Model;

class ExpenseModel extends Model{
    
    protected $table = 'expenses';
    public function insert($params = []){
        $results = $this->pdo->insert($params);
        return $this->get();
    }

    public function get(){
        return $this->pdo->get();
    }

    public function getGroupByCategory(){
        $results = $this->pdo
        ->select([
            'category' => 'Category',
            'SUM(unit_price*qty)' => 'Amount'
        ])
        ->groupBy(['category'])
        ->get();
        return $results;
    }
}      

?>