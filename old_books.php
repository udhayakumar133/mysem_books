<?php

// including files
include "config.php";

// Starting the session
session_start();

// user email
$user_email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/old_books.css">
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
    <div class="img-box">
        <img src="bf.png" alt="image">
    </div>
    <div class="cont-2">
        <div class="search-box">
            <input type="search" placeholder="Type the book name here...">
            <label class="icon">Search</label>
        </div>

        <div class="login-btn">
            <button>LOG IN</button>
        </div>
    </div>

    <div class="c-btns">

        <p><i>create your account to post your old books here. If you have an account then log in to
                post your used semester books here to sale.</i>
        </p>
        <div class="c-btn-1">
            <center>
                <!--<a href="OLD BOOKS_INFO.php"><button>LOG IN</button></a>-->
                <a href="old_books_info.php"><button>POST</button></a>
            </center>
        </div>

    </div>

    <?php

    // Retreiving all the book details
    $query_result = mysqli_query($conn, "SELECT * FROM book_details WHERE u_email!='$user_email'");
    $books_details = mysqli_fetch_all($query_result, MYSQLI_ASSOC);

    // Checking if there is any book
    if (!empty($books_details)) {

        // Books container
        echo "<div class='book-container'>";

        // Looping through book details
        foreach ($books_details as $books_detail) {
            $image_name = explode("/", $books_detail['book_image']);
            $image_name = $image_name[count($image_name) - 1];
            echo "<div class='book'>
                <img src='book_images/" . $image_name . "' alt='book image' class='book-image' width='100px'>
                <h2 class='book-name'>" . $books_detail['book_name'] . "</h2>
                <p class='book_author'>" . $books_detail['book_author'] . "</p>
                <p class='book_description'>" . $books_detail['book_description'] . "</p>
                <p class='book_catagory'>" . $books_detail['catagory'] . "</p>
                <p class='book_price'>" . $books_detail['price'] . "</p>
                <button>Book now</button>
            </div>";
        }

        // Closing book container
        echo "</div>";
    } else {
        echo "<h1>No books to show</h1>";
    }
    ?>
</body>

</html>