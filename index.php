<?php 
    //Connect to Database
    require("connect.php");

    //Construct SQL statement aquiring all values from newest 10 tasks.
    $query = "SELECT * FROM task ORDER BY DatePosted DESC LIMIT 10";

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
            <!--if no post-->
            <?php if($statement->rowCount() <= 0 ):?>
                <p>No task</p>
                <p><a href="post.php">Create one...</a></p>
            <?php endif ?>

        </nav>




        <div class="container">
              <br />
              <div class="card">
                <div class="card-body">
                  <div class="form-group">
                    <input type="text" name="search_box" id="search_box" class="form-control" placeholder="Counselling" />
                  </div>
                  <div class="table-responsive" id="dynamic_content">
                    
                  </div>
                </div>
              </div>
        </div>


            

            <?php while($row = $statement->fetch()): ?>

            <div class="blogPost">
                <h1 class="title"><a href="fullBlog.php?id=<?= $row['task_code'] ?>"><?= $row['task_type'] ?></a></h1>
                <p class="date"><?= date("F d, Y, h:m a", strtotime($row['DatePosted'])) ?> <a href="post.php?id=<?= $row['task_code'] ?>"> Edit</a></p>
                
                <?php if(strlen($row['task_description']) > 200): ?>
                    <p class="content"><?= substr($row['task_description'], 0, 200) ?>...</p>
                    <p class="more"><a href="fullBlog.php?id=<?= $row['task_code'] ?>">Read Full Post...</a></p>
                
                <?php else: ?>
                    <p class="content"><?= $row['task_description'] ?></p>

                <?php endif ?>

            </div>

            <?php endwhile ?>   
    </div>


</body>
</html>



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
