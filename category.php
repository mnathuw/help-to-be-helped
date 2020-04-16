<?php 
    require("connect.php");
    require("validate.php");

    if(validatePost()){
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);/*
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);*/
        
        $query = "INSERT INTO category (category_name) VALUES (:Title)";
        $statement = $db->prepare($query);

        $statement ->bindValue(':Title', $title);

        $statement->execute();

        header("Location: index.php");
    }
?>

<?php include("error.php") ?>