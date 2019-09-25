<?php
include 'db_connection.php';
$postData = $_POST;
$id = $postData['id'];
$sql = "UPDATE movie_list SET status = 0 WHERE id = ".$id;
$result = $conn->query($sql);
if($result){
    echo  "SuccessFully";
    exit;
}
else{
    echo "UnsuccessFully";
    exit;
}