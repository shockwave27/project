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
<!-- <div class="col-lg-6"> -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Column Chart</h5>

              <!-- Column Chart -->
              <div id="columnChart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  // Replace this sample data with your actual data
                  fetch('php/get_chart_data.php')
    .then(response => response.json())
    .then(data => {
        // Map and filter the fetched data to match the desired format
        const ticketData = data.map(item => ({
            ticket_cat: item.ticket_cat,
            book_date: item.book_date
        })).filter(item => item.book_date !== '1970-01-01'); // Filter out any undesired data
         console.log("data is");
        console.log(ticketData);

        // Rest of your JavaScript code for chart rendering
        const categories = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        const basicCounts = Array(12).fill(0);
        const fastCounts = Array(12).fill(0);
        const specialCounts = Array(12).fill(0);

        // Group the data by month and ticket category
        ticketData.forEach((dataPoint) => {
            const month = new Date(dataPoint.book_date).getMonth();
            const category = dataPoint.ticket_cat;

            if (category === 'basic') {
                basicCounts[month]++;
            } else if (category === 'fast') {
                fastCounts[month]++;
            } else if (category === 'special') {
                specialCounts[month]++;
            }
        });

        new ApexCharts(document.querySelector("#columnChart"), {
            series: [
                {
                    name: 'basic',
                    data: basicCounts,
                },
                {
                    name: 'fast',
                    data: fastCounts,
                },
                {
                    name: 'special',
                    data: specialCounts,
                }
            ],
            chart: {
                type: 'bar',
                height: 350,
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded',
                },
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent'],
            },
            xaxis: {
                categories: categories,
            },
            yaxis: {
                title: {
                    text: 'Number of Tickets Sold',
                },
            },
            fill: {
                opacity: 1,
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val;
                    },
                },
            },
        }).render();
    })
    // .catch(error => console.error(error));

                });
              </script>
              
              <!-- End Column Chart -->

            </div>
          </div>
        <!-- </div> -->
</body>
</html>