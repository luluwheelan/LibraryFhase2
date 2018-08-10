<!DOCTYPE html>
<html lang="en">
<head>
  <title>My Library</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
  <script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>

    <link rel="stylesheet" type="text/css" href="../css/style.css">

</head>
<body>
    
<?php
    require_once("../model/class.user.php");
    $auth_user = new USER();


    $user_id = $_SESSION['user_session'];

    $stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
    $stmt->execute(array(":user_id"=>$user_id));

    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
    ?>

<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <button class="navbar-toggler" data-toggle="collapse" data-target="#collapse_target">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapse_target">

        <a class="navbar-brand"><img src="../image/orange-book.jpg" width="30" height="30"></a>
        <a class="nav-link" href="../controller/index.php?action=my_books">My Library</a>

        <ul class="nav navbar-nav">
    
            <li class="nav-item">
                <a class="nav-item" href="../controller/index.php?action=my_books">Books</a>
            
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Movies</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Games</a>
            </li>
        </ul>
    </div>
    <div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $userRow['user_email']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="../view/profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp;View Profile</a></li>
                <li><a href="../controller/logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->

    </div>

</nav>