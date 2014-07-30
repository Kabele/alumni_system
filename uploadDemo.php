<!DOCTYPE html>
<html>
<head>
<title>File Upload Demo</title>
</head>

<body>

<form method = "POST" action="classWork/FileUploader.php" enctype="multipart/form-data">
	<p>Username: <input type="text" name="frmUserName" /></p>
    <p>Photo: <input type="file" name="frmFileName" /></p>
    <input type="submit" name="frmSubmit" value="Upload my Photo" />
</form>

</body>
</html>