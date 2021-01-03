<?php
    include "config.php";
    include "validation.php";

    $validation_obj=new validation();

    $firstName=$lastName=$email=$year=$phone=$password=$confirm_password="";
    $errors=["firstname"=>"","lastname"=>"","email"=>"","phone"=>"","password"=>"","year"=>"","confirm_password"=>""];

    // Validating input
    if(isset($_POST["sign_up"]))
    {
    $firstName=$_POST["reg_fname"];
    $lastName=$_POST["reg_lname"];
    $email=$_POST["reg_phone"];
    $phone=$_POST["reg_username"];
    $password=$_POST["reg_pwd"];
    $confirm_password=$_POST['reg_conpwd'];
    $year=$_POST['reg_year'];

    if($validation_obj->email($email))
    $errors["email"]="Invalid email";
    else
    $errors["email"]="";

    if($validation_obj->password($password))
    $errors["password"]="Invalid password";
    else 
    $errors["password"]="";

    if($validation_obj->year($year))
    $errors["year"]="Invalid year";
    else 
    $errors["year"]="";

    if($validation_obj->phone_no($phone))
    $errors["phone"]="Invalid phone number";
    else 
    $errors["phone"]="";

    if($validation_obj->name($firstName))
    $errors["firstname"]="Invalid username";
    else 
    $errors["firstname"]="";

    if($validation_obj->name($lastName))
    $errors["lastname"]="Invalid username";
    else 
    $errors["lastname"]="";

    if($validation_obj->year($year))
    $errors["year"]="Invalid year";
    else 
    $errors["year"]="";

    if($password!=$confirm_password)
    $errors["confirm_password"]="password does not match";
    else 
    $errors["confirm_password"]="";

    $count=0;
    foreach($errors as $error)
    {
        if(empty($error))
        $count+=1;
    }

    if($count==count($errors))
    {
        echo "<script> alert 'hi'</script>";
    }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/LOGIN.css" />
    <title>Document</title>
</head>
<body>
    <ul>
        <li><a href="HOME.html">Home</a></li>
        <li><a href="NEW BOOKS.php">Books</a></li>
        <li><a href="LOGIN.html">Login</a></li>
        <li><a href="MY ACCOUNT.php">My Account</a></li>
    </ul>

    <div class="header">
    <h1 style="color: #39b7dd; font-size: 20px; font-family: Arial, Helvetica, sans-serif;margin: 20px 20px 20px 20px;">LOGIN/SIGNUP</h1>
    </div>
    <hr>
    <br><br>

    <div class="form-box">

        <div class="col-1">
            <h3 style="font-family: Arial, Helvetica, sans-serif;">Create an account</h3>
            <form id="adduser" name="adduser" action="login.php" method="post">

                <div class="col-1-1">
                    <label for="fname_register">First Name<span style="color: red;"> *</span></label>
                    <input name="reg_fname" type="text" class="form-control" required="" placeholder="Enter your first name" value="<?php echo $firstName ?>">
                    <div class="space errors"><?php echo $errors["firstname"] ?></div>
                </div>

                <div class="col-1-1">
                    <label for="lname_register">Last Name<span style="color: red;"> *</span></label>
                    <input name="reg_lname" type="text" class="form-control" required="" placeholder="Enter your second name" value="<?php echo $lastName ?>">
                    <div class="space errors"><?php echo $errors["lastname"] ?></div>
                </div>

                <div class="col-1-1">
                    <label for="emmail_register">Joined Year<span style="color: red;"> *</span></label>
                    <input name="reg_year"  type="number" class="form-control" required="" placeholder="ReType your password" value="<?php echo $year ?>">
                    <div class="space errors"><?php echo $errors["year"] ?></div>
                </div>

                <div class="col-1-1">
                    <label for="phone_register">Phone Number<span style="color: red;"> *</span></label>
                    <input name="reg_phone" maxlength="10" type="text" class="form-control" required="" placeholder="Enter your phone number" value="<?php echo $phone ?>">
                    <div class="space errors"><?php echo $errors["phone"] ?></div>
                </div>
                
                <div class="col-1-1">
                    <label for="emmail_register">Email address<span style="color: red;"> *</span></label>
                    <input name="reg_username" type="text" class="form-control" required="" placeholder="Enter your Email Id" value="<?php echo $email ?>">
                    <div class="space errors"><?php echo $errors["email"] ?></div>
                </div>
                <div class="col-1-1">
                    <label for="emmail_register">Password<span style="color: red;"> *</span></label>
                    <input name="reg_pwd" type="password" class="form-control" required="" placeholder="Enter Password (min 6 character) " value="<?php echo $password ?>">
                    <div class="space"><?php echo $errors["password"] ?></div>
                </div>

                <div class="col-1-1">
                    <label for="emmail_register">Re-enter password<span style="color: red;"> *</span></label>
                    <input name="reg_conpwd" id="reg_conpwd" type="password" class="form-control" required="" placeholder="ReType your password" value="<?php echo $confirm_password ?>">
                    <div class="space errors"><?php echo $errors["confirm_password"] ?></div>
                </div>

                <button type="submit" class="btn-l" name="sign_up">
                    Create an account
                </button>
            </form>
        </div>
    

        <div class="col-2">
                        
            <h3>Already registered? Login here</h3>
            <form id="formu2" name="loginform" action="login.php" method="post">
                
                <label for="emmail_login">Email address<span style="color: red;"> *</span></label>
                <input name="login_email" type="text" class="form-control">
                <div class="space"></div>

                <label for="password_login">Password<span style="color: red;"> *</span></label>
                <input type="password" name="login_pwd" class="form-control"> 
                <div class="space"></div>

               
                <p><a href="forgot-password.php">Forgot your password?</a></p>
                <button class="btn-l">Sign in</button>
            </form>

        </div>
    </div>
</body>
</html>