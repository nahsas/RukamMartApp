<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Buy Item</title>
</head>
<body>
	<a href="{{route('item.index')}}"><button>Back</button></a>
	<h1>Please scan the barcode</h1>
	<form action="{{route('item.proccess')}}" method="POST">
		@csrf
		<input type="text" id="barcode" name="barcode" autofocus>
	</form>
</body>
</html>