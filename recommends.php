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
    <link rel="stylesheet" type="text/css" href="css/recommends.css">
    <style>
    {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
   
}
     
        .book-container {
            position: relative;
            justify-content: center;
            display: flex;
            max-width: 30%;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            font-size:18px;
            margin: 10px 1%;
            border: 1px solid black;
            
        }
        
       

        .book-container .book  { 
            margin-left: 20px;
            color: black;
            font-weight:bold;
            padding:1%


        }

        .book-container .book  label {
            font-weight: bold;
            color: green;
            font-family:cursive;
        }
        .book-container  a{
    justify-content: center;
    float: right;
    background: red ;
    color:white;
    border-radius: 10px;
    text-decoration: none;
    margin-left: 0;
    padding: 4%;
    text-align:center;
    border: none;
    font-weight: bold;
    font-family: arial;
    cursor: pointer;
}

.book-container button.btn-a {
    border:none;
}

.book-container a:hover {
    background: #1b9bff;
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

        <p><i>create your account to post your links to help others to get semester E-books here. If you have an account then log in to
                post your links.</i>
        </p>
        <div class="c-btn-1">
            <center>
                <a href="recommends_info.php"><button>POST</button></a>
            </center>
        </div>

    </div>
    <br><hr>
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
            
            <label>Book Name :</label>" . $book_link_detail['link_book_name'] . "<br>
            <label>Book Author :</label>" . $book_link_detail['link_book_author'] . "<br>
            <label>Description :</label>" . $book_link_detail['link_book_description'] . "<br>
            <label>catagory :</label>" . $book_link_detail['link_book_catagory'] . "<br>
            <button class='btn-a'><a href='" . $book_link_detail['link_book_link'] . "'>" . 'get downlod link' ."</a></button>
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