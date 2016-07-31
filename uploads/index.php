<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Завантаження файлів</title>
</head>
<body>
	<form action="upload.php" method="post" enctype="multipart/form-data">
		<h1>Виберіть файли для завантаження</h1>
		<input type="hidden" name="MAX_FILE_SIZE" value="10000"/>
		<label for=""><input type="file" name="filename" multiple/></label>
		<input type="submit" value="Завантажити"/>		
	</form>
</body>
</html>