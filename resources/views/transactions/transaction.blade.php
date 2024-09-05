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
			cursor: pointer;
			border-radius: 5px;
		}
		button.red {
			background-color: red;
			color: white;
			border: none;
			padding: 10px 20px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			cursor: pointer;
			border-radius: 5px;
			margin: auto;
		}

		button:hover {
			background-color: #0056b3;
		}
		form {
			margin-bottom: 20px;
		}
		table {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 20px;
		}
		table, th, td {
			border: 2px solid #ddd;
		}
		td {
			text-align: center;
		}
		th{
			text-align: center;
			padding: 8px;
		}
		th.blue {
			background-color: #007bff;
			color: white;
		}
		th.green{
			background-color: limegreen;
			color: white;			
		}
		td input {
			border: none;
			text-align: center;
			background-color: #f4f4f4;
			width: 100%;
		}
		.error {
			color: red;
			margin-top: 10px;
		}
		.total-table {
			margin-top: 20px;
		}
		.total-table th {
			text-align: left;
			background-color: #f9f9f9;
		}
		.total-table td {
			text-align: right;
		}
		.margin{
			padding-top: 20px;
		}
		.confirmation{
			display: none;
			width:100%;
			height: 100%;
			background-color: rgba(255, 255, 255, 0.7);
			opacity: 1;
			position: fixed;
			top: 0;
			left: 0;
		}
		.container{
			opacity: 1;
			display: block;
			position: relative;
			background-color: white;
			box-shadow: 0px 3px 5px 1px black;
			border-radius: 20px;
			margin: auto;
			margin-top: 10%;
			width: 30%;
			text-align: center;
			padding: 10px;
			height: 250px;
		}
	</style>
</head>
<body>
	<?php use App\Http\Controllers\TransactionController; $total = 0; ?>
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
				<th class="blue">No.</th>
				<th class="blue">Barcode</th>
				<th class="blue">Name</th>
				<th class="blue">Actual price</th>
				<th class="blue">Discount</th>
				<th class="blue">Discount Price</th>
				<th class="blue">Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($items as $item)
			<tr>
				<td>{{$i++}}</td>
				<td><input type="text" name="barcode" readonly value="{{$item?->productCode}}"></td>
				<td><input type="text" name="itemName" readonly value="{{TransactionController::getItem($item?->productCode)['name']}}"></td>
				<td><input type="text" name="" value="Rp.{{number_format(TransactionController::getItem($item?->productCode)['price'],2)}}"></td>
				<td><input type="text" name="" value="{{TransactionController::getItem($item?->productCode)['discount']}}%"></td>
				<td><input type="text" name="price" readonly value="Rp.{{
					number_format(TransactionController::getItem($item?->productCode)['price']-((TransactionController::getItem($item?->productCode)['discount']*TransactionController::getItem($item?->productCode)['price'])/100), 2)
				}}"></td>
				<?php $total += TransactionController::getItem($item?->productCode)['price']-((TransactionController::getItem($item?->productCode)['discount']*TransactionController::getItem($item?->productCode)['price'])/100); ?>
				<td class="margin">
					<form method="POST" action="{{route('transaction.delete',[$transactionId,$item->id])}}">
						<input type="text" name="barcode" hidden value="{{$item?->productCode}}">
						@method('DELETE')
						@csrf
						<button type="submit" class="red">Delete</button>
					</form>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<hr>
		<form method="POST" action="{{route('transaction.add')}}">
		@csrf
		<input type="text" name="transactionId" value="{{$transactionId}}" hidden>
		<table>
			<thead>
				<tr>
					<th class="blue">Barcode/Product name</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><input type="text" name="barcode" placeholder="Enter barcode or product name.." autofocus style="border: 1px solid black;padding: 10px;"></td>
				</tr>
			</tbody>
		</table>
		<div class="error">{{$error}}</div>
		<button type="submit" style="display: none;">Add</button>
	</form>
	<table>
		<thead>
			<tr>
				<th class="green">Total</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<input type="text" name="total" readonly value="Rp.{{number_format($total, 2)}}">
				</td>	
			</tr>
		</tbody>
	</table>

	<button onclick="pay()">Pay</button>
	<div class="confirmation">
		<div class="container">
			<a onclick="closePay();" href="#" style="text-align: left;">X</a>
			<h1>Proccess payment</h1>
			<form method="post" action="{{route('transaction.pay',$transactionId)}}">
				@csrf
				<table>
					<tr>
						<td>Total : Rp.{{number_format($total,2)}}</td>
					</tr>
					<tr>
						<td  style="padding-bottom: 20px;"><input type="text" name="total" value="{{$total}}" hidden></td>
					</tr>
					<tr>
						<td ><input style="padding:8px 0px 8px;" type="number" name="pay" placeholder="Enter payment nominal..."></td>
					</tr>
				</table>
				<button type="submit">Pay</button>
			</form>
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
	function pay() {
		document.querySelector('.confirmation').style.display = "block";	
	}	
	function closePay() {
		document.querySelector('.confirmation').style.display = "none";	
	}
</script>