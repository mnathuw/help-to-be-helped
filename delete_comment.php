<?php
$connect = new PDO('mysql:host=localhost;dbname=project', 'root', '');


$comment_id = $_POST['comment_id'];

$sql_del = "DELETE FROM tbl_comment WHERE id = $comment_id";
$stmt = $connect->prepare($sql_del);
$stmt->execute();

if (! empty($stmt)) {
    echo true;
}
?>