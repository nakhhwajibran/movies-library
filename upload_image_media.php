<?php
$target_dir = "images/";
$file_name = basename($_FILES["file"]["name"]);
if($_POST['img_name'] != ''){
    $arr = explode(' ',trim($_POST['img_name']));
    $file_name = strtolower($arr[0].'.png');
}
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
        $message = "The file ". $target_file . " has been uploaded.";
        $success = true;
        $message1 = "Successfully";
    } else {
        $message = "Sorry, there was an error uploading your file.";
        $success = false;
        $message1 = "Error";
    }
}
 $response = array(
     'message' => $message,
     'message1' => $message1,
     'success' => $success,
     'fileName' => $file_name,
     'fileName' => $file_name,
     'fileName' => $file_name,
 );
echo json_encode($response);
exit;
?>