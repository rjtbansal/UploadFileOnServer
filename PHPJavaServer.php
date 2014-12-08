<?php
$myUser = "shivani";
$myPass = "abcdef";
$myServer = "http://wwww.gangania19.com/FantasticPics.php";

function send_stor_cmd($src_file, $target_file, $target_url) {
  global $myServer, $myUser, $myPass;
  $file_name_with_full_path = realpath($src_file);
  if (file_exists($file_name_with_full_path)) {
    $post = array("USER" => $myUser, "PASS" => $myPass, "SRC" =>$myServer, "CMD" => "STOR", "FILE" => $target_file, "file_contents" => "@" . $file_name_with_full_path);  
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $target_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);
    curl_close($ch);
    echo $result;
  } else {
    echo "Error file to send not found";
  }
}

$target_path = "images/"; 
$target_path = $target_path . basename( $_FILES['uploaded_file']['name']); 
if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $target_path)) { 
    echo "The file ". basename($_FILES['uploaded_file']['name'])." has been uploaded"; 
} else{ 
    echo "There was an error uploading the file, please try again!"; 
}
send_stor_cmd($target_path, $target_path, "http://www.kbeadle.com/fp/fantasticpics.php");
?>

