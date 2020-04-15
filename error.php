<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Error Occured</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div id="wrapper">
        <header id="pageHeader">Error:</header>
        <div id="errorMessage">       
            <?php if(isTitleToBig()): ?>
                <p class="title"> Title must be under 30 characters.</p>
            <?php endif ?>
            
            <?php if(isContentToBig()): ?>
                <p class="title">Content must be under 2000 characters.</p>
            <?php endif ?>
            <?php if(isTitleEmpty()): ?>
                <p class="title">Title cannot be empty.</p>
            <?php endif ?>
            
            <?php if(isContentEmpty()): ?>
                <p class="title">Content cannot be empty. </p>
            <?php endif ?>  

            <!--name of category-->

        </div>
        <footer>Copywong 2020 - No Rights Reserved</footer>
    </div>
</body>
</html>