<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.dashboardpack.com/adminty-html/default/sample-page.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 Jun 2022 07:59:03 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <title><?php echo $this->template->title->default("SMS-UCCFS"); ?></title>
    <meta property="og:description" content="<?php echo $this->template->description; ?> ">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="#">
    <meta name="keywords"
        content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <?php echo $this->template->meta; ?>
    <link rel="icon" href="../files/assets/images/favicon.ico" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../files/bower_components/bootstrap/dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="../files/assets/icon/themify-icons/themify-icons.css">

    <link rel="stylesheet" type="text/css" href="../files/assets/icon/icofont/css/icofont.css">

    <link rel="stylesheet" type="text/css" href="../files/assets/icon/feather/css/feather.css">

    <link rel="stylesheet" type="text/css" href="../files/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../files/assets/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="../files/assets/scss/partials/menu/_pcmenu.html">
    <?php echo $this->template->stylesheet; ?>
</head>

<body>

    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <?php
             $this->view('includes/admin_nav');
            // This is the content view file loaded from the controller
             echo $this->template->content;
            ?>


        </div>
    </div>
    </div>
    </div>
    </div>
    <div id="styleSelector">
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <script type="text/javascript" src="../files/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="../files/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../files/bower_components/popper.js/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="../files/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="../files/bower_components/jquery-slimscroll/jquery.slimscroll.js"></script>

    <script type="text/javascript" src="../files/bower_components/modernizr/modernizr.js"></script>
    <script type="text/javascript" src="../files/bower_components/modernizr/feature-detects/css-scrollbars.js"></script>

    <script type="text/javascript" src="../files/bower_components/i18next/i18next.min.js"></script>
       
    <script type="text/javascript" src="../files/bower_components/i18next-xhr-backend/i18nextXHRBackend.min.js">
    </script>
       
    <script type="text/javascript"
        src="../files/bower_components/i18next-browser-languagedetector/i18nextBrowserLanguageDetector.min.js"></script>
       
    <script type="text/javascript" src="../files/bower_components/jquery-i18next/jquery-i18next.min.js"></script>
    <script src="../files/assets/js/pcoded.min.js"></script>
    <script src="../files/assets/js/vartical-layout.min.js"></script>
    <script src="../files/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>

    <script type="text/javascript" src="../files/assets/js/script.js"></script>
    <?php echo $this->template->javascript; ?>
    <?php $this->view('includes/helpers'); ?>
</body>

</html>