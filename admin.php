<?php 
    //Connect to Database
    require("connect.php");

    //Construct SQL statement aquiring all values from newest 10 tasks.
    $query = "SELECT * FROM category ORDER BY category_code DESC LIMIT 10";

    $statement = $db->prepare($query);

    $statement->execute(); 

    // Initialize the session
    session_start();
     

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Help to be helped</title>
    <link rel="stylesheet" href="main.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <!-- 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
        h1{
            font-size: 15px;
        }
    </style>
    
</head>
<body>
    <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true):?>
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our community.</h1>
        <a href="reset-password.php" class="btn btn-warning">Reset Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out</a>
    <?php endif ?>


    <div id="wrapper">
        <header id="pageHeader">Help to be helped</header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="post.php">Create Task</a></li>
                <!--create category-->
                <li><a href="create.php">Create Category</a></li>
                <!--create user-->
                <li><a href="login.php">Login</a></li>

            </ul>
            
        <?php while($row = $statement->fetch()): ?>

            <div class="blogPost">
                <h1 class="title"><?= $row['Title'] ?></h1>
                <p class="date"><?= date("F d, Y, h:m a", strtotime($row['DatePosted'])) ?> <a href="post.php?id=<?= $row['postID'] ?>"> Edit</a></p>
                
                <?php if(strlen($row['Content']) > 200): ?>
                    <p class="content"><?= substr($row['Content'], 0, 200) ?>...</p>
                    <p class="more"><a href="fullBlog.php?id=<?= $row['postID'] ?>">Read Full Post...</a></p>
                
                <?php else: ?>
                    <p class="content"><?= $row['Content'] ?></p>

                <?php endif ?>

            </div>

        <?php endwhile ?>

</body>
</html>

<!-- <script>
$(document).ready(function(){
    load_data();
    function load_data(query)
    {
        $.ajax({
            url:"fetch.php",
            method:"post",
            data:{query:query},
            success:function(data)
            {
                $('#result').html(data);
            }
        });
    }
    
    $('#search_text').keyup(function(){
        var search = $(this).val();
        if(search != '')
        {
            load_data(search);
        }
        else
        {
            load_data();            
        }
    });
});
</script> -->


<script>
  $(document).ready(function(){

    load_data(1);

    function load_data(page, query = '')
    {
      $.ajax({
        url:"fetch.php",
        method:"POST",
        data:{page:page, query:query},
        success:function(data)
        {
          $('#dynamic_content').html(data);
        }
      });
    }

    $(document).on('click', '.page-link', function(){
      var page = $(this).data('page_number');
      var query = $('#search_box').val();
      load_data(page, query);
    });

    $('#search_box').keyup(function(){
      var query = $('#search_box').val();
      load_data(1, query);
    });

  });
</script>
