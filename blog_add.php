<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Blog Post</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background: #c4ebff;
            width: 100%;
            height: 100%;
            position: relative;
            top: 2.5em;
            border-radius: 0.3em;
        }

        h2 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="file"] {
            margin-top: 10px;
            /* Add margin for spacing */
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        /* button:hover {
            background-color: #0056b3;
        } */

        head {
            width: 100%;
            height: 100%;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 99%;
            height: 97%;
        }

        /* button */

        .button {
            position: relative;
            transition: all 0.3s ease-in-out;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
            padding-block: 0.5rem;
            padding-inline: 1.25rem;
            background-color: rgb(117 179 0);
                border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffff;
            gap: 10px;
            font-weight: bold;
            border: 3px solid #ffffff4d;
            outline: none;
            overflow: hidden;
            font-size: 15px;
        }

        .icon {
            width: 24px;
            height: 24px;
            transition: all 0.3s ease-in-out;
        }

        .button:hover {
            transform: scale(1.05);
            border-color: #fff9;
        }

        .button:hover .icon {
            transform: translate(4px);
        }

        .button:hover::before {
            animation: shine 1.5s ease-out infinite;
        }

        .button::before {
            content: "";
            position: absolute;
            width: 100px;
            height: 100%;
            background-image: linear-gradient(120deg,
                    rgba(255, 255, 255, 0) 30%,
                    rgba(255, 255, 255, 0.8),
                    rgba(255, 255, 255, 0) 70%);
            top: 0;
            left: -100px;
            opacity: 0.6;
        }

        @keyframes shine {
            0% {
                left: -100px;
            }

            60% {
                left: 100%;
            }

            to {
                left: 100%;
            }
        }
        .btn_div {
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: end;
}
    </style>
</head>

<body>
    <div class="container">
        <div class="btn_div">
            <button class="button" onclick="back()"> BACK

                <svg fill="currentColor" viewBox="0 0 24 24" class="icon">
                    <path clip-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z" fill-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <h2>New Blog Post</h2>

        <form method="POST" enctype="multipart/form-data">


            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" required>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea id="content" name="content" rows="6" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" id="image" name="image">
            </div>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
</body>
<script>
    function back() {
    window.location.href = "home.php";
}
</script>

</html>








<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location:login.php");
    exit();
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location:login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $servername = "localhost";
    $db_username = "dckap";
    $db_password = "Dckap2023Ecommerce";
    $dbname = "PHP_Task";

    $conn = mysqli_connect($servername, $db_username, $db_password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $title = $_POST['title'];
    $author = $_POST['author'];
    $content = $_POST['content'];

    $file_name = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $folder = "images/" . $file_name;

    if (move_uploaded_file($tempname, $folder)) {

        $sql = "INSERT INTO blog_add (Title, Author, Content, Image) VALUES ('$title', '$author', '$content', '$file_name')";

        if (mysqli_query($conn, $sql)) {
            echo '<script>alert("New record created successfully");</script>';
        } else {
            echo '<script>alert("Error: ' . mysqli_error($conn) . '");</script>';
        }
    } else {
        echo "<script>alert ('Failed to Data: $folder');</script>";
    }

    $conn->close();
}
?>