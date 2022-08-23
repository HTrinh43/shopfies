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
                                <a href="user_list.php" class="active active-first">User List</a>
                            </li>
                            <li>
                                <a href="login.php">Login Statistics</a>
                            </li>
                            <li>
                                <a href="tag.php">Tag</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <div class="py-5">
            <div class="container py-5">
                <div class="row">
                <div class="container">
                    <h2 class="display-4 font-weight-light">Select username</h2>
                    <form method="GET" action="user_list.php">
                        <select name="user" onchange='this.form.submit()'>
                            <option selected>Select an username</option>
                            <?php
                            $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                            if ( mysqli_connect_errno() )
                            {
                                die( mysqli_connect_error() );
                            }
                            $sql = "select * from USER";
                            if ($result = mysqli_query($connection, $sql))
                            {
                                // loop through the data
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    echo '<option value="' . $row['id'] . '">';
                                    echo $row['username'];
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
                            if (isset($_GET['user']) )
                            {
                        ?>
                        <p>&nbsp;</p>

                        <div class="container d-flex justify-content-center align-items-center">
                            <div class="card p-5">
                                <div class="user text-center">
                                    <div class="profile"> <img src="https://bootstrapious.com/i/snippets/sn-about/avatar-4.png" class="rounded-circle" width="100"> </div>
                                </div>
                                <div class="mt-4 text-center">
                                    <?php
                                if ( mysqli_connect_errno() )
                                {
                                    die( mysqli_connect_error() );
                                }
                                $sql = "SELECT USER.email as email, USER.first_name as Fname, USER.last_name as Lname, COUNT(LIST.id) as Lists, COUNT(FAVORITE_LIST.listid) as favorite
                                            FROM USER JOIN LIST_USER ON USER.id=LIST_USER.userid
                                            JOIN LIST ON LIST_USER.listid=LIST.id
                                            JOIN FAVORITE_LIST ON FAVORITE_LIST.userid=LIST.id
                                            WHERE USER.id={$_GET['user']}
                                            GROUP BY USER.email, USER.first_name, USER.last_name";
                                if ($result = mysqli_query($connection, $sql))
                                {
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                    ?>
                                    <h4 class="mt-2"><?php echo $row['Fname']. ', '. $row['Lname'] ?></h4> <span class="text-muted d-block mb-2"><?php echo $row['email'] ?></span>
                                    <div class="row mt-2">
                                        <div class="col-sm" >
                                            <h6>Personal List</h6><span><?php echo $row['favorite'] ?></span>
                                            </div>
                                        <div class="col-sm" >
                                            <h6>Favorite List</h6><span><?php echo $row['Lists'] ?></span>
                                        </div>
                                    </div>

                                    <?php
                                    }
                                    // release the memory used by the result set
                                    mysqli_free_result($result);
                                }
                            } // end if (isset)
                        } // end if ($_SERVER)
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php
                                if ($_SERVER["REQUEST_METHOD"] == "GET")
                                {
                                    if (isset($_GET['user']) )
                                    {
                            ?>
                            <div class="col-sm" >
                                <h3 class="display-4 font-weight-light">Personal List</h3>
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="table-danger">
                                            <th scope="col">List Name</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Numer of Items</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                    </thead>
                                    <?php
                                if ( mysqli_connect_errno() )
                                {
                                    die( mysqli_connect_error() );
                                }
                                $sql = "SELECT LIST.name as 'List', LIST.description as 'Description', COUNT(ITEM_LIST.itemid) as 'Items', LIST.create_at as 'Date'
                                    FROM LIST JOIN ITEM_LIST ON LIST.id = ITEM_LIST.listid
                                    JOIN LIST_USER ON LIST.id = LIST_USER.listid
                                    WHERE LIST_USER.userid = {$_GET['user']}
                                    GROUP BY LIST.name, LIST.description, LIST.create_at";
                                if ($result = mysqli_query($connection, $sql))
                                {
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['List'] ?></td>
                                        <td><?php echo $row['Description'] ?></td>
                                        <td><?php echo $row['Items'] ?></td>
                                        <td><?php echo $row['Date'] ?></td>
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
                            </div>
                            <div class="col-sm">
                                <?php
                                if ($_SERVER["REQUEST_METHOD"] == "GET")
                                {
                                    if (isset($_GET['user']) )
                                    {
                                ?>
                                <h3 class="display-4 font-weight-light">Favorite List</h3>
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="table-danger">
                                            <th scope="col">List Name</th>
                                            <th scope="col">Author Name</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Numer of Items</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        if ( mysqli_connect_errno() )
                                        {
                                            die( mysqli_connect_error() );
                                        }
                                        $sql = "SELECT LIST.name as 'List', LIST.description as 'Description', COUNT(ITEM_LIST.itemid) as 'Items', LIST.create_at as 'Date', USER.username as 'Username'
                                    FROM LIST JOIN ITEM_LIST ON LIST.id = ITEM_LIST.listid
                                    JOIN FAVORITE_LIST ON LIST.id = FAVORITE_LIST.listid
                                    JOIN USER ON FAVORITE_LIST.userid = USER.id
                                    WHERE USER.id = {$_GET['user']}
                                    GROUP BY LIST.name, LIST.description, LIST.create_at";
                                        if ($result = mysqli_query($connection, $sql))
                                        {
                                            while($row = mysqli_fetch_assoc($result))
                                            {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['List'] ?></td>
                                        <td><?php echo $row['Username'] ?></td>
                                        <td><?php echo $row['Description'] ?></td>
                                        <td><?php echo $row['Items'] ?></td>
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
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        </div>
    </body>
</html>