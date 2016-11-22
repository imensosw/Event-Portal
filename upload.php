<?php
$dir = $_POST['path'];

move_uploaded_file($_FILES["image"]["tmp_name"], $dir.time().$_FILES["image"]["name"]);
?>