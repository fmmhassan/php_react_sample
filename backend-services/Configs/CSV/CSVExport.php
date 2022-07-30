<?php
namespace Configs\CSV;
use Contracts\CSVExportContract;

class CSVExport implements CSVExportContract{
    private $exportData, $columnHeaders, $fileName;
    public function __construct($exportData) {
        $this->exportData = $exportData;
    }
    public function exportDataToCSV(){
        $delimiter = ","; 
        $filename = $this->fileName; 
        
        // Create a file pointer 
        $f = fopen('php://memory', 'w'); 
        
        // Set column headers 
        $fields = $this->columnHeaders;
        fputcsv($f, $fields, $delimiter);

        foreach($this->exportData as $row){
            $lineData = [];
            foreach($row as $columnValue){
                $lineData[] = $columnValue;
            }
            fputcsv($f, $lineData);// Set rows
        }
        fseek($f, 0); 
        fpassthru($f); 
        fclose($f);
        header('Content-Type: text/csv'); 
        header('Content-Disposition: attachment; filename="' . $filename . '";'); 
        exit;// to avoid null in last line
    }
    public function setColumnHeaders($headerData){
        $this->columnHeaders = [];
        foreach($headerData as $row){
            $this->columnHeaders[] = $row;
        }
        return $this;
    }
    public function setFileName($fileName){
        $this->fileName = $fileName;
        return $this;
    }
    

}
?>
