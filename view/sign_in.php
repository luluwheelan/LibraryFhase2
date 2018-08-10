
<?php
session_start();
require_once("../model/class.user.php");
$login = new USER();

if($login->is_loggedin()!="")
{
	$login->redirect("../view/profile.php");
}

if(isset($_POST['btn-login']))
{
    //strip characters
	$uname = strip_tags($_POST['txt_uname_email']);
	$umail = strip_tags($_POST['txt_uname_email']);
	$upass = strip_tags($_POST['txt_password']);
		
	if($login->doLogin($uname,$umail,$upass))
	{
		$login->redirect("profile.php");
	}
	else
	{
		$error = "User name or password wrong!";
	}	
}
?>
<?php include 'sign_header.php';?>
<div class="signin-form">
<div class="container">
<div class="modal-dialog text-center">
        <div class="col-sm-8 main-section">
            <div class="modal-content">
                <div class="col-12 user-img">
                    <img src="../image/orange-book.jpg">
                </div>
        
       <form class="form-signin col-12" method="post" id="login-form" action="<?php $_SERVER['PHP_SELF'];?>">
        
        <div id="error">
        <?php
			if(isset($error))
			{
				?>
                <div class="alert alert-danger">
                   <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> 
                </div>
                <?php
			}
		?>
        </div>
        
        <div class="form-group user">
        <input type="text" class="form-control" name="txt_uname_email" placeholder="Username or Email" required />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group password">
        <input type="password" class="form-control" name="txt_password" placeholder="Enter Password" />
        </div>
       <div class="form-group">
            <button type="submit" name="btn-login" class="btn btn-default"> <i class="fas fa-sign-in-alt"></i>LOGIN</button>
        </div>
           
        
        <div class="form-group">
            <button class="btn btn-default" ><a href="sign_up.php"> <i class="fas fa-sign-in-alt"></i>SIGN UP</a></button>
        </div>
        
            <label class="text-warning">I am only a visitor <a href="../controller/index.php?action=my_books">Click here</a></label>

      </form>
    </div>
    </div>
    </div>
    </div>
</div>

<?php include 'footer.php';?>