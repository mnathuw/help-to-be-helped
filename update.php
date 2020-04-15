<?php 
    require("connect.php");
    require("validate.php");

    
    if(validatePost()){
        $title   = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       
        $id      = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        
        if(isset($_POST['submit'])){
            // Build the parameterized SQL query and bind to the above sanitized values.
            $query     = "UPDATE category SET category_name = :title, WHERE category_code = :id";
            $statement = $db->prepare($query);
            $statement->bindValue(':title', $title);        
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            
            // Execute the INSERT.
            $statement->execute();
            
            // Redirect after update.
            header("Location: admin.php");
            exit;  
        }else if(isset($_POST['delete'])){
            $query     = "DELETE FROM category WHERE category_code = :id";
            $statement = $db->prepare($query);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            // Execute the INSERT.
            $statement->execute();

            header("Location: admin.php");
        }

    }
?>
