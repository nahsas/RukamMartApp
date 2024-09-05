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
		h2, h4, h6 {
			color: #333;
		}
		h2 {
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
			background-color: #45a049;
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
		td input {
			border: none;
			text-align: center;
			background-color: #f4f4f4;
			width: 100%;
		}
		hr {
			margin: 20px 0;
			border: none;
			border-top: 1px solid #ddd;
		}
		.total-table {
			margin-top: 20px;
		}
		.total-table th {
			text-align: left;
			background-color: #007bff;
		}
		.total-table td {
			text-align: right;
		}
	</style>
</head>
<body>
	<?php use App\Http\Controllers\TransactionController; $total = 0;?>
	<a href="{{route('transaction.index')}}"><button>Back</button></a>
	<h4>Cashier</h4>
	<h2>{{session('fullname')}}</h2>
	<div>
		<h6>Date : {{$datenow}}</h6>
	</div>
	<div>
		<h6>Transaction Id : {{$transactionId}}</h6>
	</div>
	<hr>
		<table>
			<thead>
				<tr>
					<th>No.</th>
					<th>Barcode</th>
					<th>Name</th>
					<th>Price</th>
				</tr>
			</thead>
			<tbody>
				@foreach($items as $item)
				<tr>
					<td>{{$i++}}</td>
					<td><input type="text" id="tess" name="barcode" readonly value="{{$item?->productCode}}"></td>
					<td><input type="text" name="itemName" readonly value="{{TransactionController::getItem($item?->productCode)['name']}}"></td>
					<td><input type="text" name="price" readonly value="Rp.{{number_format(TransactionController::getItem($item?->productCode)['price'], 2)}}"></td>
					<?php $total += TransactionController::getItem($item?->productCode)['price']; ?>

				</tr>
				@endforeach
			</tbody>
		</table>
	<hr>
	<table class="total-table">
		<tr>
			<th>Total</th>
		</tr>
		<tr>
			<td>
				<input type="text" name="total" readonly value="Rp.{{number_format($total, 2)}}">				
			</td>
		</tr>
	</table>
</body>
</html>
