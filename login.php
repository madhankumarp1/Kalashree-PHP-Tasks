

<?php
session_start();

$servername = "localhost";
$db_username = "dckap";
$db_password = "Dckap2023Ecommerce";
$dbname = "PHP_Task";

$conn = mysqli_connect($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = '';
if(isset($_POST)){
    $username = $_POST['username'];
    $password = $_POST['password'];


//  $sql = "SELECT id FROM users WHERE email = '$username' AND password = '$password'";

$sql = "SELECT id FROM users WHERE (email = '$username' OR username = '$username') AND password = '$password'";


 $result=$conn->query($sql);

 if($result->num_rows > 0){
  while($row = $result->fetch_assoc()){

    $_SESSION['name'] = $username;
    header("Location:home.php");
  
}
 }
 else{
  $error = 'Invalid Username or Password';
 }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .container {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 20%;

    }
    h2 {
      text-align: center;
    }
    label {
      display: block;
      margin-bottom: 8px;
    }
    input[type="text"], input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
    button {
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    button:hover {
      background-color: #0056b3;
    }
    .link_div {
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
a {
    text-decoration: none;
    color: #007bff;
    height: 100%;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
  </style>
</head>
<body>
  <div class="container">
    <h2>Login</h2>
    <form  method="post">
      <label for="username">Username Or Email :</label>
      <input type="text" id="username" name="username"  value="<?php echo isset($username) ? $username : ''; ?>">
      
      <label for="password">Password :</label>
      <input type="password" id="password" name="password" value="<?php echo isset($password) ? $password : ''; ?>" >
      <div class="link_div">
        <a href="signup.php">Don't have an account?</a>
    </div>
      <button type="submit" name="submit" >Login</button>
    </form>
  </div>
</body>
</html>

