
<?php


$ext = ".ogg";
$target_dir = "audios/";
$target_dir = $target_dir . $_POST["name"] . "/";

if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
    exec("chmod 777 " . $target_dir);
}

$target_file = $target_dir . "audio";

if (file_exists($target_file  . $ext)) {

    unlink($target_file  . $ext);
}

$target_file = $target_file . $ext;

if (move_uploaded_file($_FILES["audio"]["tmp_name"], $target_file)) {
    exec("chmod 777 " . $target_file);
    echo "ok";
} else
    echo "error";

?>
