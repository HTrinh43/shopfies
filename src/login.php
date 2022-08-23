<?php require_once('config.php'); ?>


<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="home.css">

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
    <body>
        <!-- START -- Add HTML code for the top menu section (navigation bar) -->
      <header class="main-header">
      <div class="container">
        <nav class="navbar navbar-expand-lg main-nav px-0">
          <a class="navbar-brand">
            <img src="shopies_logo.png">
          </a>

          <!-- close bar at smaller screen size -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainMenu" aria-controls="mainMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar icon-bar-1"></span>
            <span class="icon-bar icon-bar-2"></span>
            <span class="icon-bar icon-bar-3"></span>
          </button>
          <div class="collapse navbar-collapse" id="mainMenu">
            <ul class="navbar-nav ml-auto text-uppercase f1">
              <li>
                  <a href="index.php">Home</a>
              </li>
              <li>
                <a href="list.php">Top List</a>
              </li>
              <li>
                <a href="user_list.php">User List</a>
              </li>
              <li>
                  <a href="login.php"  class="active active-first">Login Statistics</a>
              </li>
              <li>
                  <a href="tag.php">Tag</a>
                </li>
              </ul>
            </div>
          </nav>
          </div>
        </header>


        <?php
        $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
        if ( mysqli_connect_errno() )
        {
            die( mysqli_connect_error() );
        }
        $sql1 = "CALL getMonthlyLoginStatistic(2021);";
        if ($result1 = mysqli_query($connection, $sql1))
        {
            $count = 1;
            $dataPoints = array();

            while($row = mysqli_fetch_assoc($result1))
            {
                $dataPoints[] = array("x" => $count, "y" =>  $row['total']);
                $count = $count + 1;
            }
            mysqli_free_result($result1);
        }

        ?>

        <script>
            window.onload = function () {

                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    exportEnabled: true,
                    theme: "light1", // "light1", "light2", "dark1", "dark2"
                    title:{
                        text: "USER LOGIN SUMARY"
                    },
                    axisY:{
                        includeZero: true
                    },
                    data: [{
                        type: "line", //change type to bar, line, area, pie, etc
                        //indexLabel: "{y}", //Shows y value on all Data Points
                        indexLabelFontColor: "#5A5757",
                        indexLabelPlacement: "outside",
                        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                    }]
                    });
                           chart.render();

                           }
        </script>


        <div class="py-5">
            <div class="container py-5">
                <div class="row">
                        <div id="chartContainer" style="height: 370px; width: 100%;"></div>


                <div class="col-lg-6">
                    <h2 class="display-4 font-weight-light">Select Month</h2>
                    <form method="GET" action="login.php">
                        <select name="month" onchange='this.form.submit()'>
                            <option selected>Select Month</option>
                            <?php
                            echo "<option value=1>January</option>";
                            echo "<option value=2>February</option>";
                            echo "<option value=3>March</option>";
                            echo "<option value=4>April</option>";
                            echo "<option value=5>May</option>";
                            echo "<option value=6>June</option>";
                            echo "<option value=7>July</option>";
                            echo "<option value=8>August</option>";
                            echo "<option value=9>September</option>";
                            echo "<option value=10>October</option>";
                            echo "<option value=11>November</option>";
                            echo "<option value=12>December</option>";
                            ?>
                        </select>

                        <?php
                        $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                        if ($_SERVER["REQUEST_METHOD"] == "GET")
                        {
                            if (isset($_GET['month']) )
                            {
                        ?>
                        <p>&nbsp;</p>
                        <table class="table table-hover">
                            <thead>
                                <tr class="table-danger">
                                    <th scope="col">Username</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Time</th>
                                </tr>
                            </thead>
                            <?php

                                if ( mysqli_connect_errno() )
                                {
                                    die( mysqli_connect_error() );
                                }
                                $sql = "SELECT USER.username as 'username', USER.first_name as 'firstname', USER.last_name as 'lastname', LOGIN_LOG.time as 'time'
                                        FROM USER, LOGIN_LOG
                                        WHERE USER.id=LOGIN_LOG.userid AND MONTH(LOGIN_LOG.time)={$_GET['month']}
                                        ORDER BY LOGIN_LOG.time DESC;";
                                if ($result = mysqli_query($connection, $sql))
                                {
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                            ?>
                            <tr>
                                <td><?php echo $row['username'] ?></td>
                                <td><?php echo $row['firstname'] ?></td>
                                <td><?php echo $row['lastname'] ?></td>
                                <td><?php echo $row['time'] ?></td>
                            </tr>
                            <?php
                                    }
                                    // release the memory used by the result set
                                    mysqli_free_result($result);
                                }
                            } // end if (isset)
                        } // end if ($_SERVER)
                            ?>
                        </table>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            </body>
</html>
