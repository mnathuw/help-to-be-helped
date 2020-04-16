<?php 
    require("connect.php");
    require("validate.php");
var_dump($_FILES);
if(validatePost()){
    $title   = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $id      = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    // Get image name
    $image = $_FILES['image']['name'];

    // image file directory
    $target = "uploads/".basename($image);

    if(isset($_POST['submit'])){
        // Build the parameterized SQL query and bind to the above sanitized values.
        $query     = "UPDATE task SET task_type = :title, task_description = :content, image = :image  WHERE task_code = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':title', $title);        
        $statement->bindValue(':content', $content);
        $statement->bindValue(':image', $image);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        
        // Execute the INSERT.
        $statement->execute();
        
        // Redirect after update.
        header("Location: index.php");
        exit;  
    }else if(isset($_POST['delete'])){
        $query     = "DELETE FROM task WHERE task_code = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        // Execute the INSERT.
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