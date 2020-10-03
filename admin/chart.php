<div class="row col-12 d-flex justify-content-center text-center align-items-center flex-column">
<div class="col-12 bg-light my-3 border border-3 border-primary">
<h2 class="text-primary">Chart view</h2>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
    google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Move', 'Value'],
              <?php 
              $chartValues = chartValues(); 
              $nameOfAxis = ['All post','Published','Draft','Categories','All comments','Approved comments','Denaied comments','Total users','Admins','Subscribers'];
              foreach ($chartValues as $key => $value) {
              echo "['$nameOfAxis[$key]',$chartValues[$key]],";
              };
              ?>
        ]);

        var options = {
          legend: { position: 'none' },
          chart: {
            title: '',
            subtitle: ''
             },
          axes: {
            x: {
              0: { side: 'top', label: 'View all the graphical representation of posts'} // Top x-axis.
            }
          },
          bar: { groupWidth: "25%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        // Convert the Classic options to Material options.
        chart.draw(data, google.charts.Bar.convertOptions(options));
      };
    </script>
    <div id="top_x_div" class="my-2" style="width: 100%; height: 600px; overflow: scroll;"></div>
</div>