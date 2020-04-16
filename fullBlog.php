<?php 
    require('connect.php');


    if(isset($_GET['id'])){
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        $query     = "SELECT * FROM task WHERE task_code = :id LIMIT 1";
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
    <title>Help to be helped - <?= $row['task_type'] ?></title>
    <link rel="stylesheet" href="main.css">

    <!-- comment ( AJAX, BOOTSTRAP)-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

    <!--Captcha-->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
        
    <div id="fullPost">
        <header class="title"><?= $row['task_type'] ?></header>
        <p class="date"><?= date("F d, Y, h:m a", strtotime($row['DatePosted'])) ?> <a href="post.php?id=<?= $row['task_code'] ?>"> Edit</a></p>
        <p class="content"><?= htmlspecialchars_decode($row['task_description']) ?></p>


        <!--pic-->
        <img src="uploads/<?= $row['image'] ?>" style="width: 50%">
    </div>      

    <div class="container">
        <form method="POST" id="comment_form">
            <div class="form-group">
                <input type="text" name="comment_name" id="comment_name" class="form-control" placeholder="Enter Name" style="width: 480px" />
            </div>
            <div class="form-group">
                <textarea name="comment_content" id="comment_content" class="form-control" placeholder="Enter Comment" cols="60" rows="5"></textarea>
            </div>
            <div class="form-group">
                <input type="hidden" name="comment_id" id="comment_id" value="0" />


                <!--API tinymce-->
                <div class="g-recaptcha" data-sitekey="6Le_4uYUAAAAAA-TxEJilKewFl0Q7nPSBaptEkgo"></div>
                <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />


            </div>
        </form>
        <span id="comment_message"></span>
        <br />
        <div id="display_comment"></div>
    </div>



        <footer>Copywong 2020 - No Rights Reserved</footer>
    </div>
</body>
</html>


<script>
$(document).ready(function(){



 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
   url:"add_comment.php",
   method:"POST",
   data:form_data,
   dataType:"JSON",
   success:function(data)
   {
    if(data.error != '')
    {
        $('#comment_form')[0].reset();
        $('#comment_message').html(data.error);
        $('#comment_id').val('0');
        grecaptcha.reset();
        load_comment();
    }
   }
  })
 });

 load_comment();

 function load_comment()
 {
  $.ajax({
   url:"fetch_comment.php",
   method:"POST",
   success:function(data)
   {
    $('#display_comment').html(data);
   }
  })
 }

 $(document).on('click', '.reply', function(){
  var comment_id = $(this).attr("id");
  $('#comment_id').val(comment_id);
  $('#comment_name').focus();
 });
 


});
</script>
