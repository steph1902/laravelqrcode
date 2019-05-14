<html>
<head>
  <!--Load the AJAX API-->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

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
        var chart = new google.visualization.PieChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
      }
    </script>
  </head>

  <body>
    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>
  </body>
  </html>