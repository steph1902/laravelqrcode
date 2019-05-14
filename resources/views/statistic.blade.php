<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>
  
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

  <div class="container-fluid">
      <table class="table">
        <tr>
          <td>
            <canvas id="pieChart" height="140" width="300"></canvas>
          </td>
        </tr>    
      </table>
    
  </div>
  <div class="container-fluid">
    <div class="container-fluid">
      <div class="card-body"> 
        Range Waktu
        <table class="table">
          <tr>
            <td><input type="date"></td>
            <td><input type="date"></td>
            <td><button type="submit" class="btn btn-primary float-right">Apply</button></td>
            <td> 
              <a href=""> 
                <img src="{{ asset('svg/data-transfer-download.svg') }}" alt="icon name" class="icon"> 
              </a>
            </td>
            <td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td>            
          </tr>
        </table>
      </div>
    </div>
  </div>


</body>
<script>
        var url = "{{url('googleanalytics')}}";
        // var Years = new Array();
        // var Labels = new Array();
        // var Prices = new Array();
        var Countries = new Array();
        var Visitors = new Array();

        $(document).ready(function()
        {
          $.get(url, function(response)
          {
            response.forEach(function(data)
            {
                Countries.push(data.rows[0]['country']);
                Visitors.push(data.rows[4]['users']);
                // Years.push(data.stockYear);
                // Labels.push(data.stockName);
                // Prices.push(data.stockPrice);
            });

            var ctx = document.getElementById("pieChart").getContext('2d');

                var myChart = new Chart(ctx, 
                {
                  type: 'bar',
                  data: 
                  {
                      labels:Countries,
                      datasets: 
                      [{
                          label: 'Total Visitors by Geographic',
                          data: Visitors,
                          borderWidth: 1
                      }]
                  },
                  options: 
                  {
                      scales: 
                      {
                          yAxes: 
                          [{
                              ticks: 
                              {
                                  beginAtZero:true
                              }
                          }]
                      }
                  }
              });
          });
        });
        </script>


</html>


