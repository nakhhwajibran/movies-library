<?php
include 'db_connection.php';
$postData = $_POST;
$target_dir = "images/";
$arr = explode(' ',trim($postData['title']));
$file_name = strtolower($arr[0].'.png');
$target_file = $target_dir . $file_name;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_FILES)) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        $message = "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $message = "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    $message = "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["file"]["size"] > 500000) {
    $message =  "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $message = "Sorry, your file was not uploaded.";
    $message1 = "Error";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $message = "The file ". $file_name . " has been uploaded.";
        $success = true;
        $title = $postData['title'];
        $year = $postData['year'];
        $rating = $postData['rating'];
        $img_src_name = $file_name;
        $date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO movie_list (title, year, img_src , status , created , modified , rating ) VALUES ('".$title."','".$year."','".$img_src_name."',1,'".$date."','".$date."',".$rating.")";
        $result = $conn->query($sql);
        $message1 = "Successfully";
        $last_id = $conn->insert_id;

    } else {
        $message = "Sorry, there was an error uploading your file.";
        $success = false;
        $result = false;
        $message1 = "Error";
    }
}
$response = array(
        'message' => $message,
        'message1' => $message1,
        'success' => $success,
        'fileName' => $file_name,
        'year' => $year,
        'rating' => $rating,
        'title' => $title,
        'id' => isset($last_id) ? $last_id : 0,
        'result' => $result
);

echo json_encode($response);
exit;