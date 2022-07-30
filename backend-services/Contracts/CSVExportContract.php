<?php
namespace Contracts;
interface CSVExportContract{
    public function exportDataToCSV();
    public function setColumnHeaders($headerData);
    public function setFileName($fileName);
}
?>