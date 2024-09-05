<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #000000;
			margin: 0;
			padding: 0;
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
			background: linear-gradient(to right, white, whitesmoke);
		}
		.container {
			background: #fff;
			padding: 20px;
			border-radius: 8px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			width: 100%;
			max-width: 400px;
		}
		h1 {
			text-align: center;
			color: #333;
			margin-bottom: 20px;
		}
		.error-message {
			color: #e74c3c;
			background: #fce4e4;
			border: 1px solid #f5c6cb;
			padding: 10px;
			margin-bottom: 20px;
			border-radius: 5px;
		}
		form {
			display: flex;
			flex-direction: column;
		}
		input[type="text"], input[type="password"] {
			padding: 10px;
			margin-bottom: 15px;
			border: 1px solid #ddd;
			border-radius: 5px;
			font-size: 16px;
		}
		button {
			background-color: #007bff;
			color: white;
			border: none;
			padding: 10px;
			border-radius: 5px;
			cursor: pointer;
			font-size: 16px;
			transition: background-color 0.3s ease;
		}
		button:hover {
			background-color: #45a049;
		}
	</style>
</head>
<body>
	<div class="container">
		<h1>Login</h1>

		<!-- Error Messages -->
		@if($errors->any())
		<div class="error-message">
			@foreach($errors->all() as $error)
				<p>{{$error}}</p>
			@endforeach
		</div>
		@endif
		
		@if($login_error != null)
		<div class="error-message">
			<p>{{$login_error}}</p>	
		</div>
		@endif
		<!-- End Error Messages -->

		<form method="POST" action="{{route('user.login')}}">
			@csrf
			<input type="text" name="username" placeholder="Username" required>
			<input type="password" name="password" placeholder="Password" required>
			<button type="submit">Login</button>
		</form>
	</div>
</body>
</html>
