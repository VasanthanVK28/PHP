<?php
$errors = [];
$values = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize helper
    function clean($data) {
        return htmlspecialchars(trim($data));
    }

    // Raw inputs
    $raw = [  //holds the raw input values from the submitted  form
        'username'  => $_POST['username'] ?? '',
        'lname'     => $_POST['lname'] ?? '',
        'email'     => $_POST['email'] ?? '',
        'password'  => $_POST['password'] ?? '',
        'cpassword' => $_POST['cpassword'] ?? '',
        'phone'     => $_POST['phone'] ?? '',
        'gender'    => $_POST['gender'] ?? '',
        'dob'       => $_POST['dob'] ?? '',
        'address'   => $_POST['address'] ?? '',
        'country'   => $_POST['country'] ?? '',
        'zip'       => $_POST['zip'] ?? '',
        'status'    => $_POST['status'] ?? '',
    ];
    //echo"<pre>";
   //var_dump($raw);
    // Sanitize all values at once
    $values = array_map('clean', $raw); //holds the sanitized values after applying the clean function to each element of the $raw array
    //echo"<pre>";
    //var_dump($values);
    // Required fields
    $required = ['username','lname','email','gender','dob','address','country','status','password','cpassword','phone','zip'];
    $missing = array_filter($required, fn($field) => empty($values[$field]));
    //var_dump($missing);
    foreach ($missing as $field) {
        $errors[$field] = ucfirst($field) . " is required.";
    }
    //var_dump($errors);
    // Regex validations
    if ($values['username'] && !preg_match("/^[a-zA-Z]+$/", $values['username'])) {
        $errors['username'] = "Only letters are allowed in Firstname.";
    }
    if ($values['lname'] && !preg_match("/^[a-zA-Z]+$/", $values['lname'])) {
        $errors['lname'] = "Only letters are allowed in Lastname.";
    }
    if ($values['phone'] && !preg_match("/^[0-9]{10,15}$/", $values['phone'])) {
        $errors['phone'] = "Phone must be 10–15 digits.";
    }
    if ($values['zip'] && !preg_match("/^[0-9]{4,10}$/", $values['zip'])) {
        $errors['zip'] = "Zip code must be 4–10 digits.";
    }

    // Email
    if ($values['email'] && !filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    // Password
    if ($values['password'] && strlen($values['password']) < 6) {
        $errors['password'] = "Password must be at least 6 characters.";
    }
    if ($values['password'] !== $values['cpassword']) {
        $errors['cpassword'] = "Passwords do not match.";
    }

    // Dropdown whitelists with array_search
    $allowedGender  = ['male','female','other'];
    $allowedCountry = ['usa','uk','canada','australia'];
    //var_dump($allowedCountry);
    $allowedStatus  = ['single','married','divorced'];
      //array_search = > ($needle, $haystack, true or false)
    if ($values['gender'] && array_search($values['gender'], $allowedGender, true) === false) {
        $errors['gender'] = "Invalid gender selected.";
    }
    if ($values['country'] && array_search($values['country'], $allowedCountry, true) === false) {
        $errors['country'] = "Invalid country selected.";
    }
    if ($values['status'] && array_search($values['status'], $allowedStatus, true) === false) {
        $errors['status'] = "Invalid marital status selected.";
    }
      //array_search is used to once the value is found in the array , it returns the index of the found value. if not found it returns false
    // Terms
    if (empty($_POST['terms'])) {
        $errors['terms'] = "You must accept the terms and conditions.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Form Validation</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">
  <h2 class="text-2xl font-bold text-center mb-6">User Registration Form</h2>
  <form class="bg-white max-w-xl mx-auto p-8 rounded-lg shadow-md" method="POST">

    <?php
    // Reusable input generator
    function input($name, $type = "text", $label = "", $isTextarea = false, $isSelect = false, $options = []) {
      global $values, $errors;
      $value = $values[$name] ?? '';
      $error = $errors[$name] ?? '';
      //var_dump($value);
      //var_dump($error);
      $border = $error ? 'border-red-500' : 'border-gray-300';

      echo "<div class='mb-4'>";
      echo "<label for='$name' class='block font-semibold mb-2'>$label</label>";

      if ($isTextarea) {
        echo "<textarea id='$name' name='$name' rows='4' class='w-full border $border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500'>".htmlspecialchars($value)."</textarea>";
      } elseif ($isSelect) {
        echo "<select id='$name' name='$name' class='w-full border $border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500'>";
        echo "<option value='' disabled ".($value===''?'selected':'').">Select your $label</option>";
        foreach ($options as $opt) {
          $selected = $value === $opt ? 'selected' : '';
          echo "<option value='$opt' $selected>".ucfirst($opt)."</option>";
        }
        echo "</select>";
      } else {
        echo "<input type='$type' id='$name' name='$name' value='".htmlspecialchars($value)."' class='w-full border $border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500' />";
      }

      if ($error) echo "<p class='text-red-500 text-sm mt-2'>$error</p>";
      echo "</div>";
    }

    input("username", "text", "Firstname:");
    input("lname", "text", "Lastname:");
    input("email", "email", "Email:");
    input("password", "password", "Password:");
    input("cpassword", "password", "Confirm Password:");
    input("phone", "text", "Phone:");
    input("gender", "select", "Gender:", false, true, ["male", "female", "other"]);
    input("dob", "date", "Date of Birth:");
    input("address", "text", "Address:", true);
    input("country", "select", "Country:", false, true, ["usa", "uk", "canada", "australia"]);
    input("zip", "text", "Zip Code:");
    input("status", "select", "Marital Status:", false, true, ["single", "married", "divorced"]);
    ?>

    <!-- Terms -->
    <div class="mb-6">
      <label class="inline-flex items-center">
        <input type="checkbox" id="terms" name="terms" class="mr-2" <?php if (!empty($_POST['terms'])) echo 'checked'; ?>>
        <span class="text-sm">Accept Terms and Conditions</span>
      </label>
      <?php if (isset($errors['terms'])): ?>
        <p class="text-red-500 text-sm mt-2"><?php echo $errors['terms']; ?></p>
      <?php endif; ?>
    </div>

    <!-- Submit -->
    <div class="text-center">
      <input type="submit" value="Submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 cursor-pointer" />
    </div>

    <!-- Success Message -->
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($errors)): ?>
      <p class="text-green-600 font-semibold text-center mt-4">
         Registration successful! Your form has been submitted.
      </p>
    <?php endif; ?>
  </form>
</body>
</html>