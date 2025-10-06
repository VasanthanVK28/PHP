<?php
require __DIR__ . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory; //IOFactory=> to load different file formats (xlsx,xls,csv)
use PhpOffice\PhpSpreadsheet\Reader\Csv;//Csv=> to read csv files 

if (isset($_FILES['spreadsheet']) && $_FILES['spreadsheet']['error'] === UPLOAD_ERR_OK) {
    //- contains info about the uploaded file (from an <input type="file" name="spreadsheet"> in your form).

    $filePath = $_FILES['spreadsheet']['tmp_name'];//temporary file location php stored the uploaded file on the server
    $fileName = $_FILES['spreadsheet']['name'];//array of info about the uploaded file
    $extension = pathinfo($fileName, PATHINFO_EXTENSION);//file extension

    if ($extension === 'csv') {
        // CSV reader
        $reader = new Csv();        //create Csv reader object
        // Try comma first, fallback to semicolon
        $reader->setDelimiter(',');  //assume the delimiter as a comma
        $spreadsheet = $reader->load($filePath);    //load the csv file into a spreadsheet object

        // If only one column detected, switch to semicolon
        $sheet = $spreadsheet->getActiveSheet();
        $firstRow = $sheet->rangeToArray('A1:Z1', null, true, true, true);
        if (count($firstRow[1]) === 1) {
            $reader->setDelimiter(';');
            $spreadsheet = $reader->load($filePath);
        }
    } else {
        // Excel reader (XLSX, XLS, etc.)
        $spreadsheet = IOFactory::load($filePath);
    }

    // Display data
    $sheet = $spreadsheet->getActiveSheet();
    $rows = $sheet->toArray();

    echo "<table border='1' cellpadding='5'>";
    foreach ($rows as $row) {
        echo "<tr>";
        foreach ($row as $cell) {
            echo "<td>" . htmlspecialchars($cell) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No file uploaded or upload error.";
}