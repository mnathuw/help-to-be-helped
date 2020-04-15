<?php 
    require("connect.php");
    require("authenticate.php");

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT category_code, category_name FROM category WHERE category_code = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    
    $statement->execute();
    $post = $statement->fetch();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Category</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div id="wrapper">

        <header id="pageHeader">Help to be helped</header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="post.php">Create Task</a></li>
                <!--category-->
                <li><a href="create.php">Create Category</a></li>
            </ul>
        </nav>
            <form action="category.php" method="post">
                <fieldset>
                    <legend>New Category</legend>

                    <ul>
                        <li>
                            <label for="title" >Category Name: </label> <input maxlength="30" type="text" name="title" id="title">
                        </li>
                        <li><input type="submit" name="submit" id="submit" ></li>
                    </ul>

                </fieldset>
            </form>



        <footer>Copywong 2020 - No Rights Reserved</footer>

    </div>
</body>
</html>