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
    if ($validation_obj->description($book_description))
        $errors["bookdescription"] = "Invalid book description";
    else
        $errors["bookdescription"] = "";


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
    <link rel="stylesheet" type="text/css" href="css/old_books.css">
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

    <div class="infoHeader">
        <h2>Fill the following contents to sale your Old semester books</h2>
    </div>

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
        $image_path = "D:/xampp/htdocs/my/mysem_books/book_images/$image_name";

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
                    <option value="C-language">C-language</option>
                    <option value="C++-language">C++-language</option>
                    <option value="Java-language">Java-language</option>
                    <option value="R Programming">R Programming </option>
                    <option value="ALP">ALP</option>
                    <option value="Python">Python</option>
                    <option value="Andriod">Andriod</option>
                    <option value="HTML">HTML</option>
                    <option value="CSS">CSS</option>
                    <option value="PHP and MySQL">PHP and MySQL</option>
                    <option value="Visual Basics(VB6)">Visual Basics(VB6)</option>
                    <option value="Oracle">Oracle</option>
                    <option value="Data Structures">Data Structures</option>
                    <option value="Digital Principles">Digital Principles</option>
                    <option value="Discrete Mathematics">Discrete Mathematics</option>
                    <option value="Operation Research">Operation Research</option>
                    <option value="OS and UNIX">OS and UNIX</option>
                    <option value="Cloud Computing">Cloud Computing</option>
                    <option value="AI and ML">AI and ML</option>
                    <option value="Data Networks">Data Communications and Networks</option>
                    <option value="Software Engineering">Software Engineering</option>
                    <option value="Computer Graphics">Computer Graphics</option>
                    <option value="DOT Net">DOT Net</option>
                    <option value="OTHERS">OTHERS</option>
                </select>
                <div class="space"></div><br>
                <label class="bookDetails">Discription</label><br>
                <!--<textarea name="" name="" cols="62" rows="5" placeholder="type your discription here "></textarea>-->
                <input name="o_desc" type="text" placeholder="Enter your discription " value="<?php echo $book_description; ?>">
                <p class="errors"><?php echo $errors["bookdescription"]; ?></p>
                <div class="space"></div><br>
                <label class="bookDetails">Price Amount</label><br>
                <input name="o_rate" type="number" placeholder="Rupees" value="<?php echo $book_price ?>">
            </div>
            <input type="submit" name="add_book" value="Add book">
        </form>
    </div>
</body>

</html>