<?php

require 'header.php';

// Replace with your database connection code
$pdo = new PDO('mysql:host=localhost;dbname=nimbus_island', 'root', '');

// Query to fetch data
$query = "SELECT `pay_date`, `no_of_tickets` FROM `ticket` WHERE 1";
$stmt = $pdo->query($query);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo '<script>';
echo 'const xData = ' . json_encode(array_column($data, 'pay_date')) . ';';
echo 'const yData = ' . json_encode(array_column($data, 'no_of_tickets')) . ';';
echo '</script>';
?>

<html>
    <head>

    </head>
<body>
    <!-- Line Chart -->
    <div id="reportsChart"></div>

    <!-- Display data -->
<div>
  xData: <span id="xData"></span><br>
  yData: <span id="yData"></span>
</div>

    <script>
  document.addEventListener("DOMContentLoaded", () => {
    const xData = <?php echo json_encode(array_column($data, 'pay_date')); ?>;
    const yData = <?php echo json_encode(array_column($data, 'no_of_tickets')); ?>;
    
     // Display the data on the page
     document.getElementById("xData").textContent = xData.join(", ");
    document.getElementById("yData").textContent = yData.join(", ");

    new ApexCharts(document.querySelector("#reportsChart"), {
      series: [{
        name: 'Number of Tickets',
        data: yData,
      }],
      chart: {
        height: 350,
        type: 'area',
        toolbar: {
          show: false
        },
      },
      markers: {
        size: 4
      },
      colors: ['#4154f1'],
      fill: {
        type: "gradient",
        gradient: {
          shadeIntensity: 1,
          opacityFrom: 0.3,
          opacityTo: 0.4,
          stops: [0, 90, 100]
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth',
        width: 2
      },
      xaxis: {
        type: 'datetime',
        categories: xData,
      },
      tooltip: {
        x: {
          format: 'dd/MM/yy HH:mm'
        },
      }
    }).render();
  });
</script>


<!-- End Line Chart -->
</body>
</html>