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
    $email=$_POST["reg_username"];
    $phone=$_POST["reg_phone"];
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

    // Checking if user exists
    if($validation_obj->user_exists($email,"login_details",$conn))
    $count+=1;
    else 
    $errors["email"]="An user with this email already exists";

    if($count==count($errors)+1)
    {
        $name=$firstName." ".$lastName;
        // Inserting values into the table
        $query="INSERT INTO login_details(u_name,u_email,u_password,u_phoneno,u_joined_year) VALUES('$name','$email','$password',$phone,$year)";
        $query_result=mysqli_query($conn,$query);

        // Checking query executed successfully
        if($query_result)
        header("Location:new_books.php");
    }
    }
?>