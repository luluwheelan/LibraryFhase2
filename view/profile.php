<?php

	require_once("../session/session.php");
	
	require_once("../model/class.user.php");
	$auth_user = new USER();
	
	
	$user_id = $_SESSION['user_session'];
	
	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
	
?>
<?php include 'header.php';?>

	<div class="clearfix"></div>
	
    <div class="container-fluid" style="margin-top:80px;">
	
    <div class="container">
    
    	<label class="h5">welcome : <?php print($userRow['user_name']); ?></label>
        <hr />
        
        <h1>
        <a href="../controller/index.php?action=my_books"><span class="glyphicon glyphicon-home"></span>Book list</a> &nbsp; 
        <a href="../controller/index.php?action=get_add_form"><span class="glyphicon glyphicon-user"></span> Add Books</a></h1>
        <hr />
    
    </div>

</div>




<script src="bootstrap/js/bootstrap.min.js"></script>

<?php include 'footer.php';?>