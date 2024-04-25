<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
* {
  box-sizing: border-box;
}

/* Style the buttons */
.btn {
  border: none;
  outline: none;
  padding: 12px 16px;
  background-color: #f1f1f1;
  cursor: pointer;
}

.btn:hover {
  background-color: #ddd;
}

.btn.active {
  background-color: #666;
  color: white;
}

/* Blog post styles */
.blog-container {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  grid-gap: 20px;
}

.blog-post {
  padding: 10px;
  background-color: #f9f9f9;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.blog-post h3 {
  margin-top: 0;
}

.blog-post img {
  max-width: 100%;
  border-radius: 5px;
  margin-bottom: 10px;
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

<h2>List View or Grid View</h2>

<p>Click on a button to choose list view or grid view.</p>
<div class="container">
        <div class="btn_div">
            <button class="button" onclick="back()"> BACK

                <svg fill="currentColor" viewBox="0 0 24 24" class="icon">
                    <path clip-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z" fill-rule="evenodd"></path>
                </svg>
            </button>
        </div>
<div id="btnContainer">
  <button class="btn" onclick="listView()"><i class="fa fa-bars"></i> List</button> 
  <button class="btn active" onclick="gridView()"><i class="fa fa-th-large"></i> Grid</button>
</div>
<br>

<div class="blog-container">
  <?php
  session_start();
  if (!isset($_SESSION['name'])) {
      header("Location:login.php");
      exit(); // Add an exit here to prevent further execution
  }

  $servername = "localhost";
  $db_username = "dckap";
  $db_password = "Dckap2023Ecommerce";
  $dbname = "PHP_Task";

  $conn = mysqli_connect($servername, $db_username, $db_password, $dbname);

  if ($conn->connect_error) {
      die("Connection failed: ". $conn->connect_error);
  }

  if (isset($_POST['logout'])) {
      session_destroy();
      header("Location:login.php");
      exit(); // Add an exit here to prevent further execution
  }

  // Retrieve records from the database
  $result = $conn->query("SELECT * FROM blog_add");

  // Loop through each row in the result set
  while ($row = $result->fetch_assoc()) {
      echo "<div class='blog-post'>";
      echo "<h3>".$row['Title']."</h3>";
      echo "<p>Author: ".$row['Author']."</p>";
      echo "<p>".$row['Content']."</p>";
      echo "<img src='data:image/jpeg;base64,".base64_encode($row['Image'])."' width='100'>";
      echo "</div>";
  }
  ?>
</div>

<script>
// Function to switch to list view
function listView() {
  var container = document.querySelector('.blog-container');
  container.style.gridTemplateColumns = '1fr';
  // Set the active button
  var btns = document.getElementsByClassName("btn");
  for (var i = 0; i < btns.length; i++) {
    btns[i].classList.remove("active");
  }
  document.querySelector(".btn[data-view='list']").classList.add("active");
}

// Function to switch to grid view
function gridView() {
  var container = document.querySelector('.blog-container');
  container.style.gridTemplateColumns = 'repeat(auto-fill, minmax(300px, 1fr))';
  // Set the active button
  var btns = document.getElementsByClassName("btn");
  for (var i = 0; i < btns.length; i++) {
    btns[i].classList.remove("active");
  }
  document.querySelector(".btn[data-view='grid']").classList.add("active");
}
    function back() {
    window.location.href = "home.php";
}
</script>
</body>
</html>
