<!DOCTYPE html>
<html lang="en">

<head>
    <title>UCCFS SMS - LOGIN</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="UCCFS SMS - LOGIN">
    <meta name="author" content="UCCFS SMS - LOGIN">
    <link rel="shortcut icon" href="favicon.ico">

    <!-- FontAwesome JS-->
    <script defer src="<?php echo base_url("assets/plugins/fontawesome/js/all.min.js"); ?>"></script>
    <link id="theme-style" rel="stylesheet" href="<?php echo base_url("assets/css/portal.css"); ?>">
    <!-- Toastr style -->
    <link href="<?php echo base_url("assets/css/plugins/toastr/toastr.min.css"); ?>" rel="stylesheet">
    <style>
        .overlay {
            display: none;
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 3000;
            background: rgba(255, 255, 255, 0.3) url('<?php echo base_url(); ?>images/loader.gif') center no-repeat;
        }

        /* Turn off scrollbar when body element has the loading class */
        body.loading {
            overflow: hidden;
        }

        /* Make spinner image visible when body element has the loading class */
        body.loading .overlay {
            display: block;
        }
    </style>
</head>

<body class="app app-login p-0">
    <div class="row g-0 app-auth-wrapper">
        <div class="col-12 col-md-12 col-lg-12 auth-main-col text-center p-5">
            <div class="d-flex flex-column align-content-end">
                <div class="app-auth-body mx-auto">
                    <div class="app-auth-branding mb-4"><a class="app-logo" href="#"><img class="" src="images/logo.jpg" alt="logo"></a></div>
                    <h2 class="auth-heading text-center mb-4">Log In</h2>
                    <div class="auth-form-container text-start" style="padding:40px;box-shadow: 0 0 20px #719ECE;">
                        <form class="auth-form login-form" id="login">
                            <div class="email mb-3">
                                <label class="sr-only" for="signin-email">Email</label>
                                <input id="email" name="email" type="email" class="form-control signin-email" placeholder="Email address" required="required">
                            </div>
                            <!--//form-group-->
                            <div class="password mb-3">
                                <label class="sr-only" for="signin-password">Password</label>
                                <input id="password" name="password" type="password" class="form-control signin-password" placeholder="Password" required="required">
                                <div class="extra mt-3 row justify-content-between">
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="RememberPassword">
                                            <label class="form-check-label" for="RememberPassword">
                                                Remember me
                                            </label>
                                        </div>
                                    </div>
                                    <!--//col-6-->
                                    <div class="col-6">
                                        <div class="forgot-password text-end">
                                            <a href="#">Forgot password?</a>
                                        </div>
                                    </div>
                                    <!--//col-6-->
                                </div>
                                <!--//extra-->
                            </div>

                            <!--//form-group-->
                            <div class="text-center">
                                <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Log In</button>
                            </div>


                        </form>

                        <div class="auth-option text-center pt-5">No Account? Sign up <a class="text-link" href="#">here</a>.</div>
                    </div>
                    <!--//auth-form-container-->

                </div>
                <!--//auth-body-->

                <footer class="app-auth-footer">
                    <div class="container text-center py-3">
                        <!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
                        <small class="copyright">&copy; UCCFS - All rights reserved!<span class="sr-only">love</span><i class="fas fa-heart" style="color: #fb866a;"></i> </small>

                    </div>
                </footer>
                <!--//app-auth-footer-->
            </div>
            <!--//flex-column-->
        </div>

    </div>
    <!--//row-->
    <!-- Toastr script -->
    <script src="<?php echo base_url("assets/js/jquery-3.6.0.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/jquery.validate.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/plugins/toastr/toastr.min.js"); ?>"></script>
    <!-- Bootstrap validator script -->
    <script src="<?php echo base_url("assets/js/plugins/validate/validator.min.js"); ?>"></script>
    <!-- start:: CUSTOM JS -->
    <script type="text/javascript">
        $('#login').validate({
            rules: {
                // simple rule, converted to {required:true}
                email: {
                    required: true,
                    email: true
                },
                // compound rule
                password: {
                    required: true,
                }
            },
            submitHandler: function(form) {
                // var x = document.getElementById("login-before");
                // var y = document.getElementById("login-after");
                // x.style.display = "none";
                // y.style.display = "block";
                enableDisableButton(form, true);
                $.ajax({
                    url: '<?php echo api_url . "/login"; ?>',
                    type: 'POST',
                    data: $(form).serialize(),

                    dataType: 'json',
                    success: function(feedback) {
                        if (feedback.status) {
                            toastr.success(feedback.message, "Success");
                            enableDisableButton(form, false);
                            postdata(feedback);
                        } else {
                            toastr.warning(feedback.message, "Failure!");
                            enableDisableButton(form, false);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("Network error!");
                        network_error(jqXHR, textStatus, errorThrown, form);
                        enableDisableButton(form, false);
                        // x.style.display = "block";
                        // y.style.display = "none";

                    }
                });
            }
        });


        function postdata(formdata) {
            $.ajax({
                url: 'login/auth',
                data: formdata,
                type: 'POST',
                success: function(data) {
                    window.location.replace("home");
                }
            });
        }

        function network_error(jqXHR, textStatus, errorThrown, formElement) {
            var msg = "Network error. Please check your network/internet connection or get in touch with the admin.";
            status = jqXHR.status;
            switch (status) {
                case 500:
                    msg = "There was a server problem.\nPlease report the following message to admin\n" + textStatus;
                    break;
                case 404:
                    msg = "The operation was unsuccessful.\n Please report the following message to admin\n" + textStatus + "\n" + errorThrown;
                    break;
                default:
                    break;
            }
            toastr.error(msg, "Network failure!");
            console.log("Status : " + textStatus + "\nStatus code: " + status + "\nResponse: " + errorThrown);
            enableDisableButton(formElement, false);
        }

        function enableDisableButton(frm, status) {
            $(frm).find(":input[type=submit], :button[type=submit]").prop("disabled", status);
        }
    </script>
    <!-- end:: CUSTOM JS -->
</body>

</html>