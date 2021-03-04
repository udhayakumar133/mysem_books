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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        #book-container {
            position: relative;
            justify-content: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            font-size: 18px;
            margin: 0px 1%;

        }

        #book-container .book {
            position: relative;
            width: 46%;
            border: 1px solid black;
            border-radius: 10px;
            background: white;
            margin: 10px;
            padding: 15px;
            display: flex;
        }

        #book-container .book .imgBox {
            max-width: 150px;
            flex: 0 0 150px;

        }

        #book-container .book .imgBox img {
            max-width: 100%;
        }

        #book-container .book .content {
            margin-left: 20px;
            color: black;
            font-weight: bold;


        }

        #book-container .book .content label {
            font-weight: bold;
            color: green;
            font-family: cursive;
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
            background: red;
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
            <input type="text" placeholder="Type the book name here..." id="search_txt" />
            <select id="o_catagory">
                <option value="" selected>--none--</option>
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
            </select><br><br>
            <!-- <label class="icon">Search</label> -->
            <button type="button" id="search_btn">Search</button>
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
    <br>
    <hr>

    <?php

    // Retreiving all the book details
    $query_result = mysqli_query($conn, "SELECT * FROM book_details WHERE u_email!='$user_email'");
    $books_details = mysqli_fetch_all($query_result, MYSQLI_ASSOC);

    // Checking if there is any book
    if (!empty($books_details)) {

        // Books container
        echo "<div id='book_container'>";

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
    <script src="./jquery/lib/jquery.js"></script>
    <script>
        $(document).ready(function() {
            $("#search_txt").keyup(function() {
                $.post("live_search.php", {
                    search_txt: $("#search_txt").val(),
                    table_name: "book_details",
                    column_name: "book_name"
                }, function(data) {
                    if (data == 0)
                        alert("Unable to perform the search");
                    else
                        $("#book_container").html(data);
                })
            });

            $("#search_btn").click(function() {
                $.post("search.php", {
                    search_txt: $("#search_txt").val(),
                    catagory: $("#o_catagory").val(),
                    table_name: "book_details",
                    column_name1: "book_name",
                    column_name2: "catagory"
                }, function(data) {
                    if (data == 0)
                        alert("Unable to perform the search");
                    else
                        $("#book_container").html(data);
                })
            });
        })
    </script>
</body>

</html>