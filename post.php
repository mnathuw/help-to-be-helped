<?php 
    require("authenticate.php");
    require("connect.php");
    
    if(!isset($_GET['id']) || $_GET['id'] == ''){
        $postType = 'insert';
    }else{
        $postType = 'update';
    }

    if($postType == 'update'){
        if(!filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT)){
            header("Location: index.php");
        }
        
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT task_code, task_type, task_description FROM task WHERE task_code = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        
        $statement->execute();
        $post = $statement->fetch();
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php if($postType == 'insert'): ?>
        <title>Create Task</title>
    <?php elseif($postType == 'update'): ?>
        <title>Edit - <?= $post['task_type'] ?></title>
    <?php endif ?>
    <link rel="stylesheet" href="main.css">
    <script src="https://cdn.tiny.cloud/1/9xg4b41fswm9x6kwhykiopdhwekxea7ysqmnjifws4s8vmbx/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({forced_root_block:"",selector:'textarea'});</script>
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

        <?php if($postType == 'insert'): ?>
            <form action="insert.php" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>New Task</legend>

                    <ul>
                        <li>
                            <label for="title" >Task Type: </label> <input maxlength="30" type="text" name="title" id="title">
                        </li>
                        
                        <li><label for="content">Task Description: </label></li>
                        <li>
                            <textarea name="content" id="content" cols="30" rows="10" maxlength="2000"></textarea>
                        </li>



                        <!--upload-->
                        <li><input type="hidden" name="size" value="1000000">
</li>
                        <li><input type="file" name="image"></li>



                        <li><input type="submit" name="submit" id="submit" ></li>
                    </ul>

                </fieldset>
            </form>
        <?php endif ?>

        <?php if($postType == 'update'): ?>
            <form method="post" action="edit.php" enctype="multipart/form-data">
                <fieldset>
                    <legend>Edit Task</legend>

                    <ul>
                        <li>
                            <label for="title">Task Type: </label> <input type="text" maxlength="30" name="title" id="title" value="<?= $post['task_type'] ?>">
                        </li>
                        
                        <li><label for="content">Task Description: </label></li>
                        <li>
                            <textarea name="content" id="content" cols="30" rows="10"  maxlength="2000"><?= $post['task_description'] ?></textarea>
                        </li>

                        <li><input type="hidden" name = "id" value="<?= $post['task_code'] ?>"></li>



                        <!--upload-->
                        <li><input type="hidden" name="size"  ></li>
                        <li><input type="file" name="image" value="<?= $post['image'] ?>"></li>


                        <li><input type="submit"  name="submit" id="submit" value="Save Changes"> <input type="submit" name="delete" id="delete" value="Delete Task"></li>
                    </ul>

                </fieldset>
            </form>
        <?php endif ?>


        <footer>Copywong 2020 - No Rights Reserved</footer>

    </div>
</body>
</html>