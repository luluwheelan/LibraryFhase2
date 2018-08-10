
  <?php
  require('header.php'); 
  require_once('connectvars.php');
  echo '<p class="alert alert-info">You searched for the following : ' .$_GET['keywords'] . '</p>';
  //convert to a list with explode 
  $search_words = explode(' ', $_GET['keywords']);
  //build our sql query
  $query = "SELECT * FROM riskyjobs WHERE ";
  //use foreach loop to go through each search term 
  $where = ""; //start by setting to empty string 
  foreach ($search_words as $word) {
    $where = $where . "title LIKE '%$word%' OR "; //add this text on to our where clause for every word in the list - no sure how many times it will iterate
  } 
  // how can we put those together?
  $where = substr($where, 0, strlen($where) - 4);

  $final_sql = $query . $where; 
  //echo $final_sql . "<br/>";
  $cmd = $conn->prepare($final_sql);
  $cmd->execute(); 
  $results = $cmd -> fetchAll();

  // start the grid with HTML
    echo '<table class="table table-striped"><thead><th>Title</th><th>Description</th><th>State</th><th>Date Posted</th></thead><tbody>';

    foreach($results as $result) {
        echo '<tr class="results">';
        echo '<td>' . $result ['title'] . '</td>';
        echo '<td>' . $result ['description'] . '</td>';
        echo '<td>' . $result ['state'] . '</td>';
        echo '<td>' . $result ['date_posted'] . '</td>';
        echo '</tr>';
      } 
      echo '</table>';

     $cmd->closeCursor(); 
     require('footer.php');
    ?>
    