
<!--<?php include 'header.php';?>-->

<div class="container">

  <h3>Book List</h3>
    
    <a href="../controller/index.php?action=get_add_form">Add items</a>
    <form method="get" action="../controller/index.php">
        <input type="hidden" name="action" value="search">
    <div>
      <label for="keywords"> Search a book:</label>
      <input type="text" name="keywords"/>
        <input type="submit" value="Search" class="btn btn-secondary"/>
    </div>
    
  </form>
    
  <?php

    echo '<table class="table table-striped table-hover"><thead><th>Title</th><th>Genre</th><th>Review</th><th>Name</th><th>Email</th><th>Link</th><th> Edit </th><th> Delete </th></thead><tbody>';
    
    //loop through data create a new table row for each record 
    
    foreach ($books as $book) {
      echo '<tr>
          <td>' . $book['title'] . '</td>
          <td>' . $book['genre'] . '</td>
          <td>' . $book['review'] . '</td>
          <td>' . $book['name'] . '</td>
          <td>' . $book['email'] . '</td>
          <td><a href="' . $book['link'] . '">Buy Book</a></td>
          <td><a href="../controller/index.php?action=get_add_form&amp;user_id&amp;book_id=' . $book['book_id']. '">Edit </a></td>
          <td><a href="../controller/index.php?action=delete_book&amp; user_id&amp;book_id=' . $book['book_id'] .'"onclick="return confirm(\'You are going to delete a record, are you sure?\'); "> Delete </a></td>
      </tr>';

  
    }
    
    //close the table
    
    echo   '</tbody></table>';

  ?>
  </div>

<?php include 'footer.php';?>