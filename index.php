<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Завантаження файлів</title>
	<style>
		input {
			float: left;
		}
		.title1, .title2 {
			font-size: 20px;
		}
	</style>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

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

<?php 
if(isset($_POST["delete_file"])) {
	$file_name = $_POST["file_name"];
	if($file_name) {
		unlink("uploads/$file_name");
		header("Refresh:0");
	}
}
?>

<?php 
if(isset($_GET['file']) && basename($_GET['file']) == $_GET['file']) {
	$fileName = $_GET['file'];
	$path = 'uploads/'.$fileName;
	if(file_exists($path) && is_readable($path)) {
		$size = filesize($path);
	    header('Content-Type: application/octet_stream');
	    header('Content-Length: '.$size);
	    header('Content-Transfer-Encoding: binary');
	    header('Content-Disposition: attachment; filename='.$fileName);
	    
	    if($file) {
	    	fpassthru($file);
	    	exit;
	    }
	}
}
?>
<body>
	<div class="container well">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4"></div>
			<div class="col-lg-5 col-md-5 col-sm-5">
				<form action="" method="POST" enctype="multipart/form-data">
					<p class="title1">Виберіть файл для завантаження</p>
					<input class="input" type="file" name="filename"/>
					<input type="submit" value="Завантажити"/>		
				</form>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3"></div>
		</div>
	</div>	
	<div class="container well">
		<div class="row">
			<p class="title2">Завантажені файли</p>	
		</div>
		<div class="row">
			<ul class="list-group">
				<li class="list-group-item">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Назва файлу</div>						
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<?php
								$folder = 'uploads/';
								if(is_dir($folder)) {
									if ($handle = opendir($folder)) {
										while(($file = readdir($handle)) != false) {
											if($file != '.' && $file != '..') {
												echo "<a href='uploads/$file'>$file</a><br/>";	
											}		
										}
										closedir($handle);
									}		
								}
							?>
						</div>          	
					</div>
				</li>
			</ul>	 
		</div>
	</div>
	<div class="container well">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4"></div>
			<div class="col-lg-5 col-md-5 col-sm-5">
				<form class = "form2" action="" method="POST">
					<p class="title2">Виберіть ім'я файлу для видалення<br/>(наприклад: dou.jpg)</p>
					<input type="text" name="file_name"/>
					<input type="submit" value="Видалити" name="delete_file"/>		
				</form>	
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3"></div>
		</div>
	</div>
	<div class="container well">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<p class="title2">Виберіть файл для скачування</p>
				<a href="index.php?file=index.php">index.php</a><br/>
				<a href="index.php?file=tickets.html">tickets.html</a><br/>
				<a href="index.php?file=dou.jpg">dou.jpg</a><br/>
			</div>
		</div>
	</div>			 
</body>
</html>