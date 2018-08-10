

<h1 class="container">Save Your Books</h1>

  <div class="container">

   <form method="post" action="../controller/index.php">
       <input type="hidden" name="action" value="add_book">

       
     <div>
       <label> Title: </label>
       <input type="text" name="title" class="form-control" value="<?php echo $title ?>">
     </div>
       
    <div>
       <label> Genre: </label>
       <input type="text" name="genre" class="form-control" value="<?php echo $genre ?>">
     </div>
     
     <div>    
         <label> Review: </label>         
         <textarea name="review" class="form-control"><?php echo ($review); ?></textarea>     

     </div>
       
     <div>    
       <label> Name: </label>
       <input type="text" name="name" class="form-control" value="<?php echo $name ?>">
     </div>
       
     <div>
       <label> Email: </label>
       <input type="text" name="email" class="form-control" value="<?php echo $email ?>">
     </div>
     
     <div>
       <label> Link: </label>
       <input type="text" name="link" class="form-control" value="<?php echo $link ?>">
     </div>

    
     <input name="book_id" type="hidden", value="<?php echo $book_id ?>">
     <br>
     <input type="submit" class="btn btn-primary" >
   </form>
  </div>
<?php include '../view/footer.php';?>