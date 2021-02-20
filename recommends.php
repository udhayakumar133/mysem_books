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
    <link rel="stylesheet" type="text/css" href="css/recommends.css">
    <title>Document</title>
</head>

<body>
    <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="old_books.php">Old Books</a></li>
        <li><a href="recommends.php">Recommend</a></li>
        <li><a href="Login.php">Login</a></li>
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

        <p><i>create your account to post your links to help others to get semester E-books here. If you have an account then log in to
                post your links.</i>
        </p>
        <div class="c-btn-1">
            <center>
                <a href="recommends_info.php"><button>POST</button></a>
            </center>
        </div>

    </div>

    <?php

    // Retreiving all the book details
    $query_result = mysqli_query($conn, "SELECT * FROM book_link_details WHERE u_email!='$user_email'");
    $books_link_details = mysqli_fetch_all($query_result, MYSQLI_ASSOC);


    // Checking if there is any book
    if (!empty($books_link_details)) {

        // Books container
        echo "<div class='book-container'>";

        // Looping through book details
        foreach ($books_link_details as $book_link_detail) {
            echo "<div class='book'>
                <h2 class='book-name'>" . $book_link_detail['link_book_name'] . "</h2>
                <p class='book_author'>" . $book_link_detail['link_book_author'] . "</p>
                <p class='book_description'>" . $book_link_detail['link_book_description'] . "</p>
                <p class='book_catagory'>" . $book_link_detail['link_book_catagory'] . "</p>
                <a href='" . $book_link_detail['link_book_link'] . "'>" . $book_link_detail['link_book_link'] . "</a>
            </div>";
        }

        // Closing book container
        echo "</div>";
    } else {
        echo "<h1>No Link to show</h1>";
    }
    ?>

</body>

</html>