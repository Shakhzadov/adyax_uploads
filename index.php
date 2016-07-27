<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Завантаження файлів</title>
	<style>
		form {
			width: 400px;
			margin: 50px auto;
			text-align: center;
		}
	</style>
</head>
<body>
	<form action="upload.php" method="POST" enctype="multipart/form-data">
		<h2>Виберіть файли для завантаження</h2>
		<input type="file" name="filename"/>
		<input type="submit" value="Завантажити"/>		
	</form>
	
	<h2>Files</h2>

	<?php
		$handle = opendir('uploads/');
		if($handle) {
			while(($entry = readdir($handle)) !== false) {
				if($entry != '.' && $entry != '..') {
					echo "<a href='uploads/$entry'>$entry</a><br/>";
				}
			}
			closedir($handle);
		}
	?>

</body>
</html>