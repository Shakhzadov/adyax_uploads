<?php

if(isset($_FILES['filename'])) {	
	$file = $_FILES['filename'];
	$name = $file['name'];
	$type = $file['type'];
	$tmp_location = $file['tmp_name'];
	$final_destination = 'uploads/'.$name;
	$error = $file['error'];
	$max_upload_size = 2097152;
	$size = $file['size'];

	if($error > 0 || is_array($error)) {
		die('Sorry an error occured');
	}

	if(file_exists($final_destination)) {
		die('Sorry that file already exist');
	}

	if(!move_uploaded_file($tmp_location, $final_destination)) {
		die('Cannot finish upload, something went wrong');
	}
}

?>

<h2>File Successfully Uploaded!</h2>
