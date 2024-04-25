

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Responsive Navbar | CodingNepal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo">Charming_Prince</label>

        <div class="center_div">
            <div class="first_div">
                <ul>
                    <li><a class="active" href="#">Home</a></li>
                    <li><a href="blog_add.php">blog_add</a></li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><?php if ($loggedin) { ?>
                            <a href="#"><img src="path_to_your_image.jpg" alt="Profile Image" style="width: 20px; height: 20px; border-radius: 50%;"></a>
                        <?php } else { ?>
                            <a href="#"><i class="fa fa-fw fa-user"></i> <?php echo  $_COOKIE['username']  ?></a>
                        <?php } ?>
                    </li>
                </ul>
  
    </div>
    <div class="second_div">
        <form action="login.php" method="post">
            <!-- <button type="submit" name="logout" href="#">Logout</button> -->
            <button class="Btn" type="submit" name="logout">
  <div class="sign">
    <svg viewBox="0 0 512 512">
      <path
        d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"
      ></path>
    </svg>
  </div>

  <div class="text">Logout</div>
</button>
        </form>
    </div>
    </div>
    </nav>

</body>

</html>



<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location:login.php");
}
?>

<?php
setcookie('username', $_SESSION['name']);
?>

<?php
session_start();

if (isset($_POST['logout'])) {
    if (session_destroy()) {

        if (isset($_COOKIE['username'])) {
            setcookie('username', '', time() - 3600, '/');
        }

        header("Location: /login.php");
        exit();
    }
}
?>