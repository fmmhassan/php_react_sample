<?php
namespace Configs\DB;
use PDO;

class Database {
    const DB_HOST = DB_SERVERNAME;
    const DB_NAME = DB_DATABASE;
    const DB_USER = DB_USERNAME;
    const DB_PASSWORD = DB_PASSWORD;

    /**
     * PDO instance
     * @var PDO 
     */
    private $pdo = null;
    private $selectQuery = 'SELECT * ';
    private $groupByQuery = '';
    private $where = '';
    private $table = '';


    /**
     * Open the database connection
     */
    public function __construct($table) {
        $this->table = $table;
        // open database connection
        $conStr = sprintf("mysql:host=%s;dbname=%s", self::DB_HOST, self::DB_NAME);
        try {
            $this->pdo = new PDO($conStr, self::DB_USER, self::DB_PASSWORD);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }


    /**
     * Get the wrapped PDO connection.
     *
     * @return \PDO
     */
    public function getWrappedConnection(): PDO
    {
        return $this->pdo;
    }

    /**
     * Begin a new database transaction.
     *
     * @return void
     */
    public function beginTransaction()
    {
        return $this->pdo->beginTransaction();
    }

    /**
     * Commit a database transaction.
     *
     * @return void
     */
    public function commit()
    {
        return $this->pdo->commit();
    }

    /**
     * Rollback a database transaction.
     *
     * @return void
     */
    public function rollBack()
    {
        return $this->pdo->rollBack();
    }

    /**
     * close the database connection
     */
    public function __destruct() {
        // close the database connection
        $this->pdo = null;
    }


    public function get() {
        
        $connection = $this->getWrappedConnection();
        $query = $this->selectQuery.' FROM '.$this->table.$this->where.$this->groupByQuery;
        $stmt = $connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function groupBy($params = []){
        $this->groupByQuery = '';
        if(!empty($params)){
            $this->groupByQuery = ' group by ';
            foreach($params as $paramRow){
                $this->groupByQuery .= $paramRow.', ';
            }
            $this->groupByQuery = substr($this->groupByQuery, 0, -2);
        }
        return $this;
        
    }
    
    public function select($params = []){
        $this->selectQuery = 'SELECT * ';
        if(!empty($params)){
            $this->selectQuery = 'SELECT  ';
            foreach($params as $paramKey=>$paramRow){
                $this->selectQuery .= $paramKey.' as '.$paramRow.', ';
            }
            $this->selectQuery = substr($this->selectQuery, 0, -2);
        }
        return $this;
        
    }

    public function insert($params) {
        $sql = array(); 
        $columnsArray = array_keys(reset($params));
        $columnsString = implode(', ', $columnsArray);
        
        $paramsForQuery = [];
        foreach( $params as $row ) {
            $insert_str = '(';
            foreach($row as $data){
                $insert_str .= '?, ';
                $paramsForQuery[] = $data;
            }
            $insert_str = substr($insert_str, 0, -2);
            $insert_str .= ')';
            $sql[] = $insert_str;
        }
        $connection = $this->getWrappedConnection();
        $this->beginTransaction();
        $query = 'INSERT INTO '.$this->table.' ('.$columnsString.') VALUES '.implode(',', $sql);
        $stmt = $connection->prepare($query);
        $inserted = $stmt->execute($paramsForQuery);
        $this->commit();
        return $inserted;
    }

}
