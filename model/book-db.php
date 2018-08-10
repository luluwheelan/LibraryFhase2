<?php
//require_once('db.php');
//private $conn;



function list_book() {

    require_once('db.php');
    $database = new Database();
    $db = $database->dbConnection();
    //$this->conn = $db;
    $query = 'SELECT * FROM books';
    $statement = $db->prepare($query);
    $statement->execute();
    $books = $statement->fetchAll();
    $statement->closeCursor();
    return $books;
}

function get_book_by_id($book_id) {
    //$conn;
    require_once('db.php');
    $database = new Database();
    $db = $database->dbConnection();
    //$this->conn = $db;
    $query = 'SELECT * FROM books WHERE book_id = :book_id';
    $statement = $db->prepare($query);
    $statement->bindValue(":book_id", $book_id);
    $statement->execute();
    $book = $statement->fetch();
    $statement->closeCursor();
    return $book;
}

function search_book($search_words){
    require_once('db.php');
    $database = new Database();
    $db = $database->dbConnection();
  //build our sql query
  $query = "SELECT * FROM books WHERE ";
  //use foreach loop to go through each search term 
  $where = ""; //start by setting to empty string 
  foreach ($search_words as $word) {
  $where = $where . "title LIKE '%$word%' OR "; //add this text on to our where clause for every word in the list - no sure how many times it will iterate
  } 
  // how can we put those together?
  $where = substr($where, 0, strlen($where) - 4);

  $final_sql = $query . $where; 
  //echo $final_sql . "<br/>";
  $statement = $db->prepare($final_sql);
  $statement->execute(); 
  $books = $statement -> fetchAll();
  $statement->closeCursor();
  return $books;
}

function delete_book($book_id) {
    //$conn;
    require_once('db.php');
    $database = new Database();
    $db = $database->dbConnection();
    //$this->conn = $db;
    $query = 'DELETE FROM books
              WHERE book_id = :book_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':book_id', $book_id, PDO::PARAM_INT);
    $statement->execute();
    $statement->closeCursor();
}

function add_book($title, $genre, $review, $name, $email, $link) {
    //$conn;
    require_once('db.php');
    $database = new Database();
    $db = $database->dbConnection();
    //$this->conn = $db;
    $query = 'INSERT INTO books
                 (title, genre, review, name, email, link)
              VALUES
                 (:title, :genre, :review, :name, :email, :link)';
    $statement = $db->prepare($query);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':genre', $genre);
    $statement->bindValue(':review', $review);
    $statement->bindParam(':name', $name);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':link', $link);

    $statement->execute();
    $statement->closeCursor();
}

function edit_book($book_id, $title, $genre, $review, $name, $email, $link) {
   // $conn;
    require_once('db.php');
    $database = new Database();
    $db = $database->dbConnection();
    //$this->conn = $db;
    $query = "UPDATE books SET title = :title, genre = :genre, review = :review , name = :name, email=:email, link=:link WHERE book_id = :book_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':book_id', $book_id);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':genre', $genre);
    $statement->bindValue(':review', $review);
    $statement->bindParam(':name', $name);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':link', $link);

    
    $statement->execute();
    $statement->closeCursor();
}


?>