<?php 
    require("connect.php");
    require("validate.php");

/*    if(validatePost()){
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
        
        $query = "INSERT INTO task (task_type, task_description, DatePosted) VALUES (:Title, :Content, CURRENT_TIMESTAMP)";
        $statement = $db->prepare($query);

        $statement ->bindValue(':Title', $title);
        $statement ->bindValue(':Content', $content);

        $statement->execute();

        header("Location: index.php");
    }*/

      // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['submit'])) {



    if(validatePost()){
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
            
        // Get image name
        $image = $_FILES['image']['name'];

        // image file directory
        $target = "uploads/".basename($image);

        //$sql = "INSERT INTO images (image, image_text) VALUES ('$image', '$image_text')";
        $query = "INSERT INTO task (task_type, task_description, image, DatePosted) VALUES (:Title, :Content, '$image', CURRENT_TIMESTAMP)";
        $statement = $db->prepare($query);

        $statement ->bindValue(':Title', $title);
        $statement ->bindValue(':Content', $content);

        $statement->execute();

        header("Location: index.php");
    }



  }
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
      $msg = "Image uploaded successfully";
    }else{
      $msg = "Failed to upload image";
    }

?>

<?php include("error.php") ?>