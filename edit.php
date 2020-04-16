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



/*function file_is_an_image($temporary_path, $new_path) {
        $allowed_mime_types      = ['image/gif', 'image/jpeg', 'image/png'];
        $allowed_file_extensions = ['gif', 'jpg', 'jpeg', 'png'];
        
        $actual_file_extension   = pathinfo($new_path, PATHINFO_EXTENSION);
        $actual_mime_type        = getimagesize($temporary_path)['mime'];
        
        $file_extension_is_valid = in_array($actual_file_extension, $allowed_file_extensions);
        $mime_type_is_valid      = in_array($actual_mime_type, $allowed_mime_types);
        
        return $file_extension_is_valid && $mime_type_is_valid;
    }

$image_upload_detected = isset($_FILES['image']) && ($_FILES['image']['error'] === 0);

if ($image_upload_detected) { 
    $image_filename       = $_FILES['image']['name'];
    $temporary_image_path = $_FILES['image']['tmp_name'];
    $new_image_path       = file_upload_path($image_filename);

    if (file_is_an_image($temporary_image_path, $new_image_path)) { 
        move_uploaded_file($temporary_image_path, $new_image_path);
    }
}*/
?>

<?php include("error.php") ?>