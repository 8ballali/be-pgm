<!DOCTYPE html>
<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Laporan Booking</h4>

	</center>

	<table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Customer Name</th>
                <th>Blok</th>
                <th>No Kavling</th>
                <th>Type</th>
                <th>Luas Tanah</th>
                <th>Tanah Lebih</th>
                <th>Status</th>
            </tr>
        </thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($booking as $b)
			<tr>
				<td>{{ $i++ }}</td>
                <td>{{$b->customer->name}}</td>
                <td>{{$b->product->blok}}</td>
                <td>{{$b->product->no_kavling}}</td>
                <td>{{$b->product->type}}</td>
                <td>{{$b->product->luas_tanah}}</td>
                <td>{{$b->product->tanah_lebih}}</td>
                <td>{{$b->status_booking->name}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</body>
</html>
