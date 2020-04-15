<?php 
    function validatePost()
    {
        if(!validateContent()){
            return false;
        }

        if(!validateTitle()){
            return false;
        }

        
        return true;
    }

    function validateContent()
    {
        if($_POST['content'] != '' && strlen($_POST['content']) < 2001){
            return true;
        }
        
        return false;
    }

    function validateTitle(){
        if($_POST['title'] != '' && strlen($_POST['title']) < 31){
            return true;
        }
        return false;
    }


    function isContentEmpty()
    {
        if($_POST['content'] == ''){
            return true;
        }
        return false;
    }

    function isContentToBig()
    {
        if(strlen($_POST['content']) > 2000){
            return true;
        }
        return false;
    }

    function isTitleEmpty()
    {
        if($_POST['title'] == ''){
            return true;
        }
        return false;
    }

    function isTitleToBig()
    {
        if(strlen($_POST['title']) > 30){
            return true;
        }
        return false;
    }

?>