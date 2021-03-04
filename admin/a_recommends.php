<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* .book-container {
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
} */
    </style>
</head>

<body>
    <?php include "a_header.php" ?>

    <?php


    $conn = mysqli_connect("localhost", "root", "", "old_book_sales");
    if (!$conn)
        echo "Unable to connect to database";
    // Retreiving all the book details
    $query_result = mysqli_query($conn, "SELECT * FROM book_link_details");
    $books_link_details = mysqli_fetch_all($query_result, MYSQLI_ASSOC);



    // Checking if there is any book
    if (!empty($books_link_details)) {

        // Books container
        echo "<div id='book-container'>";

        // Closing book container
        echo "</div></table>";
    } else {
        echo "<h1>No Link to show</h1>";
    }
    ?>
    <script src="../jquery/lib/jquery.js"></script>
    <script>
        $("document").ready(function() {
            $("#book-container").load("displaying_link.php");
            $(document).on("click", ".delete_btn", function() {
                $.post("delete_details.php", {
                    id: $(this).attr("data-id"),
                    table_name: "book_link_details",
                    column_name: "book_link_id"
                }, function(data) {
                    if (data == 0)
                        alert("Unable to delete the link");
                    else {
                        alert("Link deleted successfully");
                        $("#book-container").load("displaying_link.php");
                    }
                })
            })

        })
    </script>
</body>

</html>
</body>

</html>