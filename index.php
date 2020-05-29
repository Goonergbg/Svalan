<?php
  session_start();
  
  // Omdirigeras till adminpanelen om du är inloggad
	if(isset($_SESSION['user'])){
		header('location: adminpanel.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>IK Svalan</title>
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
<?php include 'nav/menu.php' ?>
<div class="container">
<div class="jumbotron">
  <h1 class="display-4">Välkommen till Idrottsklubben Svalan</h1>
    <hr class="my-4">
  <p>Fotboll | Skidor | Gymnastik</p>
  
<form method="POST" action="login.php">
<div class="form-group">
<input class="form-control" placeholder="Användarnamn" type="text" name="username" autofocus required>
</div>
<div class="form-group">
<input class="form-control" placeholder="Lösenord" type="password" name="password" required>
</div>
<button type="submit" name="login" class="btn btn-lg btn-dark btn-block"> Logga In</button>
<br>

<?php
if(isset($_SESSION['message'])){
?>

<p><?php echo $_SESSION['message']; ?></p>
<?php

unset($_SESSION['message']);
}
?>
  </form>

</div>
</div>
<?php include 'nav/footer.php' ?>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>