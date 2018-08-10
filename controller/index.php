

<?php
require('../model/db.php');
require('../model/book-db.php');


//if we donot have an action
//default page is default.php.
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    
        //get all the books from database
        if($action == NULL){
        $books=list_book();
        require_once("../session/session.php"); 
        if(!$session->is_loggedin()){
        //redirect to the login request page
            include('../view/default_header.php');
            include('../view/my_books.php');
        }else{
            include('../view/header.php');
            include('../view/my_books.php');
        }
            
        }
}
//below are all the deferent actions
//show book list
if ($action == 'my_books') {
    //get all the books from database
    $books=list_book();
    $search_word=null;
    //show user all the books
    require_once("../session/session.php"); 
    if($session->is_loggedin()){
    //redirect to the login request page
        include ('../view/header.php');
        include('../view/my_books.php');
        
    }else{
        include ('../view/default_header.php');
        include('../view/my_books.php');
    }

} 

else if($action=='search'){
    
    require_once("../session/session.php");    
    
    $search_word = $_GET['keywords'];
    $search_words = explode(' ', $search_word);
    $books=search_book($search_words);
    
    if(!$session->is_loggedin()){
        include ('../view/default_header.php');
        include('../view/search_result.php');
    }
    else{
    include ('../view/header.php');
    //redirect to the default page
    include('../view/search_result.php'); 
    }
}

//delete a book  
else if ($action == 'delete_book') {
    require_once("../session/session.php");
    
    if(!$session->is_loggedin()){
        include ("../view/login_request.php");
    }
    else{
    //Get the book id from url
    $book_id = $_GET['book_id'];
    if($book_id ==NULL){
        echo "<p>Missing or incorrect book id</p>";
        include('../errors/error.php');
    }
    else{
        //delete book
        delete_book($book_id);
        $books=list_book();
        //redirect to the default page
        include('../view/header.php');
        include('../view/my_books.php'); 
        //header("Location: ../controller/index.php");
    }
    }
}

//add a book or edit a book will direct the user
//to the book_add form
else if ($action == 'get_add_form') {
    $book_id=null;
    $title = null;
    $genre = null;
    $review = null;
    $name = null;
    $email = null;
    $link = null;
    //check if the user is registered or just a visitor
    require_once("../session/session.php");
    if(empty($_GET['book_id'])){  
        if(!$session->is_loggedin()){
        include ("../view/default_header.php");
        include("../view/book_add.php");
        
        }else{
        include('../view/header.php');
        include("../view/book_add.php");
        }
        
    }
    //if has a book id, it is editing
    if(!empty($_GET['book_id'])){
        
        if(!$session->is_loggedin()){
        //redirect to the login request page
        include('../view/login_request.php');

        }
        else{
	

        //define all the variables.
            
            $book_id = $_GET['book_id'];
            $book=get_book_by_id($book_id);
            $title = $book['title'];
            $genre = $book['genre'];
            $review = $book['review'];
            $name = $book['name'];
            $email = $book['email'];
            $link = $book['link'];
        include('../view/header.php');
        include("../view/book_add.php");
    
        }
    }
}

//add or edit a book record 
//when user press submit button 
else if ($action == 'add_book') {
    $book_id=null;
    $book_id = $_POST['book_id'];
    $title = filter_input(INPUT_POST, 'title');
    $genre = filter_input(INPUT_POST, 'genre');
    $review = filter_input(INPUT_POST, 'review');
    $name = filter_input(INPUT_POST, 'name');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $link = filter_input(INPUT_POST, 'link', FILTER_VALIDATE_URL);
    
    $ok=true;
    
    if(empty($title)) {
      echo "<p>Title is required</p>";
      $ok = false; 
    }

    if(empty($genre)) {
      echo "<p>Genre is required</p>";
      $ok = false; 
    }

    if(empty($review)) {
      echo "<p>Review is required</p>";
      $ok = false; 
    }
    
    if(empty($name)) {
      echo "<p>Name is required</p>";
      $ok = false; 
    }
  
    if(empty($email)) {
      echo "<p>Email is required</p>";
      $ok = false; 
    }

    if($email === FALSE) {
      echo "<p>Email must be valid</p>";
      $ok = false; 
    }


    if(empty($link)) {
      echo "<p>Link is required</p>";
      $ok = false; 
    }

    if ($link === FALSE) {
        echo(" <p>Link is not a valid URL</p>");
        $ok = false;
    }

    //add a book
    if(($ok === TRUE) && (empty($book_id))){
        add_book($title, $genre, $review, $name, $email, $link);
        //back to the page with the new book added
        //header("Location: index.php");
        require_once("../session/session.php");
        if(!$session->is_loggedin()){
            $books=list_book();
            include('../view/default_header.php');
            include('../view/my_books.php');
        //include('../errors/error.php');
        }
        else{
            $books=list_book();
        //redirect to the default page
        include('../view/header.php');
        include('../view/my_books.php'); 
        }
    }
    
    //edit a book
    if(($ok === TRUE) && (!empty($book_id))){
        edit_book($book_id, $title, $genre, $review, $name, $email, $link);
        //back to the page with the new edited
        //header("Location: ../view/my_books.php");
        require_once("../session/session.php");
        $books=list_book();
        $search_word=null;
        //redirect to the default page
        include('../view/header.php');
        include('../view/my_books.php'); 
        
    }
} 
//if any unhandled exception happened
//else { 
//        echo "Invalid data. Check all fields and try again.";
//        include('../errors/error.php');
//    }
   
?>