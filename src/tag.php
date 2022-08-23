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
        <!-- fontawssome css-->
        <script src="https://kit.fontawesome.com/2893b555a3.js" crossorigin="anonymous"></script>
        <title>Tag</title>
    </head>
    <body>
        <!-- START -- Add HTML code for the top menu section (navigation bar) -->
        <header class="main-header">
            <div class="container">
                <nav class="navbar navbar-expand-lg main-nav px-0">
                    <a class="navbar-brand">
                        <img src="shopies_logo.png" >
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
                                <a href="index.php">home</a>
                            </li>
                            <li>
                                <a href="list.php">Top List</a>
                            </li>
                            <li>
                                <a href="user_list.php">User List</a>
                            </li>
                            <li>
                                <a href="login.php">Login Statistics</a>
                            </li>
                            <li>
                                <a href="tag.php" class="active active-first">Tag</a>
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
        $sql1 = "SELECT TAG.id, TAG.name as name, COUNT(LIST_TAG.listid) AS number FROM LIST_TAG
                                        JOIN TAG ON LIST_TAG.tagid=TAG.id
                                        GROUP BY TAG.id, TAG.name";
        if ($result1 = mysqli_query($connection, $sql1))
        {
            $dataPoints = array();

            while($row = mysqli_fetch_assoc($result1))
            {
                $dataPoints[] = array("label" => $row['name'], "y" =>  $row['number']);
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
                        text: "TAG DISTRIBUTION"
                    },
                    axisY:{
                        includeZero: true
                    },
                    data: [{
                        type: "pie", //change type to bar, line, area, pie, etc
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
                    <div class="row">
                    <h2 class="display-4 font-weight-light">Select a tag name</h2>
                    <form method="GET" action="tag.php">
                    <select name="tag" onchange='this.form.submit()'>
                        <option selected>Select a tag name</option>
                        <?php
                        $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                        if ( mysqli_connect_errno() )
                        {
                            die( mysqli_connect_error() );
                        }
                        $sql = "Select * from TAG";
                        if ($result = mysqli_query($connection, $sql))
                        {
                            // loop through the data
                            while($row = mysqli_fetch_assoc($result))
                            {
                                echo '<option value="' . $row['id'] . '">';
                                echo $row['name'];
                                echo "</option>";
                            }
                            // release the memory used by the result set
                            mysqli_free_result($result);
                        }
                        ?>
                        </select>
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "GET")
                        {
                            if (isset($_GET['tag']) )
                            {
                        ?>
                        <p>&nbsp;</p>
                        <table class="table table-hover">
                            <thead>
                                <tr class="table-danger">
                                    <th scope="col">List name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Likes</th>
                                </tr>
                            </thead>
                            <?php
                                if ( mysqli_connect_errno() )
                                {
                                    die( mysqli_connect_error() );
                                }
                                $sql = "SELECT LIST.name AS name, LIST.description as description, USER.username as author, COUNT(LIKES.listid) AS Likes FROM LIST
                                        JOIN LIST_TAG ON LIST.id=LIST_TAG.listid
                                        JOIN TAG ON LIST_TAG.tagid=TAG.id
                                        JOIN LIKES ON LIST.id=LIKES.listid
                                        JOIN LIST_USER ON LIST.id=LIST_USER.listid
                                        JOIN USER ON USER.id=LIST_USER.listid
                                        WHERE TAG.id={$_GET['tag']}
                                        GROUP BY LIST.name, LIST.description, USER.username";
                                if ($result = mysqli_query($connection, $sql))
                                {
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                            ?>
                            <tr>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['description'] ?></td>
                                <td><?php echo $row['author'] ?></td>
                                <td><?php echo $row['Likes'] ?></td>
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

        </div>
            </body>
</html>