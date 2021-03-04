<?php
include "config.php";
include "validation.php";

$validation_obj = new validation();

$firstName = $lastName = $email = $year = $phone = $password = $confirm_password = "";
$login_email = $login_password = "";
$errors = ["firstname" => "", "lastname" => "", "email" => "", "phone" => "", "password" => "", "year" => "", "confirm_password" => "", "login_email" => "", "login_password" => ""];

// Validating input for signup
if (isset($_POST["sign_up"])) {

    $firstName = $_POST["reg_fname"];
    $lastName = $_POST["reg_lname"];
    $email = $_POST["reg_username"];
    $phone = $_POST["reg_phone"];
    $password = $_POST["reg_pwd"];
    $confirm_password = $_POST['reg_conpwd'];
    $year = $_POST['reg_year'];

    // Validating email
    if ($validation_obj->email($email))
        $errors["email"] = "Invalid email";
    else
        $errors["email"] = "";

    // Validating password
    if ($validation_obj->password($password))
        $errors["password"] = "Invalid password";
    else
        $errors["password"] = "";

    // Validating joined year
    if ($validation_obj->year($year))
        $errors["year"] = "Invalid year";
    else
        $errors["year"] = "";

    // Validating phone number
    if ($validation_obj->phone_no($phone))
        $errors["phone"] = "Invalid phone number";
    else
        $errors["phone"] = "";

    // Validating firstname
    if ($validation_obj->name($firstName))
        $errors["firstname"] = "Invalid username";
    else
        $errors["firstname"] = "";

    // Validating lastname
    if ($validation_obj->name($lastName))
        $errors["lastname"] = "Invalid username";
    else
        $errors["lastname"] = "";

    // Checking password
    if ($password != $confirm_password)
        $errors["confirm_password"] = "password does not match";
    else
        $errors["confirm_password"] = "";

    $count = 0;
    foreach ($errors as $error) {
        if (empty($error))
            $count += 1;
    }

    // Checking if user exists
    if ($validation_obj->user_exists($email, "login_details", $conn))
        $count += 1;
    else
        $errors["email"] = "An user with this email already exists";

    if ($count == count($errors) + 1) {
        $name = $firstName . " " . $lastName;
        // Inserting values into the table
        $query = "INSERT INTO login_details(u_name,u_email,u_password,u_phoneno,u_joined_year) VALUES('$name','$email','$password',$phone,$year)";
        $query_result = mysqli_query($conn, $query);

        // Checking query executed successfully
        if ($query_result) {
            header("Location:old_books.php");
            session_start();
            $_SESSION['email'] = $email;
        }
    }
}

// Login
if (isset($_POST['login_in'])) {
    $login_email = $_POST['login_email'];
    $login_password = $_POST['login_pwd'];

    if ($login_email == "admin" && $login_password == "admin")
        header("Location:admin/a_home.php");

    // Validating email
    if ($validation_obj->email($login_email))
        $errors["login_email"] = "Invalid email";
    else
        $errors["login_email"] = "";

    // Validating password
    if ($validation_obj->password($login_password))
        $errors["login_password"] = "Invalid password";
    else
        $errors["login_password"] = "";

    // Checking if user exists with the password
    if ($errors["login_email"] == "" && $errors["login_password"] == "") {
        $query_result = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM login_details WHERE u_email='$login_email' and u_password='$login_password'"));

        if ($query_result[0] == 1) {
            header("Location:old_books.php");
            session_start();
            $_SESSION['email'] = $login_email;
        } else
            $errors["login_email"] = "An user with this email or password does not    exists";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/login.css" />
    <title>Document</title>
</head>

<body>

    <div class="header">
        <h1 style="color: #39b7dd; font-size: 20px; font-family: Arial, Helvetica, sans-serif;margin: 20px 20px 0px 20px;">LOGIN/SIGNUP</h1>
        <hr>
    </div>

    <div class="form-box">

        <div class="col-1">
            <h3 style="font-family: Arial, Helvetica, sans-serif;">Create an account</h3>
            <form id="adduser" name="adduser" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

                <div class="col-1-1">
                    <label for="fname_register">First Name<span style="color: red;"> *</span></label>
                    <input name="reg_fname" type="text" class="form-control" required="" placeholder="Enter your first name" value="<?php echo $firstName ?>">
                    <p class="space errors"><?php echo $errors["firstname"] ?></p>
                </div>

                <div class="col-1-1">
                    <label for="lname_register">Last Name<span style="color: red;"> *</span></label>
                    <input name="reg_lname" type="text" class="form-control" required="" placeholder="Enter your second name" value="<?php echo $lastName ?>">
                    <p class="space errors"><?php echo $errors["lastname"] ?></p>
                </div>

                <div class="col-1-1">
                    <label for="emmail_register">Joined Year<span style="color: red;"> *</span></label>
                    <input name="reg_year" type="number" class="form-control" required="" placeholder="Enter your joined year" value="<?php echo $year ?>">
                    <p class="space errors"><?php echo $errors["year"] ?></p>
                </div>

                <div class="col-1-1">
                    <label for="phone_register">Phone Number<span style="color: red;"> *</span></label>
                    <input name="reg_phone" maxlength="10" type="number" class="form-control" required="" placeholder="Enter your phone number" value="<?php echo $phone ?>">
                    <p class="space errors"><?php echo $errors["phone"] ?></p>
                </div>

                <div class="col-1-1">
                    <label for="emmail_register">Email address<span style="color: red;"> *</span></label>
                    <input name="reg_username" type="text" class="form-control" required="" placeholder="Enter your Email Id" value="<?php echo $email ?>">
                    <p class="space errors"><?php echo $errors["email"] ?></p>
                </div>
                <div class="col-1-1">
                    <label for="emmail_register">Password<span style="color: red;"> *</span></label>
                    <input name="reg_pwd" type="password" class="form-control" required="" placeholder="Enter Password (min 6 character) " value="<?php echo $password ?>">
                    <p class="space"><?php echo $errors["password"] ?></p>
                </div>

                <div class="col-1-1">
                    <label for="emmail_register">Re-enter password<span style="color: red;"> *</span></label>
                    <input name="reg_conpwd" id="reg_conpwd" type="password" class="form-control" required="" placeholder="ReType your password" value="<?php echo $confirm_password ?>">
                    <p class="space errors"><?php echo $errors["confirm_password"] ?></p>
                </div>

                <button type="submit" class="btn-l" name="sign_up">
                    Create an account
                </button>
            </form>
        </div>


        <div class="col-2">

            <h3>Already registered? Login here</h3>
            <form id="formu2" name="loginform" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">

                <label for="emmail_login">Email address<span style="color: red;"> *</span></label>
                <input name="login_email" type="text" class="form-control" value="<?php echo $login_email ?>">
                <p class="space errors"><?php echo $errors["login_email"] ?></p>

                <label for="password_login">Password<span style="color: red;"> *</span></label>
                <input type="password" name="login_pwd" class="form-control" value="<?php echo $login_password ?>">
                <p class="space errors"><?php echo $errors["login_password"] ?></p>


                <p><a href="forgot-password.php">Forgot your password?</a></p>
                <button class="btn-l" type="submit" name="login_in">Login in</button><br><br><br><br><br><br><br><br>
                <input type="button" value="BACK" class="btn-back" style="font-size: 15px;padding: 10px 10px 10px 10px; color: white;font-weight: bold; background: black;width: 15%;float: right;border-radius: 10px;cursor: pointer;border: 5px solid #fff;" ; onclick="history.back()">
            </form>

        </div>
    </div>
</body>

</html>