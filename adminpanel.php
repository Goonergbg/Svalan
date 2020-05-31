<?php
session_start();

// Omdirigera till inloggningsidan om du inte är inloggad
if (!isset($_SESSION['user']) ||(trim ($_SESSION['user']) == '')){
	header('location: index.php');
}

include_once('user.php');

$user = new User();

// Fetchar data
$sql = "SELECT * FROM `admin` WHERE id = '".$_SESSION['user']."'";
$row = $user->details($sql);
$db = new database();
$query = "SELECT * FROM `members` ORDER BY `category`";
$cat = "SELECT `category`, `team`,
         COUNT(*)
FROM `members`
GROUP BY  `team`, `category`
ORDER BY  `category`, COUNT(*) DESC;";
$reader = $db->select($cat);
$read = $db->select($query);
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
  <h1 class="display-4">Adminpanelen</h1>
  <a href="logout.php" class="btn btn-dark"> Logga Ut</a>
    <hr class="my-4">
    <h3>Alla Medlemmar | <a href="create.php">Lägg till en ny medlem</a></h3>

    <table class="crud-table">
    <tr>
    <th>Nr</th>
    <th>Namn</th>
    <th>Telefon</th>
    <th>Sport</th>
    <th>Lag</th>
    <th>Medlemsavgift</th>
    <th>Redigera</th>
    </tr>
    
    <?php if($read) { ?>
    <?php
    $nr = 1;
     while($row = $read->fetch_assoc()) { ?>
    
    <tr>
    <td><?php echo $nr++; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['phone']; ?></td>
    <td><?php echo $row['category']; ?></td>
    <td><?php echo $row['team']; ?></td>
    <td><?php echo $row['member_dues']; ?></td>
    <td><a href="update.php?id=<?php echo urlencode($row['id']);?>">Ändra/Radera</a></td>
    </tr>

    <?php } ?>
    <?php } else { ?>
    <p>Det finns ingen data</p>
    <?php } ?>
    </table>

    <h3>Antal medlemmar i de olika sporterna/lagen</h3>
          <table class="crud-table">
    <tr>
    <th>Sport</th>
    <th>Lag</th>
    <th>Antal Medlemmar</th>
    </tr>

    <?php
    while($row = $reader->fetch_assoc()) { ?>

    <tr>
    <td><?php echo $row['category']; ?></td>
    <td><?php echo $row['team']; ?></td>
    <td><?php echo $row['COUNT(*)'] ?></td>

    </tr>
    <?php } ?>
    </table>


</div>
</div>
<?php include 'nav/footer.php' ?>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>