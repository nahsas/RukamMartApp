<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Transaction</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 20px;
			padding: 0;
			background-color: #f4f4f4;
		}
		h2, h4 {
			color: #333;
		}
		h4 {
			margin-bottom: 10px;
		}
		button {
			background-color: #007bff;
			color: white;
			border: none;
			padding: 10px 20px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin: 10px 0;
			cursor: pointer;
			border-radius: 5px;
		}
		button:hover {
			background-color: #0056b3;
		}
		table {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 20px;
		}
		table, th, td {
			border: 1px solid #ddd;
		}
		th, td {
			padding: 8px;
			text-align: center;
		}
		th {
			background-color: #007bff;
			color: white;
		}
		td {
			background-color: #fff;
		}
		td.status-uncomplete {
			background-color: red;
			color: white;
		}
		td.status-complete {
			background-color: #4CAF50;
			color: white;
		}
	</style>
</head>
<body>
	<?php use App\Http\Controllers\TransactionController; ?>
	<a href="{{route('user.index')}}"><button>Back</button></a>
	<a href="{{route('transaction.make')}}"><button>Make transaction</button></a>
	<h4>Cashier</h4>
	<h2>{{session('fullname')}}</h2>
	<table>
		<thead>
			<tr>
				<th>Status</th>
				<th>Transaction ID</th>
				<th>Total</th>
				<th>Money Paid</th>
				<th>Transaction Date</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($datas as $data)
			<tr>
				@if(TransactionController::transactionStatus($data['success']) == 'UnComplete')
					<td class="status-uncomplete">Not complete</td>
				@endif
				@if(TransactionController::transactionStatus($data['success']) == 'Complete')
					<td class="status-complete">Complete</td>
				@endif
				<td>{{$data['id']}}</td>
				<td>{{$data['total']}}</td>
				<td>{{$data['moneyPaid']}}</td>
				<td>{{$data->transaction_date}}</td>
				@if(TransactionController::transactionStatus($data['success']) == 'UnComplete')
					<td><a href="{{route('transaction.start', $data->id)}}"><button>Open transaction</button></a></td>
				@endif
				@if(TransactionController::transactionStatus($data['success']) == 'Complete')
					<td><a href="{{route('transaction.history', $data->id)}}"><button>See history</button></a></td>
				@endif
			</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>
