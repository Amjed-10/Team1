<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <style>
                /* styles.css */

                * {
        margin: 0px;
        padding: 0px;
        box-sizing: border-box;
        }
        html,
        body {
        font-family: Roboto, sans-serif, arial;
        font-size: 16px;
        color: #242424;
        body: center;
        }
        .container1 {
        width: 1300px;
        margin: 0px auto;
        }
        .main-section {
        width: 100%;
        float: left;
        padding: 70px 0px 70px 0px;
        }
        .heading {
        font-size: 28px;
        font-weight: 500;
        border-bottom: 1px solid #518aa7;
        margin-bottom: 20px;
        color: #518aa7;
        }
        /********* Common CSS End **********/

        /********* Header HTML CSS Starts **********/
        .header {
            background: #518aa7;
            padding: 6px;
        }
        .header b {
            background: #fff;
            color: 004183;
            padding:10px;
            font-size: 20px;
        }
        .header marquee {
            font-size:20px;
            color: #ffffff;
            width: 80%;
        }
        /********* Header HTML CSS End **********/
        .container2 {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Button styling */
        button {
            padding: 10px 20px;
            background-color: #518aa7;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
        }

        button:hover {
            background-color: #518aa7;
        }
                /********* Design Logo and Menu section CSS Starts **********/
        .logo {
            height: 97px;;
        }
        /*Menu Section Menu Section*/
        nav {
            float: right;
            padding:25px 0px;
        }
        nav a {
            color: black;
            text-decoration: none;
            font-size:18px;
            padding:2px 10px;
            font-weight:500;
        }
            /********* Design Logo and Menu section CSS End **********/
                /********* Slider CSS Starts **********/
        .slider img {
            width: 100%;
        }

                /********* Slider CSS End **********/

                /********* Campus, Events and Notice Board section CSS Starts **********/
        .event {
        width: 32%;
        margin-right: 1%;
        float: left;
        background-color: #fff;
        padding: 10px;
        }
        .event .heading {
        border-bottom: 1px solid #518aa7;
        padding: 5px;
        color: #fff;
        background: #518aa7;
        text-align: center;
        }
        .event ul li {
        margin-bottom: 20px;
        width: 100%;
        float: left;
        list-style: none;
        }
        .event-date {
        background: #518aa7;
        float: left;
        text-align: center;
        font-size: 14px;
        color: #fff;
        padding: 8px 12px;
        margin-right: 10px;
        }

        /********* Campus, Events and Notice Board section CSS End **********/
        /********** About Us CSS Starts **********/  
        .about-us div {
        width: 45%;
        float: left;
        line-height: 30px;
        font-size: 18px;
        }
        .about-us h4 {
        font-size: 22px;
        }
        .about-us p {
        line-height: 42px;
        }
        .about-us img {
        width: 40%;
        float: left;
        }
        /********** About Us CSS Ends **********/
        /********** School Info, Award and Certificate CSS Starts **********/  
.award p {
  width: 100%;
  float: left;
  font-size: 16px;
}
.award img {
  width: 100%;
}
.award b {
  min-width: 115px;
  float: left;
  margin-bottom: 20px;
}
.award h3 {
  font-size: 23px;
  margin-bottom: 20px;
  text-align: center;
}
/********** School Info, Award and Certificate CSS Ends **********/
/********* Gallery section CSS Starts **********/
.gallery img {
  width: 24%;
}
/********* Gallery section CSS End **********/

            </style>
</head>
<body>
                <!------ Header HTML Starts  ------->
    <div class="header">
        <div class="container1">
        <b> NEWS : </b>
        <marquee>😂😂 الدفعه الجديده شكلها تعبانه موت  </marquee>
        </div>
    </div>
    <!------ Header HTML Ends ------->
            
    <!------ Design Logo And Main Menu Section HTML Startss ------->
    <div class="container1">
    <!-------------------------LOGO SECTION--------------------------->
    <img src="294445316_107952225324580_7070432144729465402_n.jpg" class="logo">
    <!-------------------------MENU SECTION-------------------------->
    <nav>
        <a href="index.php">Home</a>
        <a href="login.php">Login</a>
        <a href="register.php">register</a>
        <a href="chatbot.php">chatbot for any question</a>
        <a href="attendance.php">attendance students</a>
        <a href="schedule.php">Weekly school schedule</a>
    </nav>
    </div>
<!------ Design Logo And Main Menu Section HTML End ------->
    <!------ Slider HTML Starts ------->
    <div class="slider">
        <img src="slider.jpg">
    </div>
    <!------ Slider HTML End ------->

    <div class="container2">
        <h2>Welcome to the Ahmed Daif Allah International Applied School
        </h2>
        <p>Select the page you want to visit:</p>
        <button onclick="window.location.href='chatbot.html'">Chatbot</button>
        <button onclick="window.location.href='attendance.html'">Attendance</button>
        <button onclick="window.location.href='schedule.html'">Schedule</button>

    </div>

    <!------ Campus, Events and Notice Board HTML Starts ------->
    <div class="main-section" style="background:#f0f3fa">
        <div class="container1">
        <!--------------------------------CAMPUS NEWS SECTION ---------------------------->
        <div class="event">
            <h2 class="heading">Campus News</h2>
            <div>
            <marquee direction="up" scrollamount="7" style="height:340px;">
                <ul>
                <li>
                    <i>01-April-2023 :</i> made by Zyad ayman <img src="images/new.gif">
                </li>
                <li>
                    <i>01-April-2023 :</i> made by Zyad ayman <img src="images/new.gif">
                </li>
                <li>
                    <i>01-April-2023 :</i> made by Zyad ayman <img src="images/new.gif">
                </li>
                <li>
                    <i>01-April-2023 :</i> made by Zyad ayman <img src="images/new.gif">
                </li>
                <li>
                    <i>01-April-2023 :</i> made by Zyad ayman <img src="images/new.gif">
                </li>
                <li>
                    <i>01-April-2023 :</i> made by Zyad ayman <img src="images/new.gif">
                </li>
                <li>
                    <i>01-April-2023 :</i> made by Zyad ayman <img src="images/new.gif">
                </li>
                </ul>
            </marquee>
            </div>
        </div>
        <!----------------------------EVENT SECTION ----------------------->
        <div class="event">
            <h2 class="heading">Events</h2>
            <div>
            <ul>
                <li>
                <span class="event-date">9 <br> SEP </span> made by Zyad ayman
                </li>
                <li>
                <span class="event-date">9 <br> April </span> made by Zyad ayman
                </li>
                <li>
                <span class="event-date">9 <br> April </span> made by Zyad ayman
                </li>
                <li>
                <span class="event-date">9 <br> April </span> made by Zyad ayman
                </li>
                <li>
                <span class="event-date">9 <br> April </span> made by Zyad ayman
                </li>
            </ul>
            </div>
        </div>
        <!--------------------------------NOTICE BOARD SECTION ------------------------->
        <div class="event">
            <h2 class="heading">Notice Boards</h2>
            <div>
            <ul>
                <li>
                <img src="images/folder.png"> made by Zyad ayman
                </li>
                <li>
                <img src="images/folder.png"> made by Zyad ayman
                </li>
                <li>
                <img src="images/folder.png"> made by Zyad ayman
                </li>
                <li>
                <img src="images/folder.png"> made by Zyad ayman
                </li>
                <li>
                <img src="images/folder.png"> made by Zyad ayman
                </li>
                <li>
                <img src="images/folder.png"> made by Zyad ayman
                </li>
            </ul>
            </div>
        </div>
        </div>
    </div
  <!------ Campus, Events and Notice Board HTML End ------->
  <!---------- About Us HTML Starts --------->
<div class="main-section">
    <div class="container1 about-us">
      <div>
        <h2 class="heading">About our school</h2>
        <h4>مدرسة أحمد ضيف الله الدولية للتكنولوجيا التطبيقية.</h4>
        <p> Our school is an international technological application school specializing in Information Technology and Artificial Intelligence. We are a proud member of the Egyptian technical education system, offering cutting-edge education in these innovative fields.
        </p>
      </div>
      <img src="WhatsApp Image 2024-09-08 at 16.02.41_dd3d7236.jpg">
    </div>
  </div>
  <!---------- About Us HTML Ends --------->
  <!---------- School Info, Award and Certificate HTML Starts --------->
<div class="main-section award" style="background:#f0f3fa">
    <div class="container1">
      <!---------------- SCHOOL INFO SECTION --------------->
      <div class="event">
        <h2 class="heading">School Info</h2>
        <div>
          <h3>My Ahmed Daif Allah International Applied SCHOOL</h3>
          <p>
            <b>Principal : </b> Dr. moahmed adly 
          </p>
          <p>
            <b>Address : </b> ma3rafsh
          </p>
          <p>
            <b>City : </b> assuit
          </p>
          <p>
            <b>Contact No. : </b> 0000000000000
          </p>
          <p>
            <b>Email Id : </b> Contact@admin
          </p>
        </div>
      </div>
      <!---------------- SCHOOL AWARD SECTION --------------->
      <div class="event">
        <h2 class="heading">Our School Awards</h2>
        <div>
          <img src="412921857_334999332628525_1406524892386499388_n.jpg">
        </div>
      </div>
      <!---------------- SCHOOL CERTIFICATE SECTION --------------->
      <div class="event">
        <h2 class="heading">My School Certificate</h2>
        <div>
          <img src="426256858_364451269683331_6787085383989363429_n.jpg">
        </div>
      </div>
    </div>
  </div>
  <!---------- School Info, Award and Certificate HTML Ends --------->
  <!--------- Gallery HTML Starts -------->
<div class="main-section gallery" style="background:#f0f3fa">
    <div class="container1 ">
      <h2 class="heading">Our School Gallery</h2>
      <img src="294300306_107951301991339_8791434092903479389_n.jpg">
      <img src="294445316_107952225324580_7070432144729465402_n.jpg">
      <img src="412921857_334999332628525_1406524892386499388_n.jpg">
      <img src="426256858_364451269683331_6787085383989363429_n.jpg">
      <img src="447040287_429172359877888_1896755628707271886_n.jpg">
      <img src="447041028_429172766544514_3673186049343953230_n.jpg">
      <img src="447296016_429172919877832_8928595561459631063_n.jpg">
      <img src="447041028_429172766544514_3673186049343953230_n.jpg">
    </div>
  </div>
  <!--------- Gallery HTML End --------> 
    <script>

document.getElementById('logoutButton').addEventListener('click', function() {
    localStorage.removeItem('loggedIn');
    window.location.href = 'login.html'; // Redirect to login page
});

        // Check if user is logged in
        document.addEventListener('DOMContentLoaded', function() {
            const isLoggedIn = localStorage.getItem('loggedIn');
            if (!isLoggedIn) {
                window.location.href = 'login.html';
            }


        });
    </script>
</body>
</html>
