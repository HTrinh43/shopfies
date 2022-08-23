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
                  <a href="user.php" class="active active-first">User Info</a>
                </li>
              </ul>
            </div>
          </nav>
          </div>
        </header>
        <div class="py-5">
            <div class="container py-5">
                div class="row">
            <div class="col-lg-6">
                <h2 class="display-4 font-weight-light">Select user's name</h2>
                <form method="GET" action="list.php">
                    <select name="number" onchange='this.form.submit()'>
                        <option selected>Select number of Top list</option>
                        <?php
                        $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                        $i=1;
                        echo "<option value=".$i.">".$i."</option>";
                        for($i; $i<=4; $i++)
                        {
                            $num= $i* 5;

                            echo "<option value=".$num.">".$num."</option>";
                        }
                        ?>
                    </select>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "GET")
                    {
                        if (isset($_GET['number']) )
                        {
                    ?>
                    <p>&nbsp;</p>
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-success">
                                <th scope="col">List Name</th>
                                <th scope="col">Author UserName</th>
                                <th scope="col">Likes</th>
                            </tr>
                        </thead>
                        <?php
                            if ( mysqli_connect_errno() )
                            {
                                die( mysqli_connect_error() );
                            }
                            $sql = "SELECT USER.username AS Username, LIST.name AS 'List', COUNT(LIKES.listid) AS 'Like' FROM USER
                                    JOIN LIST_USER ON USER.id=LIST_USER.userid
                                    JOIN LIST ON LIST_USER.listid = LIST.id
                                    JOIN LIKES ON LIKES.listid = LIST.id
                                    GROUP BY USER.username, LIST.name
                                    ORDER BY COUNT(LIKES.listid) DESC LIMIT {$_GET['number']}";
                            if ($result = mysqli_query($connection, $sql))
                            {
                                while($row = mysqli_fetch_assoc($result))
                                {
                        ?>
                        <tr>
                            <td><?php echo $row['List'] ?></td>
                            <td><?php echo $row['Username'] ?></td>
                            <td><?php echo $row['Like'] ?></td>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>