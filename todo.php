<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = 'todo_list';
// Create connection
$con = mysqli_connect($servername, $username, $password, $database);


if (isset($_POST['action']) && $_POST['action']=="add") {
    $input_todo = isset($_POST['inputodo']) ? clean_input($_POST['inputodo']) : '';
    if ($input_todo == '') {
        $url='todo_app.php?error=Todo is null.';
        header('location:'.$url);
        die();
    }
    
    $sql = "INSERT INTO `todo_list`(`task`, `created_date`) VALUES ('$input_todo',NOW())";    
    $data = mysqli_query($con, $sql);
    $url='todo_app.php?success=Todo added succesfully.';
    header('location:'.$url);
    
}
if (isset($_POST['action']) && $_POST['action']=="edit") {
    $user_id = $_POST['user_id'];    
    $input_todo = isset($_POST['inputodo']) ? clean_input($_POST['inputodo']) : '';
    $sql = "UPDATE `todo_list` SET `task`='$input_todo',`update_date`=NOW() WHERE `id` = '$user_id'";    
    $data = mysqli_query($con, $sql);
    $url='todo_app.php?success=Todo Updated succesfully.';
    header('location:'.$url);
    die();
}
if (isset($_GET['action']) && $_GET['action']=="delete") {
    $user_id = $_GET['user_id'];
    $sql = "DELETE FROM `todo_list` WHERE `id` = '$user_id'";
    $data = mysqli_query($con, $sql);
    $url='todo_app.php?success=Todo deleted succesfully.';
    header('location:'.$url);
}
if (isset($_GET['action']) && $_GET['action']=="edit") {
    $user_id = $_GET['user_id'];
    $sql = "SELECT * FROM `todo_list` WHERE `id` = '$user_id'";
    $editdata = mysqli_query($con, $sql);
    $fetch_datas = array();
    while ($fetch_data = mysqli_fetch_assoc($editdata)) {
        $fetch_datas[] = $fetch_data;
    }
    
    
}

else{
    $sql = "SELECT * FROM `todo_list`";
    $data = mysqli_query($con, $sql);
    $results = array();
    while ($result = mysqli_fetch_assoc($data)) {
        $results[] = $result;
    }    
}
