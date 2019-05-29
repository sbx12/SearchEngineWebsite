<?php
  include 'Script/mySQL.php';
  include 'Script/webcrawler.php';
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="Style/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="Style/custom.css"/>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="Script/mySQL.js"></script>
    <link href="/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Catamaran|Ubuntu" rel="./stylesheet">
    <title>SB 355 HOME</title>

  </head>
  <body>
    <!--NAV Start-->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="index.html">SB</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <!--ABOUT Start-->
          <li class="nav-item active">
            <div class="dropdown">
              <button class="dropbtn">ABOUT</button>
              <div class="dropdown-content">
                <a href="index.html#BioZ">BIO</a>
                <a href="index.html#ContactZ">CONTACT</a>
              </div>
            </div>
          </li>
          <!--ABOUT END-->

          <!--BROWSER Start-->
          <li class="nav-item">
            <div class="dropdown">
              <button class="dropbtn">BROWSER</button>
              <div class="dropdown-content">
                <a href="index.html" id="BrowserX">Browser</a>
                <a href="index.html" id="ScreenX">Screen</a>
                <a href="index.html" id="LocationX">Location</a>
              </div>
            </div>
          </li>
          <!--BROWSER END-->

          <!--COURSE Start-->
          <li class="nav-item">
            <div class="dropdown">
              <button class="dropbtn">COURSE</button>
              <div class="dropdown-content">
                <a href="https://learn.zybooks.com/zybook/CUNYCSCI355TeitelmanSpring2019">Zybooks</a>
              </div>
            </div>
          </li>
          <!--COURSE END-->

          <!--SEARCH Start-->
          <li class="nav-item">
            <div class="dropdown">
              <button class="dropbtn">SEARCH</button>
              <div class="dropdown-content">
                <a href="Search.html">FIXED SEARCH: Augemented Reality</a>
                <a href="Upload.html">UPLOAD</a>
                <a href="Google.html">Google</a>
                <a href="mySearch.php">MySearch</a>
                <a href="Admin.php">Admin</a>
              </div>
            </div>
          </li>
          <!--SEARCH END-->
        </ul>

        <form class="form-inline my-2 my-lg-0" action="Search.html">
          <input class="form-control mr-sm-2" type="text" placeholder="Augemented Reality" aria-label="Search">
          <button class="btn btn-secondary my-2 my-sm-0" onclick="location.href='Search.html'"  type="submit">Search</button>
        </form>
      </div>
    </nav>

  <!--NAV END -->
  <br />
  <div class="FILEMENUX">
    <h1>Choose file download type</h1>
    <input type="checkbox" id="checkbXALL" onClick="toggle(this)"/> Select All/Deselect All<br />
    <input type="radio" name="fileDownloadSelect" value="JSON" /> JSON <br />
    <input type="radio" name="fileDownloadSelect" value="XML" /> XML <br />
    <input type="radio" name="fileDownloadSelect" value="CSV" /> CSV <br />
    <button id="DownloadType" >DOWNLOAD</button>
  </div>


<!-- SEARCHHHHHHHH %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%5-->
  <div class="FILEMENUX">
    <h1>SEARCH</h1>
    <div class="container">
    	<div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div id="imaginary_container">
                  <form action="mySearch.php" method="POST">
                    <input type="radio" name="SearchType" value="caseinsensitive"  checked/> Case-Insensitive <br />
                    <input type="radio" name="SearchType" value="allowpartialmatch" /> Allow Partial Match
                    <div class="input-group stylish-input-group">
                        <input type="text" class="form-control" name="Search"  placeholder="Search" >
                    </div>
                    <br />

                    <button type="submit" name="GoogleSearchBTN" id="GoogleSearchBTN">
                        <span class="glyphicon glyphicon-search">SEARCH</span>
                    </button>
                  </form>
                </div>
            </div>
    	</div>
    </div>
  </div>

  <?php
    if(isset($_POST['GoogleSearchBTN'])){
      $search = mysqli_real_escape_string($conn, $_POST['Search']);

      SearchMe($search, $conn, $_POST['SearchType']);
    }
   ?>

  <!--/.Footer-->
  <script src="jquery-csv.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="Script/SearchUpload.js"></script>
  <script type="text/javascript" src="Script/SearchDownload.js"></script>
  <script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
  <script src="/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
  </body>
</html>
