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
		<a class="navbar-brand">QR Code - Edit URL Page</a>

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

	<div class="card">


	</div>
</div>

<div class="container-fluid">
	<div class="container-fluid">
		<div class="container-fluid"><br>
			
			<form method="POST" action="{{ action('Controller@editUrl', $id) }}">
				@csrf
			<div class="card-body"> 
				{!! QrCode::size(100)->generate($url->short_url); !!}
			</div>

			<div class="card-body">Short URL<br>
				<input class="form-control col-sm-5" type="text" placeholder="{{ $url->short_url }}" readonly>
			</div>

			<div class="card-body">Your URL here<br>
				<input class="form-control col-sm-5" type="text">
			</div>

			<div class="card-body">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>

		</div>
	</div>
</div>



</body>
</html>