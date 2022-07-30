<?php
namespace Configs\CSV;
use Contracts\CSVImportContract;

class CsvImport implements CSVImportContract{
    private $file;
    
    private $csvFileType = [
        'text/csv'
    ];

    private $columns = [];
    public function __construct($FILE) {
        $this->file = $FILE;
    }

    public function validateFile(){
        return (!empty($this->file['name']) && in_array($this->file['type'], $this->csvFileType));
    }

    public function readFile()
    {
        $csvFile = fopen($this->file['tmp_name'], 'r');
        $readArray = [];
        // Parse data from CSV file line by line
        while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE){
            $readArrayObject = [];
            foreach($this->columns as $key=>$column){
                $readArrayObject[$column] = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $getData[$key]);
            }
            $readArray[] = $readArrayObject;
        }
        // Close opened CSV file
        fclose($csvFile);
        return $readArray;
        
    }
    public function setReadColumns($columns)
    {
        $this->columns = $columns;
    }
    

}
?>