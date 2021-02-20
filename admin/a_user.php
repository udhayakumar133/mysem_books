<!DOCTYPE html>
<html lang="en">

<?php include"a_header.php" ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .user_container {
            height:350px;
            width:80%;
            left:10%;
            padding:2%;
            background: white;
            top:30%;
            position: absolute;
        }

        .user_container {
            color:#0082e6;
        }
        .u_count {
            height:50px;
            width: 50px;
            border : 1px solid black;
           
            
        }
        .b_count {
            height:50px;
            width: 50px;
            border : 1px solid black;
            
          

        }
        .l_count {
            height:50px;
            width: 50px;
            border : 1px solid black;
            
            
        }

        button {
            position: absolute;
            top:85%;
            left:77%; 
            font-size:18px;
            padding: 1% 2% 1% 2%;
            border:none;
            background: #0082e6;
            cursor: pointer;
            font-weight: bold;

        }
        button:hover {
            background: red;
        }
    </style>
</head>
<body>
    
    <div class="user_container">
        <h2 >USERS </h2><br><div class="u_count"></div><br>
        <h2 >BOOKS </h2><br><div class="b_count"></div><br>
        <h2 >LINKS </h2><br><div class="l_count"></div><br>
        <h1 style="float: right; right:50%;top: 20%; position: absolute;";>ANNOUNCEMENTS</h1>
        <textarea rows="7" cols="50" placeholder="Type here..." style="position: absolute;top:35%;left:35%; font-size:18px;";></textarea>
        <button action="#" value="add">ADD</button>
    </div>
    
</body>
</html>