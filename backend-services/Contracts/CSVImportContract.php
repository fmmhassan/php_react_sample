<?php
namespace Contracts;
interface  CSVImportContract{
    public function validateFile();
    public function readFile();
    public function setReadColumns($columns);
}
?>