<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Flight Create</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="">
</head>
<body>
	<form action="/flights" method="post">
		@csrf
		<label for="name">Name</label><br>
		<input type="text" name="name" id="name"><br>
		<button type="submit">Send</button>
		
		
	</form>
	
</body>
</html>