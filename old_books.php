<?php

// including files
include "config.php";
include "header.php";

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
    <style>
     *
{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
   
}
        .book-container {
            position: relative;
            justify-content: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            font-size:18px;
            margin: 0px 1%;
            
        }
        
        .book-container .book {
            position: relative;
            width: 46%;
            border:1px solid black;
            border-radius:10px;
            background: white;
            margin: 10px;
            padding: 15px;
            display: flex;
        }

        .book-container .book .imgBox {
            max-width: 150px;
            flex: 0 0 150px ;

        }

        .book-container .book .imgBox img {
            max-width: 100%;
        }

        .book-container .book .content {
            margin-left: 20px;
            color: black;
            font-weight:bold;


        }

        .book-container .book .content label {
            font-weight: bold;
            color: green;
            font-family:cursive;
        }
        button.btn-a {
    justify-content: center;
    float: right;
    margin-left: 0;
    padding: 5%;
    margin: 2%;
    margin-top: 12%;
    background: lightgreen;
    border: 0;
    font-weight: bold;
    font-family: arial;
    cursor: pointer;
}

button.btn-a:hover {
    background:red;
} 

</style>
<title>Document</title>
</head>

<body>
    
    
    <div class="img-box">
        <img src="bf.png" alt="image">
    </div>
    <div class="cont-2">
        <div class="search-box">
            <input type="search" placeholder="Type the book name here...">
            <label class="icon">Search</label>
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
    <br><hr>

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
            <div class='imgBox'>
                <img src='book_images/" . $image_name . "' alt='book image'>
            </div>
            <div class='content'>
                <label>Book Name :</label> " . $books_detail['book_name'] . "<br>
                <label>Book Author :</label> " . $books_detail['book_author'] . "<br>
                <label>Description :</label>" . $books_detail['book_description'] . "<br>
                <label>catagory :</label>" . $books_detail['catagory'] . "<br>
                <label>Price :</label>" . $books_detail['price'] . "<br>
                <button class='btn-a'>Book now</button>
            </div> </div>";
        }

        // Closing book container
        echo "</div>";
    } else {
        echo "<h1>No books to show</h1>";
    }
    ?>
</body>

</html>