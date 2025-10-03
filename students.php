<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Marks Table</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Student Marks</h1>

        <!-- Main Table -->
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-indigo-600 text-white">
                <tr>
                    <th class="py-3 px-4 text-left">Name</th>
                    <th class="py-3 px-4 text-left">Tamil</th>
                    <th class="py-3 px-4 text-left">English</th>
                    <th class="py-3 px-4 text-left">Maths</th>
                    <th class="py-3 px-4 text-left">Physics</th>
                    <th class="py-3 px-4 text-left">Chemistry</th>
                    <th class="py-3 px-4 text-left">Total</th>
                    <th class="py-3 px-4 text-left">Grade</th>
                    <th class="py-3 px-4 text-left">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php
                function getGrade($average) {
                    if ($average >= 90) return 'A+';
                    elseif ($average >= 80) return 'A';
                    elseif ($average >= 70) return 'B';
                    elseif ($average >= 60) return 'C';
                    elseif ($average >= 50) return 'D';
                    else return 'F';
                    //var_dump ($average);
                }

                $students = [
                    ['name' => 'Alice',   'marks' => ['Tamil'=>80, 'English'=>90, 'Maths'=>85, 'Physics'=>75, 'Chemistry'=>60]],
                    ['name' => 'Bob',     'marks' => ['Tamil'=>30, 'English'=>20, 'Maths'=>55, 'Physics'=>20, 'Chemistry'=>45]],
                    ['name' => 'Charlie', 'marks' => ['Tamil'=>90, 'English'=>95, 'Maths'=>85, 'Physics'=>80, 'Chemistry'=>70]],
                    ['name' => 'David',   'marks' => ['Tamil'=>30, 'English'=>55, 'Maths'=>30, 'Physics'=>35, 'Chemistry'=>80]],
                    ['name' => 'Eve',     'marks' => ['Tamil'=>35, 'English'=>20, 'Maths'=>30, 'Physics'=>35, 'Chemistry'=>10]],
                    ['name' => 'Frank',   'marks' => ['Tamil'=>55, 'English'=>60, 'Maths'=>65, 'Physics'=>70, 'Chemistry'=>75]],
                    ['name' => 'Grace',   'marks' => ['Tamil'=>15, 'English'=>20, 'Maths'=>35, 'Physics'=>40, 'Chemistry'=>15]],
                    ['name' => 'Heidi',   'marks' => ['Tamil'=>70, 'English'=>75, 'Maths'=>80, 'Physics'=>85, 'Chemistry'=>90]],
                    ['name' => 'Ivan',    'marks' => ['Tamil'=>60, 'English'=>70, 'Maths'=>80, 'Physics'=>90, 'Chemistry'=>100]],
                    ['name' => 'Judy',    'marks' => ['Tamil'=>12,'English'=>55, 'Maths'=>33, 'Physics'=>30, 'Chemistry'=>20]]
                ];
                //echo "<pre>";       
                //var_dump($students);        // array structure display like key and value pairs
               // echo "</pre>";
                $pass_students = [];
                $fail_students = [];
                    //var_dump($pass_students); array (0)empty value
                    //var_dump($fail_students);

                foreach ($students as $student) {
                    $marks = $student['marks'];
                    //echo "<pre>";
                    //var_dump($marks);  // to display only marks of each student in an array format key and value pairs
                    //echo "</pre>";
                    $total = array_sum($marks);
                    //var_dump($total);   // to display total marks of each student
                    $average = $total / count($marks);
                    //var_dump($average); // to display average marks of each student
                    $grade = getGrade($average);
                    //var_dump($grade)."<br>";   // to display grade of each student like a string value
                    $status = ($average >= 50) ? 'Pass' : 'Fail';
                    //var_dump($status)."<br>";  // to display status of each student like a string value
                    $student['total'] = $total;
                    //var_dump($total)."<br>"; // to display total marks of each student
                    $student['grade'] = $grade;
                    //var_dump($grade)."<br>"; // to display grade of each student
                    $student['status'] = $status;
                    //var_dump($status)."<br>"; // to display status of each student
                    if ($status === 'Pass') {
                        $pass_students[] = $student;
                    } else {
                        $fail_students[] = $student;
                    }
                    //echo "<pre>";
                    //var_dump($students);  // to display all details of each student in an array format
                    //echo "</pre>";

                    echo "<tr>";
                    echo "<td class='py-2 px-4 font-medium text-gray-700'>{$student['name']}</td>";
                    foreach ($marks as $mark) {
                        echo "<td class='py-2 px-4 text-gray-600'>{$mark}</td>";
                    }
                    //echo"<pre>";
                    //var_dump($mark);
                    //echo "</pre>";
                    echo "<td class='py-2 px-4 text-gray-600'>{$total}</td>";
                    //var_dump($total);   //display the integer
                    echo "<td class='py-2 px-4 text-gray-600 font-semibold'>{$grade}</td>";//display the string
                    //var_dump($grade);
                    echo "<td class='py-2 px-4 text-" . ($status === 'Pass' ? 'green' : 'red') . "-600 font-semibold'>{$status}</td>";
                    echo "</tr>";
                    //echo "<pre>";
                    //var_dump($status);
                }
                ?>
            </tbody>
        </table>

        <!-- Pass Students Table using for loop -->
        <h2 class="text-2xl font-bold mt-10 mb-4 text-green-700">Pass Students</h2>
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden mb-10">
            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="py-3 px-4 text-left">Name</th>
                    <th class="py-3 px-4 text-left">Total</th>
                    <th class="py-3 px-4 text-left">Grade</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php
                for ($i = 0; $i < count($pass_students); $i++) {
                    echo "<tr>";
                    //echo"<pre>";  count return number of elements in an array(5) count return int datatypes
                    //var_dump(count($pass_students)); // to display index value of each pass student
                    echo "<td class='py-2 px-4 text-gray-700 font-medium'>{$pass_students[$i]['name']}</td>";
                    echo "<td class='py-2 px-4 text-gray-600'>{$pass_students[$i]['total']}</td>";
                    echo "<td class='py-2 px-4 text-gray-600 font-semibold'>{$pass_students[$i]['grade']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Fail Students Table using while loop -->
        <h2 class="text-2xl font-bold mb-4 text-red-700">Fail Students</h2>
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-red-600 text-white">
                <tr>
                    <th class="py-3 px-4 text-left">Name</th>
                    <th class="py-3 px-4 text-left">Total</th>
                    <th class="py-3 px-4 text-left">Grade</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php
                $j = 0;
                //var_dump($j);
                while ($j < count($fail_students)) {
                    echo "<tr>";
                    //echo"<pre>";
                    //var_dump($j); to display index value of each fail students
                    echo "<td class='py-2 px-4 text-gray-700 font-medium'>{$fail_students[$j]['name']}</td>";
                    echo "<td class='py-2 px-4 text-gray-600'>{$fail_students[$j]['total']}</td>";
                    echo "<td class='py-2 px-4 text-gray-600 font-semibold'>{$fail_students[$j]['grade']}</td>";
                    echo "</tr>";
                    $j++;
                }
                ?>
            </tbody>
        </table>

        <!-- Grade Selection for all students -->

         <h2 class="text-2xl font-bold mb-4 text-gray-700">Grade</h2>
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <tbody class="divide-y divide-gray-200">
                <?php
        $graded_students = array_merge($pass_students, $fail_students);
        echo "<pre>";
        //var_dump($graded_students); // to display all details of each student in an array format
        echo "<table class='min-w-full bg-white shadow-md rounded-lg overflow-hidden'>";
echo "<thead class='bg-gray-600 text-white'>";
echo "<tr><th class='py-3 px-4 text-left'>Name</th><th class='py-3 px-4 text-left'>Grade</th></tr>";
echo "</thead><tbody class='divide-y divide-gray-200'>";

foreach ($graded_students as $student) {
    echo "<tr>";
    echo "<td class='py-2 px-4 text-gray-700 font-medium'>{$student['name']}</td>";
          //echo"<pre>";
        //var_dump($student['name']);

    switch ($student['grade']) {
        case 'A+':
            echo "<td class='py-2 px-4 text-green-600 font-semibold'>{$student['grade']}</td>";
            break;
        case 'A':
            echo "<td class='py-2 px-4 text-blue-600 font-semibold'>{$student['grade']}</td>";
            break;
        case 'B':
            echo "<td class='py-2 px-4 text-indigo-600 font-semibold'>{$student['grade']}</td>";
            break;
        case 'C':
            echo "<td class='py-2 px-4 text-yellow-600 font-semibold'>{$student['grade']}</td>";
            break;
        case 'D':
            echo "<td class='py-2 px-4 text-orange-600 font-semibold'>{$student['grade']}</td>";
            break;
        case 'F':
            echo "<td class='py-2 px-4 text-red-600 font-semibold'>{$student['grade']}</td>";
            break;
        default:
            echo "<td class='py-2 px-4 text-gray-600 font-semibold'>{$student['grade']}</td>";
    }

    echo "</tr>";
}
echo "</tbody></table>";
             ?>       
    </div>
</body>
</html>
<?php 
        