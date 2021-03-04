<?php

// Starting the session
session_start();


// including files
include "config.php";
include "validation.php";


// Declaring neccessary variables
$user_email = "";
$book_name = $author_name = $book_catagory = $book_description = "";
$errors = ["bookname" => "", "authorname" => "", "bookdescription" => "", "bookimage" => ""];
$validation_obj = new validation();
$count = 0;

// Checking if the user is logged in
if (isset($_POST['add_book']) && isset($_SESSION["email"])) {
    $book_name = $_POST['o_bName'];
    $author_name = $_POST['o_aName'];
    $book_catagory = $_POST['o_catagory'];
    $book_description = $_POST['o_desc'];
    $book_price = $_POST['o_rate'];
    $book_image = $_FILES['book_image'];
    $user_email = $_SESSION["email"];

    // Checking the image type
    if ($book_image["error"] != 0)
        $errors["bookimage"] = "No image has been selected";
    else if ($book_image["type"] != "image/jpg" && $book_image["type"] != "image/png" && $book_image["type"] != "image/gif" && $book_image["type"] != "image/jpeg")
        $errors["bookimage"] = "Unsupported image format";
    else
        $errors["bookimage"] = "";

    // Validating book name
    if ($validation_obj->name($book_name))
        $errors["bookname"] = "Invalid book name";
    else
        $errors["bookname"] = "";

    // Validating author name
    if ($validation_obj->name($author_name))
        $errors["authorname"] = "Invalid author name";
    else
        $errors["authorname"] = "";

    // Validating description 
    //if ($validation_obj->description($book_description))
    //    $errors["bookdescription"] = "Invalid book description";
    // else
    //    $errors["bookdescription"] = "";


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
    <link rel="stylesheet" type="text/css" href="css/old_books_info.css">
    <title>Document</title>

    <!-- CSS for indication of book added or not -->
    <link rel="stylesheet" href="css/result_indication.css">

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
        <p class="result-content">book Added successfully</p>
    </div>

    <!-- Linking external javascript file -->
    <script src="js/old_books_info.js"></script>

    <?php

    // Checking if there is any errors
    if ($count == count($errors)) {

        // Getting the type of the book image
        $image_type = explode("/", $book_image["type"])[1];

        // Giving name to the book image
        $image_name = time() . "." . $image_type;

        // Path of the book image
        $image_path = "H:/xampp/htdocs/MY/book_images/$image_name";

        // Checking if the book image file is uploaded
        if (move_uploaded_file($book_image["tmp_name"], $image_path)) {

            $errors["bookimage"] = "";

            // Inserting values into the database
            $sql = "INSERT INTO book_details(u_email,book_name,book_author,price,catagory,book_image,book_description) VALUES('$user_email','$book_name','$author_name','$book_price','$book_catagory','$image_path','$book_description')";
            $query_result = mysqli_query($conn, $sql);

            // Checking if the query executed Successfully
            if ($query_result) {

                $book_name = $author_name = $book_price = $book_description = $book_catagory = "";

                // Displaying the result
                echo "<script>displayContainer('added','book added successfully')</script>";
            } else

                // Displaying the result
                echo "<script>displayContainer('not-added','unable to add the book')</script>";
        } else
            $errors["bookimage"] = "Unable to upload the file";
    }
    ?>

    <div class="otherBooks-F">
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="content-1">
                <div class="infoHeader">
                    <h3><i>Fill the following contents to sale your old semester books</i></h3>
                </div><br>
                <hr><br><br>
                <label class="bookDetails">Select Book image:</label><br>
                <input type="file" name="book_image"><br><br>
                <p class="errors"><?php echo $errors["bookimage"]; ?></p>
                <label class="bookDetails">Book Name</label><br>
                <input name="o_bName" type="text" height="2px" placeholder="Enter Book name" value="<?php echo $book_name ?>">
                <p class="errors"><?php echo $errors["bookname"]; ?></p>
                <div class="space"></div><br>
                <label class="bookDetails">Author Name</label><br>
                <input name="o_aName" type="text" placeholder="Enter Authour name" value="<?php echo $author_name ?>">
                <p class="errors"><?php echo $errors["authorname"]; ?></p>
                <div class="space"></div><br>
                <label class="bookDetails">catagory</label><br>
                <select name="o_catagory">
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
                <input name="o_desc" type="text" placeholder="Enter your discription " value="<?php echo $book_description; ?>">
                <p class="errors"><?php echo $errors["bookdescription"]; ?></p>
                <div class="space"></div><br>
                <label class="bookDetails">Price Amount</label><br>
                <input name="o_rate" type="number" placeholder="Rupees" value="<?php echo $book_price ?>"><br><br>
                <input type="submit" name="add_book" value="Add book" class="btn-add">
            </div>

        </form>
    </div>
    <div class="content-2">
        <img src="e6.png" alt="image">
    </div>
    </div>
</body>

</html>