<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<title></title>



	<style>
		.icon {
			width: 16px;
			height: 16px;
		}
	</style>
</head>
<body>

	<nav class="navbar navbar-light bg-light justify-content-between">
		<a class="navbar-brand">QR Code - Dashboard</a>

		<form class="form-inline">
			<!-- <input class="form-control <main></main>r-sm-2" type="search" placeholder="Search" aria-label="Search"> -->

			<a href=" {{ url('changepasswordpage') }}">
				<img src="{{ asset('svg/people.svg') }}" alt="icon name" class="icon float-right">
			</a>
			<div>&nbsp &nbsp &nbsp &nbsp &nbsp</div>
			
			<a href="{{ url('logout') }}">
				<img src="{{ asset('svg/account-logout.svg') }}" alt="icon name" class="icon float-right">
			</a>

			<!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
		</form>
	</nav>

	<div class="container-fluid">
		<div class="container-fluid">
			<br />
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div><br />
    @endif
			<p class="text-left"><p class="font-weight-light">Kredit</p></p>
			<p class="text-left"><p class="font-weight-light">2/10</p></p>

			<form method="POST" action="{{ url('addurl') }}">
				@csrf
				<button type="submit" class="btn btn-primary float-right">Add URL</button>
			</form>


			<table class="table">
				<thead>
					<tr>
						<th scope="col">QR</th>
						<th scope="col">URL</th>
						<!-- <th scope="col">Last</th> -->
						<!-- <th scope="col">Handle</th> -->
					</tr>
				</thead>
				<tbody>

					@foreach($urls as $url)
					<tr>
						<th scope="row">{!! QrCode::size(100)->generate($url->short_url); !!}</th>
						<td> {{$url->short_url}} </td>
						<td> 
							<a href="{{ action('Controller@downloadQrCode', $url->id) }}"> 
								<img src="{{ asset('svg/data-transfer-download.svg') }}" alt="icon name" class="icon"> 
							</a>
						</td>
						<td>
							<a href="{{ action('Controller@getEditUrlPage',$url->id) }}">
								<img src="{{ asset('svg/pencil.svg') }}" alt="icon name" class="icon">
							</a>
						</td>
						<td>
							<img src="{{ asset('svg/graph.svg') }}" alt="icon name" class="icon">
						</td>
						<!-- <td>Otto</td> -->
						<!-- <td>@mdo</td> -->
					</tr>
					@endforeach
				</tbody>
			</table>
			
			<center>
				<p class="text-center">
					{{$urls->links()}}
				</p>
			</center>
			
		</div>

	</div>

	

</body>
</html>