<?php 
    require('connect.php');


    if(isset($_GET['id'])){
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        $query     = "SELECT * FROM category WHERE category_code = :id LIMIT 1";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);

        $statement->execute();
    }

    $row = $statement->fetch(PDO::FETCH_ASSOC);




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Help to be helped - <?= $row['category_name'] ?></title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div id = "wrapper">
        <header id="pageHeader">Help to be helped</header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="post.php">Create Task</a></li>

                <!--category-->
                <li><a href="create.php">Create Category</a></li>
            </ul>
        </nav>
        
    <div id="fullCat">
      <form method="post" action="update.php">
        <ul>
            <li>
                <label for="title">Category Name: </label> <input type="text" maxlength="30" name="title" id="title" value="<?= $post['category_name'] ?>">
            </li>
            <li><input type="submit"  name="submit" id="submit" value="Save Changes"> <input type="submit" name="delete" id="delete" value="Delete Category"></li>
        </ul>
      </form>

    </div>     
        <footer>Copywong 2020 - No Rights Reserved</footer>
    </div>
</body>
</html>


