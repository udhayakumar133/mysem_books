<?php

// Starting the session
session_start();


// including files
include "config.php";
include "validation.php";


// Declaring neccessary variables
$user_email = "";
$link_book_name = $link_author_name = $link_book_catagory = $link_book_description = $link_book_link = "";
$errors = ["link_book_name" => "", "link_author_name" => "", "link_book_description" => "", "link_book_link" => "",];
$validation_obj = new validation();
$count = 0;

// Checking if the user is logged in
if (isset($_POST['add_link']) && isset($_SESSION["email"])) {
    $link_book_name = $_POST['l_bName'];
    $link_author_name = $_POST['l_aName'];
    $link_book_catagory = $_POST['l_catagory'];
    $link_book_description = $_POST['l_desc'];
    $link_book_link = $_POST['l_link'];
    $user_email = $_SESSION['email'];


    // Validating book name
    if ($validation_obj->name($link_book_name))
        $errors["link_book_name"] = "Invalid book name";
    else
        $errors["link_book_name"] = "";

    // Validating author name
    if ($validation_obj->name($link_author_name))
        $errors["link_author_name"] = "Invalid author name";
    else
        $errors["link_author_name"] = "";

    // Validating description 
    //if ($validation_obj->description($link_book_description))
    //    $errors["link_book_description"] = "Invalid book description";
    //else
    //    $errors["link_book_description"] = "";


    // Validating description 
    if ($validation_obj->url($link_book_link))
        $errors["link_book_link"] = "Invalid link";
    else
        $errors["link_book_link"] = "";


    // Counting number of errors
    foreach ($errors as $error) {
        if ($error == "")
            $count += 1;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/recommends_info.css">
    <link rel="stylesheet" href="./css/result_indication.css">
    <title>Document</title>
</head>

<body>
    <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="old_books.php">Old Books</a></li>
        <li><a href="recommends.php">Recommend</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="my_account.php">My Account</a></li>
    </ul>

    

    <div class="result-container">
        <p class="result-content">Link Added successfully</p>
    </div>

    <!-- Linking external javascript file -->
    <script src="js/old_books_info.js"></script>

    <?php

    // Checking if there is any errors
    if ($count == count($errors)) {

        // Inserting values into the database
        $sql = "INSERT INTO book_link_details(u_email,link_book_name,link_book_author,link_book_catagory,link_book_link,link_book_description) VALUES('$user_email','$link_book_name','$link_author_name','$link_book_catagory','$link_book_link','$link_book_description')";
        $query_result = mysqli_query($conn, $sql);
        echo mysqli_error($conn);

        // Checking if the query executed Successfully
        if ($query_result) {

            $link_book_name = $link_author_name = $link_book_catagory = $link_book_description = $link_book_link = "";

            // Displaying the result
            echo "<script>displayContainer('added','Link added successfully')</script>";
        } else

            // Displaying the result
            echo "<script>displayContainer('not-added','unable to add the Link')</script>";
    }
    ?>


    <div class="otherBooks-F">
        <form method="POST" action="">
            <div class="content-1">
            <div class="infoHeader">
                <h3><i>Fill the following contents to post your links of books<i></h3>
            </div><br><hr><br><br>
                <label class="bookDetails">Book Name</label><br><input name="l_bName" type="text" height="2px" placeholder="Enter Book name" value="<?php echo $link_book_name; ?>">
                <p class="errors"><?php echo $errors["link_book_name"] ?></p>
                <div class="space"></div><br>
                <label class="bookDetails">Author Name</label><br><input name="l_aName" type="text" placeholder="Enter Authour name" value="<?php echo $link_author_name; ?>">
                <p class="errors"><?php echo $errors["link_author_name"] ?></p>
                <div class="space"></div><br>
                <label class="bookDetails">catagory</label><br>
                <select name="l_catagory">
                    <option value="tamil">tamil</option>
                    <option value="english">english</option>
                    <option value="maths">maths</option>
                    <option value="physics">physics</option>
                    <option value="chemistry">chemistry</option>
                    <option value="computer science">computer science</option>
                    <option value="bba">bba</option>
                    <option value="b.com General">b.com General</option>
                    <option value="b.com Coperate">b.com Coperate</option>
                    <option value="b.com Chated account">b.com Chated account</option>
                    <option value="Economics">Economics</option>
                    <option value="visual communication">visual communication</option>
                    <option value="Zoology">Zoology</option>
                    <option value="botony">botony</option>
                    <option value="OTHERS">OTHERS</option>
                </select>
                <div class="space"></div><br>
                <label class="bookDetails">Discription</label><br>
                <!--<textarea name="" name="" cols="62" rows="5" placeholder="type your discription here "></textarea>-->
                <input name="l_desc" type="text" placeholder="Enter your discription " value="<?php echo $link_book_description; ?>">
                <div class="space"></div><br>
                <p class="errors"><?php echo $errors["link_book_description"] ?></p>
                <label class="bookDetails">Enter your Pdf/document Link Here</label><br>
                <input name="l_link" type="text" placeholder="Eg. Http://google.com" value="<?php echo $link_book_link; ?>">
                <p class="errors"><?php echo $errors["link_book_link"] ?></p><br>
            
                <input type="submit" name="add_link" value="Add link">
                <br></div>
        </form>
        <div class="content-2" style="position: relative; width: 40%;float: right; ">
            <img src="e7.jpg" alt="image" style="width: 100%; height: 100%;">
        </div></div>
    </div>
</body>

</html>