<?php
session_start();

// Omdirigera till inloggningsidan om du inte är inloggad
if (!isset($_SESSION['user']) ||(trim ($_SESSION['user']) == '')){
	header('location: index.php');
}

include('includes/database.php');
$id = $_GET['id'];
$db = new database();
$query = "SELECT * FROM `members` WHERE `id`=$id";
$data = $db->select($query)->fetch_assoc();

if(isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($db->connection, $_POST['name']);
    $phone = mysqli_real_escape_string($db->connection, $_POST['phone']);
    $category = mysqli_real_escape_string($db->connection, $_POST['category']);
    $team = mysqli_real_escape_string($db->connection, $_POST['team']);
    $memberDues = mysqli_real_escape_string($db->connection, $_POST['member_dues']);
    if($name == '' || $phone == '' || $category == '' || $team == '' || $memberDues == '') {
        $error = 'Du måste fylla i alla fält';
    } else {
        $query = "UPDATE `members` 
        SET
        `name` = '$name',
        `phone` = '$phone', 
        `category` = '$category',
        `team` = '$team',
        `member_dues` = '$memberDues'
        WHERE `id`= $id";
        $update = $db->update($query);
    }
}
?>

 <?php
    if(isset($_POST['delete'])) {
        $query = "DELETE FROM `members` WHERE `id`= $id";
        $delete = $db->delete($query);
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
  <h1 class="display-4">Adminpanelen</h1>
  <a href="logout.php" class="btn btn-dark"> Logga Ut</a>
    <hr class="my-4">
    <h3>Uppdatera uppgifter</h3>

    <form action="update.php?id=<?php echo $id ?>" method="post">
    <table class="crud-table">
    <tr>
    <td>Namn</td>
    <td><input type="text" name="name" value="<?php echo $data['name']; ?>"></td>
    </tr>

    <tr>
    <td>Telefon</td>
    <td><input type="text" name="phone" value="<?php echo $data['phone']; ?>"></td>
    </tr>

    <tr>
    <td>Sport</td>
    <td><input type="text" name="category" value="<?php echo $data['category']; ?>"></td>
    </tr>

    <tr>
    <td>Lag</td>
    <td><input type="text" name="team" value="<?php echo $data['team']; ?>"></td>
    </tr>

    <tr>
    <td>Medlemsavgift</td>
    <td><input type="text" name="member_dues" value="<?php echo $data['member_dues']; ?>"></td>
    </tr>

    <tr>
    <td></td>
    <td><input type="submit" name="submit" value="Uppdatera"><input type="submit" name="delete" value="Radera medlem"></td>
    </tr>
    </table>
    </form>
    <a href="adminpanel.php">Ångra</a>


</div>
</div>
<?php include 'nav/footer.php' ?>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>