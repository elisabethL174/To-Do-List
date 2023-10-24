<!DOCTYPE html>

<style>

body, html {
  margin: 0;
  padding: 0;
  height: 100%;
}

  body{
    background-image: url("img/le_header.png");
    background-color: rgba(0, 0, 0, 0.5);
    background-blend-mode: darken;
    background-size: cover; /* Scale the background image to cover the entire container */
    background-repeat: no-repeat; /* Prevent image repetition */
    background-attachment: fixed; /* Fixed background image */
  }

  .text-center{
    padding-top: 10vw;
    color: white;
    padding-bottom: 9vw;
    font-weight: bold;
    font-size: 2vw;
    font-style: italic;
    z-index: 2;
  }
  
  .navbar{
    display: flex;
    width: 100%;
    z-index: 2;
  }

  .navbar-brand {
        font-weight: bold;
        color: white;
    }
  
  .white-thingy {
  display: flex;
  background-color: white;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  flex-grow: 1; /* Allow the white-thingy to grow to fill empty space */
  z-index: 2;
  background-color: #333345;
}

.grey-thingy {
  background-color: #f2f2f2;
  width: 95vw;
  height: auto;
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 2vw;
  margin-bottom: 1vw;
  border-radius: 15px;
  flex-direction: column;
  background-color: #9191A5;
  z-index: 2;
}

.white-box-container {
  margin-top: 0.7vw;
  display: flex; /* Arrange white boxes horizontally */
  z-index: 2;
}

.white-box-container-again {
  display: flex; /* Arrange white boxes horizontally */
  flex-direction: column;
  justify-content: center;
  padding: 0;
  align-items: center; /* Center horizontally */
  text-align: center; /* Center the text within the box */
  margin: 1vw; /* Add some margin for spacing */
  z-index: 2;
}

.guh {
  text-align: center;
  justify-content: center;
  align-self: center;
  font-weight: bold;
  font-size: 1.3vw;
  margin-top: 10px;
  margin-bottom: 0;
  z-index: 2;
  color: white;
  text-shadow: 0px 0px 50px rgba(0, 0, 0, 0.5); /* Text shadow */
}

.white-box {
  background-color: white;
  border-radius: 15px;
  padding: 1vw;
  width: 10vw;
  height: 10vw;
  margin-left: 1vw;
  margin-right: 1vw;
  display: flex;
  align-items: center;
  justify-content: center;
  flex: 1;
  margin-bottom: 0;
  z-index: 2;
  background-color: #333345;
  box-shadow: 0px 0px 50px rgba(0, 0, 0, 0.5); /* Box shadow */
}

.wbimg {
  height: 7vw;
  width: 7vw;
  margin-left: 0;
  margin-right: 0;
}

.motto-desc {
  display: flex;
  justify-content: space-between;
  z-index: 2;
}

/*.menu-button {
  display: flex;
  margin-top: 2vw;
  padding-top: 0vh;
  padding-bottom: 0;
  padding-left: 4vw;
  padding-right: 4vw;
  margin-bottom: 33px;
  background-color: #B96060;
  color: white;
  font-weight: bold;
  border-radius: 10vw;
  border-style: solid;
  border-width: 5px;
  border-color: #EDB3B3;
  font-size: 2vw;
  margin-top: 10px;
  text-align: center;
  z-index: 2;
}*/

/*.menu-button:hover {
  background-color: #EDB3B3;
  color: white;
  border-color: #B96060;
}*/

.menu-text {
    margin-top: 1vw;
    margin-bottom: 2.5vw;
    padding-top: 1vh;
    padding-bottom: 1vh;
    padding-left: 4vw;
    padding-right: 4vw;
    background-color: #B96060;
    color: white;
    font-weight: bold;
    border-radius: 10vw;
    border-style: solid;
    border-width: 5px;
    border-color: #EDB3B3;
    font-size: 2vw;
    text-align: center;
    z-index: 2;
    transition: 0.3s;
    text-shadow: 0px 0px 50px rgba(196, 196, 255, 0.5); /* Text shadow */
    box-shadow: 0px 0px 50px rgba(196, 196, 255, 0.5); /* Box shadow */
}

.menu-text:hover {
    text-decoration: none;
    background-color: #EDB3B3;
    color: #B96060;
    border-color: #B96060;
    transition: 0.3s;
}

  /* Your existing styles */

  @media only screen and (max-width: 767px) {
    /* Styles for screens smaller than 768 pixels wide */

    body {
      background-size: contain; /* Adjust background-size for smaller screens */
    }

    .text-center {
      padding-top: 5vw; /* Adjust padding for smaller screens */
      padding-bottom: 5vw;
      font-size: 4vw; /* Adjust font size for smaller screens */
    }

    .white-box-container {
      flex-direction: column; /* Stack white boxes vertically on smaller screens */
    }

    .white-box {
      width: 100%; /* Make white boxes full width on smaller screens */
      margin-left: 0;
      margin-right: 0;
    }

    .wbimg {
      height: 20vw; /* Adjust image size for smaller screens */
      width: 20vw;
    }

    .guh {
      font-size: 3vw; /* Adjust font size for smaller screens */
    }

    .menu-text {
      font-size: 4vw; /* Adjust font size for smaller screens */
    }
  }

    </style>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Task Manager</title>
</head>
<body>
    <!-- navbar.php -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="home_page.php">To Do List</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="Register.php">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h3 class="text-center">To Do List</h3>
    </div>

    <div class="white-thingy">

        <div class="grey-thingy">

            <div class="white-box-container">

                <div class="white-box-container-again">
                    <div class="white-box">
                        <img src="img/eoa.png" class="wbimg">
                    </div>
                    <p class="guh">Ease of<br>Use<p>
                </div>
                <div class="white-box-container-again">
                    <div class="white-box">
                        <img src="img/idk.png" class="wbimg">
                    </div>
                    <p class="guh">Simple<br>Features<p>
                </div>
                <div class="white-box-container-again">
                    <div class="white-box">
                        <img src="img/eyedropper.png" class="wbimg">
                    </div>
                <p class="guh">Clear<br>Visuals<p>
            </div>

        </div>
    </div>
  <!--<div class="menu-button">-->
    <a class="menu-text" href="login.php">Get Started!!</a>
  <!--</div>-->
      
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
