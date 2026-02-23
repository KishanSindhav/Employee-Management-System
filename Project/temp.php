<?php

include "config.php";

session_start();

$connPDO = null;

$connPDO = new PDO("mysql:host=localhost;dbname=emp_management",'root', '');

$dataL = $connPDO->prepare("SELECT * from `emp_leave`");
$dataL->execute();

$rows = $dataL->rowCount();

// Calculate the number of pages
$pages = ceil($rows / 10);

// Get the current page
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

// Show the rows on the current page
$dataL->bindParam(':limit', 10, PDO::PARAM_INT);
$dataL->bindParam(':offset', ($currentPage - 1) * 10, PDO::PARAM_INT);
$dataL->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> 
<style>
        .bc,nav{
  background-color:lightyellow;
 }
 .active{
  text-decoration: underline;
 }
 .notification {

color: black;
text-decoration: none;
padding: 7px 10px;
position: relative;
display: inline-block;
border-radius: 2px;
}

.notification .badge {
position: absolute;
top: -10px;
right: -10px;
padding: 5px 10px;
border-radius: 50%;
background: grey;
color: black;
}
</style>
</head>
<body style="background-color: aliceblue ;">
<nav class="navbar navbar-expand-lg  " >
  <div class="container" >
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="..\photos\logo.jpg" alt="Logo" width="45" height="35" class="d-inline-block align-text-top">
      HR INDUSTRY
    </a>
  </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-1">
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="index.php">Home</a>
<div class="container">
    <h2>Leave Applications</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Employee Name</th>
                <th>Leave Type</th>
                <th>From Date</th>
                <th>To Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $dataL->fetch(PDO::FETCH_ASSOC)) : ?>
                <tr>
                    <td><?php echo $row['employee_name']; ?></td>
                    <td><?php echo $row['leave_type']; ?></td>
                    <td><?php echo $row['from_date']; ?></td>
                    <td><?php echo $row['to_date']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <div class="pagination">
        <a href="?page=<?php echo $currentPage - 1; ?>">&laquo; Previous</a>
        <?php for ($i = 1; $i <= $pages; $i++) : ?>
            <a href="?page=<?php echo $i; ?>" class="<?php if ($currentPage == $i) { echo 'active'; } ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
        <a href="?page=<?ph p echo $currentPage + 1; ?>">Next &raquo;</a>
    </div>
</div>
</body>
</html>


