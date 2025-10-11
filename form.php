<?php
$errors = [];
//var_dump($errors); 
$values = [];
//var_dump($values);       $server is a superglobal variable that holds information about headers, paths, and script locations.
if ($_SERVER["REQUEST_METHOD"] == "POST") { // check if form is submitted in post method
  function clean($data) {
    return htmlspecialchars(trim($data));
  }

  // Firstname
  $values['username'] = clean($_POST['username']);
  if (!preg_match("/^[a-zA-Z]+$/", $values['username'])) {
    $errors['username'] = "Only letters are allowed in Firstname.";
  }
  //var_dump($values);

  // Lastname
  $values['lname'] = clean($_POST['lname']);
  if (!preg_match("/^[a-zA-Z]+$/", $values['lname'])) {
    $errors['lname'] = "Only letters are allowed in Lastname.";
  }

  // Email
  $values['email'] = clean($_POST['email']);
  if (!filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {//built email validation function
    $errors['email'] = "Invalid email format.";
  }

  // Password
  $values['password'] = $_POST['password'];
  if (strlen($values['password']) < 6) {
    $errors['password'] = "Password must be at least 6 characters.";
  }

  // Confirm Password
  $values['cpassword'] = $_POST['cpassword'];
  if ($values['password'] !== $values['cpassword']) {
    $errors['cpassword'] = "Passwords do not match.";
  }

  // Phone
  $values['phone'] = clean($_POST['phone']);
  if (!preg_match("/^[0-9]{10,15}$/", $values['phone'])) {
    $errors['phone'] = "Phone must be 10–15 digits.";
  }

  // Gender
  $values['gender'] = $_POST['gender'] ?? '';
  if (empty($values['gender'])) {
    $errors['gender'] = "Please select your gender.";
  }

  // DOB
  $values['dob'] = $_POST['dob'];
  if (empty($values['dob'])) {
    $errors['dob'] = "Please enter your date of birth.";
  }

  // Address
  $values['address'] = clean($_POST['address']);
  if (empty($values['address'])) {
    $errors['address'] = "Address is required.";
  }

  // Country
  $values['country'] = $_POST['country'] ?? '';
  if (empty($values['country'])) {
    $errors['country'] = "Please select your country.";
  }

  // Zip
  $values['zip'] = clean($_POST['zip']);
  if (!preg_match("/^[0-9]{4,10}$/", $values['zip'])) {
    $errors['zip'] = "Zip code must be 4–10 digits.";
  }

  // Website
  

  // Marital Status
  $values['status'] = $_POST['status'] ?? '';
  if (empty($values['status'])) {
    $errors['status'] = "Please select your marital status.";
  }

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

    <?php   //$name =>name of the input field , $type => type of input field, $label => label for the input field, $isTextarea => boolean to check if it's a textarea, $isSelect => boolean to check if it's a select dropdown, $options => array of options for select dropdown
    function input($name, $type = "text", $label = "", $isTextarea = false, $isSelect = false, $options = []) {
      global $values, $errors;  //pulling the values and errors array from the global scope
      $value = $values[$name] ?? '';  //get the submitted value for the input field if exists otherwise set it to empty string
      //var_dump($value); // return the value of string
      $error = $errors[$name] ?? '';  //get the error message for the input field if exists otherwise set it to empty string
      //var_dump($error); // return the value of string
      $border = $error ? 'border-red-500' : 'border-gray-300';  //set border color based on whether there's an error or not
        //var_dump($border); // return the value of string
      echo "<div class='mb-4'>";
      //var_dump($values);
      //var_dump($errors);
      echo "<label for='$name' class='block font-semibold mb-2'>$label</label>";
      if ($isTextarea) {
        echo "<textarea id='$name' name='$name' rows='4' class='w-full border $border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500'>".htmlspecialchars($value)."</textarea>";
      } elseif ($isSelect) {
        echo "<select id='$name' name='$name' class='w-full border $border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500'>";
        echo "<option value='' disabled selected>Select your $label</option>";
        foreach ($options as $opt) {  //loops through each option in the options array(eg: "Male , Female , Other" )
          $selected = $value === $opt ? 'selected' : '';  //- Checks if the current $opt matches the submitted $value → adds selected.
          //var_dump($selected); // return the value of string
          echo "<option value='$opt' $selected>".ucfirst($opt)."</option>";//- ucfirst($opt): Capitalizes the first letter (e.g., "Male")

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