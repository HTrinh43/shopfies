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
    <title>Document</title>
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
                  <a href="index.php" class="active active-first">home</a>
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
                <div class="col-lg-6">
                    <h2 class="display-4 font-weight-light">Shopfies</h2>
                    <p class="font-italic text-muted">Shopfies is a note-taking app in the form of a shopping-list.
                        With this app, users can plan ahead and take note of what they need to buy before going to the supermarket, or before organizing a party.
                        Users can also publicize their lists, interact (like, save) with other people's lists or existing lists that we have created.
                        Of course, our app also includes different templates, fonts or graphics to make user notes more unique.</p>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-lg-6">
                    <h2 class="display-4 font-weight-light float-right">Motivations</h2>
                    <p class="float-right font-italic text-muted">We often spend a lot of time deciding and making lists of things that we should buy.
                        For example, if you are someone who has never had experience in organizing a birthday party, or you have just bought yourself a new house and are not sure what to prepare, you will need to do lots of researches, ask your friends or family members for their advices on what will need to be bought,... 
                        This process can delay a lot of time and mess up your shopping list. Not only you but we, or anyone, has been, or will be, going through a similar situation. Using our application will save you a lot of time, and can bring you many other benefits.
                </div>
            </div>
            <div class="row">
                <h2 class="display-4 font-weight-light">Our team</h2>
            </div>
            <div class="row text-center mt-5">
                <!-- Team item-->
                <div class="col-xl-3 col-sm-6 mb-5">
                    <div class="bg-white rounded shadow-sm py-5 px-4"><img src="https://bootstrapious.com/i/snippets/sn-about/avatar-4.png" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                        <h5 class="mb-0">Teresa Nguyen</h5>
                        <ul class="social mb-0 list-inline mt-3">
                            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
                            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-github"></i></a></li>
                            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- End-->

                <!-- Team item-->
                <div class="col-xl-3 col-sm-6 mb-5">
                    <div class="bg-white rounded shadow-sm py-5 px-4"><img src="https://bootstrapious.com/i/snippets/sn-about/avatar-4.png" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                        <h5 class="mb-0">Natalie Hong</h5>
                        <ul class="social mb-0 list-inline mt-3">
                            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
                            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-github"></i></a></li>
                            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- End-->
                <!-- Team item-->
                <div class="col-xl-3 col-sm-6 mb-5">
                    <div class="bg-white rounded shadow-sm py-5 px-4"><img src="https://bootstrapious.com/i/snippets/sn-about/avatar-4.png" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                        <h5 class="mb-0">Alex Trinh</h5>
                        <ul class="social mb-0 list-inline mt-3">
                            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
                            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-github"></i></a></li>
                            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- End-->

                <!-- Team item-->
                <div class="col-xl-3 col-sm-6 mb-5">
                    <div class="bg-white rounded shadow-sm py-5 px-4"><img src="https://bootstrapious.com/i/snippets/sn-about/avatar-4.png" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                        <h5 class="mb-0">Tien Thanh Truong</h5>
                        <ul class="social mb-0 list-inline mt-3">
                            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
                            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-github"></i></a></li>
                            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- End-->
            </div>
        </div>
    </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>