<!DOCTYPE html>
<html lang="en">
<head>
    <title>Course Planner</title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">



    <!-- W3 CSS -->
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <!-- Color theme -->
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3-theme-teal.css">
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Google Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="js/Official/bootbox.min.js"></script>

    <!-- Links to custom js -->
    
    <script src="js/printThis.js"    type="text/javascript"></script>
    <script src="js/general.js"     type="text/javascript"></script>
    <script src="js/global.js"      type="text/javascript"></script>
    <script src="js/display.js"     type="text/javascript"></script>
    <script src="js/semester.js"    type="text/javascript"></script>
    <script src="js/course.js"      type="text/javascript"></script>
    <script src="js/initData.js?1"  type="text/javascript"></script>
    <script src="js/transcript.js"  type="text/javascript"></script>
    <script src="js/filter.js"      type="text/javascript"></script>
    <script src="js/courseModal.js" type="text/javascript"></script>
    <script src="js/verify.js"      type="text/javascript"></script>
    <script src="js/overview.js"    type="text/javascript"></script>
    <script src="js/printThis.js"   type="text/javascript"></script>
    <script src="js/tutorial.js"    type="text/javascript"></script>
    <script src="js/help.js"        type="text/javascript"></script>

    <!-- Nav tabs -->
    <style>
    /*#openOverviewButton:hover {
        <script src="js/coursePlanner.min.js"></script>
    }*/



    .circle {
        background: #f00;
        width: 20px;
        height: 20px;
        border-radius: 50%;
    }
    
    .nav-tabs > li.active > a,
    .nav-tabs > li.active > a:hover,
    .nav-tabs > li.active > a:focus{
        font-weight: bold;
    }

        /*button[disabled] + .tooltip {
          display: none !important;
        }*/
    </style>

    <!-- Slide Toggle Check Boxes, http://callmenick.com/post/css-toggle-switch-examples -->
    <style>
    label {
        cursor: pointer;
    }
    .starIcon {
        text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -2px black;
        color:yellow;
    }
    input[type=checkbox][slider=true] {
        visibility: hidden;
    }
        
    /* SLIDE ONE */
    .slideOne {
        width: 50px;
        height: 10px;
        background: #ccffff;
        margin: 20px auto;

        -webkit-border-radius: 50px;
        -moz-border-radius: 50px;
        border-radius: 50px;
        position: relative;

        -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
        -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
        box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
    }

    .slideOne label {
        display: block;
        width: 16px;
        height: 16px;

        -webkit-border-radius: 50px;
        -moz-border-radius: 50px;
        border-radius: 50px;

        -webkit-transition: all .4s ease;
        -moz-transition: all .4s ease;
        -o-transition: all .4s ease;
        -ms-transition: all .4s ease;
        transition: all .4s ease;
        cursor: pointer;
        position: absolute;
        top: -3px;
        left: -3px;

        -webkit-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
        -moz-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
        box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
        background: #99ff99;
                                                /* Top         Middle       Bottom*/
        background: -webkit-linear-gradient(top, #99ff99 0%, #00ff00 40%, #99ff99 100%);
        background: -moz-linear-gradient(top, #99ff99 0%, #00ff00 40%, #99ff99 100%);
        background: -o-linear-gradient(top, #99ff99 0%, #00ff00 40%, #99ff99 100%);
        background: -ms-linear-gradient(top, #99ff99 0%, #00ff00 40%, #99ff99 100%);
        background: linear-gradient(top, #99ff99 0%, #00ff00 40%, #99ff99 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#99ff99', endColorstr='#00ff00',GradientType=0 );
    }

    .slideOne input[type=checkbox]:checked + label {
        left: 37px;
    }

    </style>
</head>



<body id="body">
    <noscript><h1 style="width:90%;margin-left:10%;">This program makes heavy use of javascript, please enable it to continue.</h1></noscript>
    <div id="planSelector" class="w3-container" style="margin:0;padding:0;height:100vh;position:relative;">
        <!-- Banner -->
        <div class="w3-row w3-theme" style="height:5%">
            <!-- MyPlans -->
            <div class="w3-container w3-quarter"
                    style="background-color:inherit;height:100%;">  <!-- w3-btn w3-hover-black -->
                <span class="glyphicon glyphicon-apple" style="font-size:20px; color:#f2f2f2;"></span>
                <h3 class="modal-title" style="display:inline; font-weight:bold; color:#f2f2f2;">Course Planner</h3>
            </div>

           
            <!-- /MyPlans -->

            <div class="w3-container w3-threequarter" style="background-color:inherit;height:100%;">
                
                <!-- Options -->
                <div id="optionsModelButton" class="w3-container w3-right w3-btn" style="height:100%;background-color:inherit;padding:0;" data-toggle="modal" data-target="#optionsModal">
                    <div class="w3-container w3-right w3-btn w3-hover-black" data-toggle="tooltip" data-placement="bottom"
                         title="Options" style="background-color:inherit;height:100%;">
                        <span class="glyphicon glyphicon-option-vertical" style="font-size:20px;margin-top:5px;"></span>
                    </div>
                </div>

                <!-- Help -->
                <div id="helpModelButton" class="w3-container w3-right w3-btn" style="height:100%;background-color:inherit;padding:0;" data-toggle="modal" data-target="#helpModal">
                    <div id="helpModelButton" class="w3-container w3-right w3-btn w3-hover-black" data-toggle="tooltip"
                         data-placement="bottom" title="Help" style="background-color:inherit;height:100%;">
                        <span class="glyphicon glyphicon-question-sign" style="font-size:20px;margin-top:5px;"></span>
                    </div>
                </div>
                <div class="w3-container w3-right" style="padding:0;">
                    <script type='text/javascript' src='https://ko-fi.com/widgets/widget_2.js'></script>
                    <script type ='text/javascript'>kofiwidget2.init('Buy Us a Coffee', '#46b798', 'A260HGN');kofiwidget2.draw();</script> 
                </div>
            </div>
        </div>
        <!-- /Banner-->

        <!-- Main content -->
        <div id="main" class="w3-row" style="padding:0;height:95%;">
            <div id="mainLeft" class="w3-container w3-quarter" style="height:100%;padding:0">
                <!-- LEFT PANEL -->
                <?php include "php/leftPanel.php" ?>
                <!-- /LEFT PANEL -->
            </div>
            <div class="w3-container w3-threequarter" style="height:100%;padding:0;">
                    <!-- <ul id="addingFunctsNav" class="nav nav-tabs">
                        <li class="addingFuncsOptions active" style="width:44%">
                            <a data-toggle="tab" href="#addSemester" style="text-align:center">+Semester</a>
                        </li>
                        <li class="addingFuncsOptions" style="width:44%">
                            <a data-toggle="tab" href="#addCourse" style="text-align:center">+Course</a>
                        </li>
                        <li style="margin-left:2%;margin-right:2%;height:100%;">
                            <button id="hideAddingFuncs" class="btn btn-danger" style="height:100%;">
                                <span class="glyphicon glyphicon-minus"></span>
                            </button>
                        </li>
                    </ul> -->
                <!-- INCLUDE TOPPANEL.PHP -->
                <div id="mainTop" style="padding:0%;margin:0%;overflow:none;display:none;">
                    <!-- TOP PANEL -->
                    <?php include "php/topPanel.php" ?>
                    <!-- /TOP PANEL -->
                </div>
                <div id="mainRight" style="padding:0;height:100%;">
                    <!-- RIGHT PANEL -->
                    <?php include "php/middlePanel.php" ?>
                    <div id="middleNoSemesters" style="height:100%;overflow-y:auto;background-color:#ccffff;text-align:center;">
                        <div style="text-align:center;margin-top:20%;display:inline-block;">
                            After you add your first semester, a grid of colorful buttons should appear here. If not, there has been an error.
                            Please refresh or try a different browser.<br>
                            <br>
                            If this is your first time, open our <button id="startTutorial">Brief Overview</button> here, or in help 
                            <span class="glyphicon glyphicon-question-sign  w3-theme" style="font-size:20px;"></span><br>
                        </div>
                        <!-- <img src="images/Tutorial Picture.jpg" style="width:100%;"> -->
                        <!-- <h2 style="display:inline;top:50%;">This must be your first time here!</h2>
                        <h3 style="position:absolute; bottom:70px;">
                            <span class="glyphicon glyphicon-chevron-left"></span>Add Your First Semester Here</h3>
                        <h3 style="position:absolute; bottom:10px;">
                            <sp -->
                                <!-- an class="glyphicon glyphicon-chevron-left"></span>Delete Semesters Here</h3> -->
                    </div>
                    <!-- /RIGHT PANEL -->
                </div>
            </div>
        </div>
        <!-- /Main content -->
    </div>

    <!-- SEMESTER MODAL -->
    <?php include "php/semesterModal.php"; ?>
    <!-- /SEMESTER MODAL -->

    <!-- tabindex="-1" is to fix jquery bug, wrt closing on offclick -->
    <div id="overviewModal" class="modal fade w3-container" data-backdrop="true" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Overview</h4>
                </div>
                <div class="modal-body">
                    <label for="searchOverview">Search: </label><input maxlength="12" id="searchOverview" type="text"></input> <span id="searchOverviewResults"></span>
                    <div id="overviewContent">

                    </div>
                </div>
                <div class="modal-footer">
                    Print in portrait and remember to verify our information!
                    <button type="button" class="btn btn-info" id="printModal">Print</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <div id="helpModal" class="modal fade w3-container" data-backdrop="true" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Help</h4>
                </div>
                <div class="modal-body" style="text-align:center;">
                    <div class="w3-row">
                        <button class="btn btn-info help" value="11" style="width:100%;" id="allToolTips" data-dismiss="modal">
                            Label Everything
                        </button><br>
                        <button id="breifOverview" class="btn btn-info help" value="7" style="width:100%;">Brief Overview</button><br>
                        <button class="btn btn-info help" value="0" style="width:100%;">Where Is Everything?</button><br>
                        <br>
                       
                        
                        <!-- <button class="btn btn-primary help" value="1" style="width:100%;">Filters</button><br> -->
                        <button class="btn btn-primary help" value="2" style="width:100%;">Course Colorings</button><br>
                        <!-- <button class="btn btn-primary help" value="3" style="width:100%;">Overview</button><br> -->
                        <!-- <button class="btn btn-primary help" value="4" style="width:100%;">Upload Transcript</button><br> -->
                        <button class="btn btn-primary help" value="5" style="width:100%;">Printing & Saving</button><br>
                        <!-- <button class="btn btn-primary help" value="6" style="width:100%;">Transferring Browsers/Computers</button><br> -->
                        
                        <!-- <button class="btn btn-info help" value="8" style="width:100%;" disabled>Videos</button><br> -->
                        <br>
                        <button class="btn btn-warning help" value="8" style="width:100%;">Contact / Feedback</button><br>
                        <button class="btn btn-warning help" value="9" style="width:100%;">Who Are You?</button><br>
                        <br>
                        
                        <button class="btn btn-success help" value="12" style="width:100%;">Tips</button><br>
                        <br> 

                        <button class="btn btn-danger help" value="10" style="width:100%;">I Still Can't Find What I'm Looking For!</button><br>
                        <br>
                        <b>For more information, checkout our <a target="_blank" href="https://www.facebook.com/guelphcourseplanner/">Facebook Page</a>!
                        You can also help us out by filling out our quick <a href="https://www.surveymonkey.com/r/6YCQYRX" target="_blank">Survey</a>
                        to give us feedback. If you want to know about future updates you can also sign up to our <a target="_blank" href="http://www.subscribepage.com/a3i8u1">Mailing List</a>.
                    </b>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div id="optionsModal" class="modal fade w3-container" data-backdrop="true" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Options</h4>
                </div>
                <div class="modal-body">
                    <button id="" style="width:100%;" class="openUploadTS btn btn-success">Upload Transcript</button>
                    <button id="transferData" style="width:100%;" data-dismiss="modal" class="btn btn-success">Saving & Transferring</button>
                    <br>
                    <br>
                    <button id="toggleToolTips" style="width:100%;" data-dismiss="modal" class="btn btn-primary">Disable/Enable Hover ToolTips</button>
                    <button id="toggleAlerts" style="width:100%;" value='1' data-dismiss="modal" class="btn btn-primary">Disable/Enable Popup Messages</button>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="pickSubjectScreen" data-backdrop="true" tabindex="-1" role="dialog">
        <div class="modal-dialog" style="height:90%;width:95%;">
            <!-- Modal content-->
            <div class="modal-content" style="width:90%;left:5%;height:100%;">
                <div class="modal-header modal-header-success" style="height:10%;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title" style="text-align:center;">Choose Subject By Name</h3>
                </div>
                <div class="modal-body" style="height:90%;">
                    <!-- <div class="form-group"> -->
                        <div id="pickSubjectSubjectsName" style="height:100%;">
                            If you see this, there has been an error. Please refresh or try a different browser.
                        </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Alert -->
    <div class="alert alert-success" id="alertMessages" style="position:fixed;top:60px;right:0;">
        <button type="button" class="close" onclick="$('.alert').hide()">x</button>
        <span id="alertMessagesMessage"></span>
    </div>

    <!-- Old Input for building prereqs parser, content removed -->
    <div id="input" style="display:none;"></div>

    <div id="viewCounter" style="display:none;">
    <div align='center'><a href='http://www.hit-counter-html-code.com'><img src='http://hit-counter-html-code.com/wp-content/themes/customizr/hitcounter/c.php?d=5&id=160558&s=135' border='0' title='Web Design Orange County'></a><br / ><small><a href='http://www.hit-counter-html-code.com' title="Web Design Orange County">Web Design Orange County</a></small></div>
</div>
    </body>
</html>
