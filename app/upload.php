<?php
session_start();

$__allowed_ext = ['jpg', 'png', 'pdf', 'doc', 'docx'];
$__dir_target = __DIR__."/storage/";

// Return to index when we don't find any file to upload
if((!isset($_POST["submit"])) || (count($_FILES) < 1)) {
    header('Location: index.php');
    return;
}

// Fetch extension and file temporary name to hash the file and check the allowed extensions later
$__file_ext = strtolower(pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION));
$__file_hash = hash_file('md5', $_FILES["file"]["tmp_name"]);

// Build name based on the File hash and given extensions
$__file_alternate_name = $__file_hash. '.' .$__file_ext;
$__file_target = $__dir_target . $__file_alternate_name;

// Check if it's allowed extensions
/* if(!in_array($__file_ext, $__allowed_ext)) {
    $_SESSION['upload_status'] = false;
    $_SESSION['upload_message'] = "File extension not allowed.";
    header('Location: index.php'); return;
} */

// Notify to user for success upload
if (move_uploaded_file($_FILES["file"]["tmp_name"], $__file_target)) {
    $_SESSION['upload_status'] = true;
    $_SESSION['upload_message'] = "Uploaded at http://localhost:8080/storage/".$__file_alternate_name;
} else {
    $_SESSION['upload_status'] = false;
    $_SESSION['upload_message'] = "Failed to upload, try again.";
}
header('Location: index.php');

?>