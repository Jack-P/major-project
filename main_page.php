<?php
  session_start();
  include_once 'db_connect.php';

  if (!isset($_SESSION['userSession'])) {
   header("Location: index.php"); // GOES TO INDEX.PHP IF NO USER HAS SIGNED IN
 }

  $postedDiv = "";

  if(isset($_POST['codeData'])){
    $title = $_POST['titleData'];
    $code = $_POST['codeData'];
    $favDur = $_POST['favDuration'];
    $user = $_SESSION['userSession'];
    $favQuery = $DBcon->query("INSERT INTO favourites(fav_title, fav_text, user_id, fav_dur) VALUES('$title','$code','$user','$favDur')");

    $postedDiv = "You saved: " .$title . " to your favourites";
  }

  if(isset($_POST['formDelete'])){
    if(isset($_POST['fav_id']) && !empty($_POST['fav_id'])){
        require_once('db_connect.php');

        $fav_id= $_POST['fav_id'];
        $result = $DBcon->query("DELETE FROM favourites WHERE fav_id=".$fav_id);
    }
  }

  // if($_GET['del'])
  //  {
  //   deletebooking($orderID);
  //  }

  $query = $DBcon->query("SELECT * FROM users WHERE user_id=".$_SESSION['userSession']);
  $userRow=$query->fetch_array();
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <title>Ani-Mate</title>
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/animatecss.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Indie+Flower|Lobster|Arvo|Josefin+Sans|Quicksand|Dancing+Script|Exo|Baloo|Lato|Poppins|Open+Sans|Playfair+Display|Raleway|Roboto|Inknut+Antiqua|Source+Sans+Pro|Ravi+Prakash|Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="foundation-icons/foundation-icons.css" />
  </head>
  <body>


    <div id="fullpage">
    	<div class="section">

        <div class="top-bar"> <!-- TOP BAR -->
          <div class="top-bar-left">
            <img src="images/logo.png" style="width: 180px;" alt="">
          </div>
          <div class="top-bar-right">
            <p>Welcome <?php echo $userRow['username']; ?></p>
            <a href="logout.php?logout">Logout</a>
          </div>
        </div>

        <div class="row expanded pad"> <!-- ROW ABOVE THE ANIMATION VIEWER -->

        </div>

        <div class="row expanded">

          <div class="large-3 translate-left columns">

            <div class="watermark">
              <i class="fi-wrench large"></i>
              <h3>Settings</h3>
            </div>

             <div class="specifics"> <!-- LEFT SIDE OPTIONS BOXES FOR TEXT AND SHAPES -->

              <form class="optionOne">
                <select id="shape">
                  <optgroup label="Preset Shapes">
                    <option value="square">Square</option>
                    <option value="triangle">Triangle</option>
                    <option value="circle">Circle</option>
                    <option value="diamond">Diamond</option>
                    <option value="rombus">Rombus</option>
                  </optgroup>
                  <optgroup label="Custom">
                    <option value="canvas">Draw your own</option>
                  </optgroup>
                </select>
                <div id="hide-on-canvas">
                  <label>Width (px):</label>
                  <input type="range" id="width" name="" value="200" min="0" max="300" step="10">
                  <input type="text" id="widthVal" name="" value="200">
                  <br>
                  <br>
                  <label>Height (px):</label>
                  <input type="range" id="height" name="" value="200" min="0" max="300" step="10">
                  <input type="text" id="heightVal" name="" value="200">
                  <br>
                  <label>Colour:</label>
                  <input type="color" id="colorPicker" name="" value="#fba126">
                  <input type="text" id="colorVal" name="" value="#fba126">
                  <br>
                  <br>
                </div>
                  <label>Duration (Seconds):</label>
                  <input  for="amount" oninput="amount.value=rangeInput.value" id="slider" class="sliderDur" type="range" value="1" min="0.0" max="5.0" step="0.1" name="rangeInput" />
                  <input oninput="rangeInput.value=amount.value" id="sliderVal" class="sliderVal" type="text" value="1" name="amount" for="rangeInput"  oninput="rangeInput.value=amount.value" />
              </form>

              <form class="optionTwo none"> <!-- SECOND SETTINGS BOX FOR TEXT -->
                <div class="row">
                  <div class="large-8 columns">
                    <label>Font</label>
                    <select id="font" value="" name="">
                      <option value="Roboto">Roboto</option>
                      <option value="Open Sans">Open Sans</option>
                      <option value="Lato">Lato</option>
                      <option value="Raleway">Raleway</option>
                      <option value="Inknut Antiqua">Inknut Antiqua</option>
                      <option value="Source Sans Pro">Source Sans Pro</option>
                      <option value="Ravi Prakash">Ravi Prakash</option>
                      <option value="Ubuntu">Ubuntu</option>
                      <option value="Poppins">Poppins</option>
                      <option value="Indie Flower">Indie Flower</option>
                      <option value="Baloo">Baloo</option>||Josefin+Sans|Quicksand|Dancing+Script|Exo
                      <option value="Lobster">Lobster</option>
                      <option value="Arvo">Arvo</option>
                      <option value="Josefin Sans">Josefin Sans</option>
                      <option value="Quicksand">Quicksand</option>
                      <option value="Dancing Script">Dancing Script</option>
                      <option value="Exo">Exo</option>
                    </select>
                  </div>
                  <div class="large-4 columns">
                    <label>Font Size</label>
                    <select id="fontSize" value="48" size="1" name="">
                      <!-- Info being pulled in -->
                    </select>
                  </div>
                </div>
                <div class="inline">
                  <label style="font-weight: bold;">Bold</label>
                  <div class="switch medium">
                    <input class="switch-input" id="bold" type="checkbox" name="exampleSwitch">
                    <label class="switch-paddle" for="bold">
                    </label>
                  </div>
                </div>
                <div class="inline">
                  <label style="font-style: italic;">Uppercase</label>
                  <div class="switch medium">
                    <input class="switch-input" id="uppercase" type="checkbox" name="exampleSwitch">
                    <label class="switch-paddle" for="uppercase">
                    </label>
                  </div>
                </div>
                <div class="inline">
                  <label style="font-style: italic;">Italics</label>
                  <div class="switch medium">
                    <input class="switch-input" id="italics" type="checkbox" name="exampleSwitch">
                    <label class="switch-paddle" for="italics">
                    </label>
                  </div>
                </div>
                <div class="">
                  <label>Column Width (%)</label>
                  <input type="range" id="fontWidth" name="" value="80" min="0" max="100" step="1">
                  <input type="text" id="fontWidthVal" name="" value="80">
                </div>
                <div class="">
                  <label>Duration(Seconds)</label>
                  <input type="range" id="textDur" class="sliderDur" name="" value="1" min="0.0" max="5.0" step="0.1">
                  <input type="text" id="textDurVal" class="sliderVal" name="" value="1">
                </div>
                <div class="row">
                  <div class="large-8 columns">
                    <button type="button" class="button" id="lorem" name="button">Insert Lorem Text</button>
                  </div>
                  <div class="large-4 columns">
                    <button type="button" class="button" id="back" name="button">Back</button>
                  </div>
                </div>
              </form>

            </div>
          </div>

          <div class="large-6 columns"> <!-- SELECT BOXES AND INPUT BOX FOR TEXT -->

            <div class="row">
              <div class="large-4 columns">
                <select class="ani-opt">
                  <optgroup id="pull" label="Animate.css">
                    <!-- OPTIONS PULLED IN HERE  -->
                  </optgroup>
                  <optgroup id="my-ani" label="Jack-Animation">
                    <!-- OPTIONS PULLED IN HERE  -->
                  </optgroup>
                </select>
              </div>

              <div class="large-4 columns">
                <input id="textor" type="text" name="" value="" placeholder="Enter text here">
              </div>

              <div class="large-4 clear-appear columns">
                <!-- CANVAS CLEAR BUTTON APPEARS HERE  -->
              </div>
            </div>

            <div class="row">
              <div class="large-12 columns">
                <div class="ani-wrap">
                  <button class="button play" type="button" name="button">Replay Animation</button><!--REPLAY ANIMATION BUTTON  -->
                    <div id="obj" class="canvas-wrap obj-wrap animate object">
                        <div id="area" class="object square animate"></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="large-12 columns">
                <div id="countDown">
                  <div id="myBar"></div>
                </div>
              </div>
            </div>

          </div>

          <div class="large-3 translate-right columns"> <!-- RIGHT SIDE SLIDE-IN -->
            <div class="watermark-right">
              <h3>Output</h3>
            </div>
            <div class=" large-12 keys columns">
              <form id="favForm" border='0' method="post">
                <input type="hidden" name="titleData" id="useDataField" value="">
                <input type="hidden" name="codeData" id="useDataFieldTwo" value="">
                <input type="hidden" name="favDuration" id="useDataFieldThree" value="">
              </form>
              <div class="mini-output large-12 columns">
                <div class="output-nav">
                  <a id="downloadLink" class="button download" href="#"><i class="fi-download"></i></a>
                  <a class="button save" href="#"><i class="fi-save"></i></a>
                  <a class="button clipboard" href="#"><i class="fi-clipboard-pencil"></i></a>
                </div>
                <div class="save-box">
                  <input type="text" id="title" placeholder="My Animation Title" value="">
                  <button type="button" class="button btn-save" id="submit">Save</button>
                </div>
                <div class="textarea">
                  <textarea id="code" name="aniText" name="name" cols="80" spellcheck="false">
  @keyframes rotate {
    from {
      transform: rotate(360deg);
      transform-origin: center;
    }

    to {
      transform: none;
      transform-origin: center;
    }
  }
  .rotate {
    animation-name: rotate;
  }</textarea>
              </div>

              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="large-10 large-offset-1 columns canvas-opt">
            <!-- COLOUR PALETTE AND BRUSH SIZE OUTPUTS HERE  -->
          </div>
        </div>

        <div class="row">
          <div class="large-12 columns">
            <div id="delayLoad" class="none"></div>
          </div>
        </div>



      </div>
    	<div class="section">
        <div class="row expanded">
          <div class="large-6 favs columns">
            <h1>Favourites</h1>
          </div>
        </div>
        <div class="row">
          <div class="large-12 pad shadow large-collapse columns">
            <div class="large-3 output columns">
              <ul class="tabs vertical limit" id="vert-tabs" data-tabs>
                <?php
                if (isset($_SESSION['userSession'])) {

                  $favPull = "SELECT fav_title, fav_text, fav_dur, fav_id FROM favourites WHERE user_id=".$_SESSION['userSession'] . "";
                  $result = $DBcon->query($favPull);

                  if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                      echo "<li class='tabs-title first'><a class='tab-switch' href='#" . $row["fav_id"] . "'>" . $row["fav_title"] . "</a></li>";
                    }
                  } else {
                    echo "Could not retrieve your favourites";
                  }

                }
                ?>
              </ul>
            </div>
            <div class="large-9 columns">
              <div class="tabs-content vertical" data-tabs-content="vert-tabs">
                <?php
                if (isset($_SESSION['userSession'])) {

                  $favPull = "SELECT fav_title, fav_text, fav_dur, fav_id FROM favourites WHERE user_id=".$_SESSION['userSession']."";
                  $result = $DBcon->query($favPull);

                  if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                      echo "<div class='tabs-panel first' id='" . $row["fav_id"] . "'><div class='fav-nav'><h5>" . $row["fav_title"] . "</h5><form action='".$_SERVER['PHP_SELF']."' method='post'><input type='hidden' id='fav_id' name='fav_id' value='".$row["fav_id"]."' /><input type='submit' name='formDelete' id='formDelete' value='Delete' class='delete' /></form><a class='button select-txt'><i class='fi-clipboard-pencil large'></a></div></i><textarea class='select-content' readonly spellcheck='false'>" . $row["fav_text"] . $row["fav_dur"] . "</textarea> </div></li>";
                    }
                  } else {
                    echo "<li class='accordion-item' data-accordion-item></li>";
                  }
                  $DBcon->close();
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="bower_components/jquery/dist/jquery.js"></script>
    <script src="bower_components/what-input/dist/what-input.js"></script>
    <script src="bower_components/foundation-sites/dist/js/foundation.js"></script>
    <script type="text/javascript" src="js/app.js"></script>
    <script type="text/javascript" src="js/myscript.min.js"></script>
    <script type="text/javascript" src="js/mycanvas.min.js"></script>
    <script type="text/javascript" src="vendors/scrolloverflow.min.js"></script>
    <script type="text/javascript" src="js/jquery.fullPage.min.js"></script>

  </body>
</html>
