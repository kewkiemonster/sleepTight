<?php 
    require '../includes/db.php';
    session_start();
    
    
?>
<!DOCTYPE html>
<head>
    <title>DATA PAGE</title>
    
        <!--JQuery-->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.css"/>
        <!-- Font Awesome (CDN) -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Miriam+Libre|Source+Sans+Pro:700|Open+Sans:300" rel="stylesheet">
        <!-- Style -->
        <link rel="stylesheet" href="/Project/css/style.css"/>
        <!--Highcharts -->
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/series-label.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        
    
</head>

<body>
     
    <?php //If the user is logged in then show data
        if($_SESSION['loggedin'] === true){ //else -> redirect to homepage
    ?>
    
    <?php include '../includes/usernav.php'; ?>
    
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="container1">
                    
                </div>
            </div>
        </div>
        
    </div> <!-- container end -->
    
    <script type="text/javascript">
    
        Highcharts.chart('container1', {
    
        title: {
            text: 'Sleep Environment'
        },
    
        subtitle: {
            text: 'Sleep-Tight'
        },
    
        xAxis: {
            title: {
                text: 'Time'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
    
        plotOptions: {
            series: {
                label: {
                    connectorAllowed: true
                },
                pointStart: time
            }
        },
    
        series: [{
            name: 'Noise',
            data: 
        }, {
            name: 'Light',
            data: 
        }, {
            name: 'Temperature',
            data:
        }, {
            name: 'Motion',
            data: 
        }],
    
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    
    });
        
    </script>
    
     <?php } else {
        header('location: ../../Project/account/homepage.php');
        exit;
    } ?> 
    

</body>
</html>