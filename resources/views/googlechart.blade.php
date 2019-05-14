<html>
<head>
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
  
  <!--Load the AJAX API-->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      google.charts.setOnLoadCallback(drawChart2);

      google.charts.setOnLoadCallback(drawChart3);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart()
      {

        // Create the data table.
        var country = {!! json_encode($countries) !!};
        var visitors = {!! json_encode($visitors) !!};
        var record = {!! json_encode($visitors) !!};
        
        var data = new google.visualization.DataTable();

        data.addColumn('string', 'Country');
        data.addColumn('number', 'Visitors');

        for(var i = 0; i < record.length; i++)
        {
          data.addRow([country[i], visitors[i]]);

        }

        // Set chart options
        var options = {
          'title':'Total Visitors by Geographic',
          'width':400,
          'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }

      //chart 2
      function drawChart2()
      {

        // Create the data table.
        var gagdet = {!! json_encode($gagdet) !!};
        var visitors = {!! json_encode($getVisitorByGagdet) !!};
        var record = {!! json_encode($getVisitorByGagdet) !!};
        
        var data = new google.visualization.DataTable();

        data.addColumn('string', 'Gagdet');
        data.addColumn('number', 'Users');

        console.log(gagdet);

        for(var i = 0; i < record.length; i++)
        {
          data.addRow([gagdet[i], visitors[i]]);

        }

        // Set chart options
        var options = {
          'title':'Total Visitors by Gagdet',
          'width':400,
          'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
      }

      //chart 3
      function drawChart3()
      {


        var dailyVisitDate = {!! json_encode($dailyVisitDate) !!};
        var dailyVisitors = {!!json_encode($dailyVisitors) !!};
        var dailyPageView = {!!json_encode($dailyPageView) !!};

        var length = dailyVisitDate.length;
        // console.log(length);

        var data = new google.visualization.DataTable();

        data.addColumn('string', 'Visit Date');
        data.addColumn('number', 'Visitors');
        data.addColumn('number', 'PageView');

        // console.log(gagdet);

        for(var i = 0; i < length; i++)
        {
          data.addRow([ dailyVisitDate[i], dailyVisitors[i], dailyPageView[i] ]);

        }

        // Set chart options
        var options = {
          'title':'Daily Visitors',
          'width':800,
          'height':300,
          'curveType': 'function',
        };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.LineChart(document.getElementById('chart_div3'));
        chart.draw(data, options);
      }


    </script>
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

     <div class="container-fluid">
      <div class="container-fluid">
        <div class="card-body">
         <!--Table and divs that hold the pie charts-->
         <table class="columns">
          <tr>
            <td><div id="chart_div" style="border: 1px solid #ccc"></div></td>
            <td><div id="chart_div2" style="border: 1px solid #ccc"></div></td>
          </tr>
          <tr>
            <td colspan="2"><div id="chart_div3" style="border: 1px solid #ccc"></div></td>
          </tr>
        </table>
        
      </div>
    </div>
  </div>





</body>
</html>