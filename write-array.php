<?php
require __DIR__ . '/vendor/autoload.php';   //Load Php Spreadsheet library

use PhpOffice\PhpSpreadsheet\Spreadsheet;   //use=> import the classes.
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;   //xlsx=> Excel file format

// -----------------------------
// Step 1: Define student dataset
// -----------------------------
$data = [       
    ["id" => 1, "name" => "Arun Kumar",    "age" => 18, "roll_no" => "R001"],
    ["id" => 2, "name" => "Bala Murugan",  "age" => 19, "roll_no" => "R002"],
    ["id" => 3, "name" => "Chitra Devi",   "age" => 18, "roll_no" => "R003"],
    ["id" => 4, "name" => "Deepak Raj",    "age" => 20, "roll_no" => "R004"],
    ["id" => 5, "name" => "Esha Rani",     "age" => 19, "roll_no" => "R005"],
    ["id" => 6, "name" => "Farhan Ali",    "age" => 18, "roll_no" => "R006"],
    ["id" => 7, "name" => "Geetha Lakshmi","age" => 20, "roll_no" => "R007"],
    ["id" => 8, "name" => "Hari Prasad",   "age" => 19, "roll_no" => "R008"],
    ["id" => 9, "name" => "Indhu Priya",   "age" => 18, "roll_no" => "R009"],
    ["id" => 10,"name" => "Jagan Mohan",   "age" => 21, "roll_no" => "R010"],
    ["id" => 11,"name" => "Kavya Sri",     "age" => 19, "roll_no" => "R011"],
    ["id" => 12,"name" => "Lokesh Kumar",  "age" => 20, "roll_no" => "R012"],
    ["id" => 13,"name" => "Meena Devi",    "age" => 18, "roll_no" => "R013"],
    ["id" => 14,"name" => "Naveen Raj",    "age" => 19, "roll_no" => "R014"],
    ["id" => 15,"name" => "Oviya Rani",    "age" => 20, "roll_no" => "R015"],
    ["id" => 16,"name" => "Prakash",       "age" => 21, "roll_no" => "R016"],
    ["id" => 17,"name" => "Queeny",        "age" => 18, "roll_no" => "R017"],
    ["id" => 18,"name" => "Ramesh",        "age" => 19, "roll_no" => "R018"],
    ["id" => 19,"name" => "Swathi",        "age" => 20, "roll_no" => "R019"],
    ["id" => 20,"name" => "Tharun",        "age" => 21, "roll_no" => "R020"],
];

// -----------------------------
// Step 2: Create spreadsheet
// -----------------------------
$spreadsheet = new Spreadsheet();   //Create new Excel Spreadsheet workbook
$sheet = $spreadsheet->getActiveSheet();    //get the default active sheet getActiveSheet is a method
        //method calling on spreadsheet object
// -----------------------------
// Step 3: Add headers
// -----------------------------
$sheet->setCellValue('A1', 'ID');       //Set cell A1 with value 'ID'
$sheet->setCellValue('B1', 'Name');     //Set cell B1 with value 'Name'
$sheet->setCellValue('C1', 'Age');      //Set cell C1 with value 'Age'
$sheet->setCellValue('D1', 'Roll No');  //Set cell D1 with value 'Roll No'

// Make header bold
$sheet->getStyle('A1:D1')->getFont()->setBold(true);    //getStyle is a method =>style object
                                        //setBold()true => bold text
                                        //setBold()false => normal text
// -----------------------------
// Step 4: Write student data
// -----------------------------
$row = 2; // Start from row 2 (below headers)
foreach ($data as $student) {
    $sheet->setCellValue("A{$row}", $student['id']);
    $sheet->setCellValue("B{$row}", $student['name']);
    $sheet->setCellValue("C{$row}", $student['age']);
    $sheet->setCellValue("D{$row}", $student['roll_no']);
    $row++;
}

// Auto-size columns for neat layout
foreach (range('A', 'D') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// -----------------------------
// Step 5: Output to browser
// -----------------------------
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="students.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;