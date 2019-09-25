<?php
include 'db_connection.php';
$postData = $_POST;
$search = isset($postData['value']) && $postData['value'] != '' ? $postData['value'] : '';
$sort_by = isset($postData['sort_by']) && $postData['sort_by'] != '' ? $postData['sort_by'] : 'title';
$order_by = isset($postData['order_by']) && $postData['order_by'] != '' ? $postData['order_by'] : 'ASC';
$query = "SELECT * FROM movie_list WHERE status = 1 AND title LIKE '%".$search."%' ORDER BY ". $sort_by ." ". $order_by ." LIMIT 10";
$result = $conn->query($query);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $myArray[] = $row;
}
echo !empty($myArray) ? json_encode($myArray) : '';
exit;