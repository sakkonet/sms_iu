<h1 class="app-page-title">Settings > <span data-bind="text:user().user_type_id==1?(user().firstname+' '+user().lastname):user().organisation" class="text-primary"></span>
    <div class="float-end">
        Account Balance <span data-bind="visible:parseFloat(balance2())<parseFloat(sms_cost2())" class="badge bg-danger">UGX:&nbsp;<span data-bind="text:curr_format(balance2())"></span></span>
        <span data-bind="visible:parseFloat(balance2())>parseFloat(sms_cost2())" class="badge bg-primary">UGX:&nbsp;<span data-bind="text:curr_format(balance2())"></span></span>
    </div>
</h1>

<hr class="mb-4">
<div class="row g-4 settings-section">
    <div class="col-12 col-md-6">
        <h3 class="section-title">Account Top Up</h3>
        <div class="section-intro">You can top up <span data-bind="text:user().user_type_id==1?(user().firstname+' '+user().lastname):user().organisation" class="text-primary"></span> account !</div>
        <div class="app-card-body">
            <div class="row g-0 ">
                <div class="col-12 col-md-12 col-lg-8 auth-main-col">
                    <div class="d-flex flex-column ">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h5 class="auth-heading text-center mb-2">Topup/Deposit</h5>
                                <div class="col-auto">
                                    Account Balance <span data-bind="visible:parseFloat(balance2())<parseFloat(sms_cost2())" class="badge bg-danger">UGX:&nbsp;<span data-bind="text:curr_format(balance2())"></span></span>
                                    <span data-bind="visible:parseFloat(balance2())>parseFloat(sms_cost2())" class="badge bg-primary">UGX:&nbsp;<span data-bind="text:curr_format(balance2())"></span></span>
                                </div>
                                <hr>
                                <div class="auth-form-container text-start">
                                    <form class="auth-form login-form" id="send-sms">
                                        <input hidden name="id" value="<?php echo $id; ?>" />
                                        <div class=" mb-3">
                                            <label>Enter Phone Number</label>
                                            <input type="text" readonly name="phone_number" id="phone_number" class=" form-control" placeholder="Enter Phone Number" required="required" value="0000000000" />
                                        </div>
                                        <!--//form-group-->
                                        <div class="mb-3">
                                            <label>Amount</label>
                                            <input id="amount" name="amount" class="form-control " placeholder="Enter Amount!" required="required" />
                                        </div>
                                        <!--//form-group-->
                                        <div class="text-center">
                                            <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Deposit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--//app-card-->
                        <!--//auth-form-container-->
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <h3 class="section-title">Password</h3>
        <div class="section-intro">You can reset <span data-bind="text:user().firstname+' '+user().lastname" class="text-primary"></span> account password!</div>
        <div class="app-card-body">
            <div class="row g-0 ">

                <div class="col-12 col-md-12 col-lg-8 auth-main-col">

                    <div class="d-flex flex-column ">
                        <div class="app-card app-card-settings  shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h5 class="auth-heading text-center mb-2">Change Password</h5>
                                <hr>
                                <div class="auth-form-container text-start">
                                    <form class="auth-form login-form" id="set-password">
                                        <input hidden name="id" value="<?php echo $id; ?>" />
                                        <div class=" mb-3">
                                            <label>New Password</label>
                                            <input type="password" name="password" id="password" class=" form-control" placeholder="New Password" required="required" />
                                        </div>
                                        <!--//form-group-->
                                        <div class="mb-3">
                                            <label>Confirm Password</label>
                                            <input id="confirm_password" type="password" name="confirm_password" class="form-control " placeholder="Confirm Password!" required="required" />
                                        </div>
                                        <!--//form-group-->
                                        <div class="text-center">
                                            <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Change</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--//app-card-->
                        <!--//auth-form-container-->
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4 auth-main-col ">

                </div>
            </div>
        </div>
        <!--//app-card-body-->

    </div>
</div>
<!--//row-->
<hr class="mb-4">
<div class="row g-4 settings-section">
    <div class="col-12 col-md-4">
        <h3 class="section-title">Generate API Key</h3>
        <div class="section-intro">This is a secret key and should not be shared by anyone else</div>
    </div>
    <div class="col-12 col-md-8">
        <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
            <div class="inner">
                <div class="app-card-body p-3 p-lg-4">
                    <div data-bind="visible:apiStatus()==1,text:apiKey()" style="background-color: #f0f5f1;padding:10px; font-size:20px;" class="mb-3"> </div>
                    <div class="row gx-5 gy-3">
                        <div class="col-12 col-lg-8">

                            <div data-bind="visible:apiStatus()==1" class="text-danger">Copy and save the generated API key somewhere as you will not be able to retrieve it incase you leave or refresh this page. </div>
                            <div data-bind="visible:apiStatus()==0">Use the button to generate the API Key</div>
                        </div>
                        <!--//col-->
                        <div class=" col-12 col-lg-4">
                            <form class="auth-form login-form" id="get-api">
                                <input type="hidden" name="user_id" value="<?php echo $id; ?>" />
                                <button type="submit" class="btn app-btn-primary"><i class="fa fa-cog"></i> Generate API Key</button>
                            </form>
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                </div>
                <!--//app-card-body-->

            </div>
            <!--//inner-->
        </div>
        <!--//app-card-->
    </div>
</div>
<!--//row-->
<hr class="my-4">



<!-- start:: CUSTOM JS -->
<script type="text/javascript">
    var viewModel = {};

    $(document).ready(function() {
        getUserDetails();
        get_balance2();
        var ViewModel = function() {
            var self = this;
            self.balance = ko.observable(0);
            self.sms_cost = ko.observable(0);
            self.user = ko.observableArray();

            self.apiStatus = ko.observable(0);
            self.apiKey = ko.observable();
            self.balance2 = ko.observable(0);
            self.sms_cost2 = ko.observable(0);
        };
        viewModel = new ViewModel();
        ko.applyBindings(viewModel);

        $.validator.addMethod("nowhitespace", function(value, element) {
            return this.optional(element) || /^\S+$/i.test(value);
        }, "No white space please.");

        $.validator.addMethod("letterswithbasicpunc", function(value, element) {
            return this.optional(element) || /^[0-9\,\s]+$/i.test(value);
        }, "Numbers with commas only please.");

        $.validator.addMethod("regex", function(value, element) {
            return this.optional(element) || /^(\d+|\d+,\d{1,2})$/i.test(value);
        }, "Number is invalid: Please enter a valid number.");


        $('#send-sms').validate({
            rules: {
                // simple rule, converted to {required:true}
                phone_number: {

                },
                // compound rule
                amount: {
                    required: true,
                    min: 100,
                    nowhitespace: true,
                    letterswithbasicpunc: true
                }
            },
            submitHandler: function(form) {
                enableDisableButton(form, true);
                $.ajax({
                    url: '<?php echo api_url . "/transaction/deposit"; ?>',
                    type: 'POST',
                    data: $(form).serialize(),
                    headers: {
                        Authorization: 'Bearer ' + '<?php echo $this->session->userdata('auth_token'); ?>'
                    },
                    dataType: 'json',
                    success: function(feedback) {
                        if (feedback.status) {
                            toastr.success(feedback.message, "Success");
                            enableDisableButton(form, false);
                            get_balance2();
                        } else {
                            toastr.warning(feedback.message, "Failure!");
                            enableDisableButton(form, false);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("Network error!");
                        network_error(jqXHR, textStatus, errorThrown, form);
                        enableDisableButton(form, false);

                    }
                });
            }
        });

        $('#set-password').validate({
            rules: {
                // simple rule, converted to {required:true}
                password: {
                    required: true,
                    minlength: 5,
                    nowhitespace: true
                },
                // compound rule
                comfirm_password: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                }
            },
            submitHandler: function(form) {
                enableDisableButton(form, true);
                $.ajax({
                    url: '<?php echo api_url . "/user/change_password"; ?>',
                    type: 'POST',
                    data: $(form).serialize(),
                    headers: {
                        Authorization: 'Bearer ' + '<?php echo $this->session->userdata('auth_token'); ?>'
                    },
                    dataType: 'json',
                    success: function(feedback) {
                        if (feedback.status) {
                            toastr.success(feedback.message, "Success");
                            enableDisableButton(form, false);

                        } else {
                            toastr.warning(feedback.message, "Failure!");
                            enableDisableButton(form, false);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("Network error!");
                        network_error(jqXHR, textStatus, errorThrown, form);
                        enableDisableButton(form, false);

                    }
                });
            }
        });

        $('#get-api').validate({
            submitHandler: function(form) {

                enableDisableButton(form, true);
                $("body").addClass("loading");

                $.ajax({
                    url: '<?php echo api_url . "/auth/apiKey"; ?>',
                    type: 'POST',
                    data: $(form).serialize(),
                    headers: {
                        Authorization: 'Bearer ' + '<?php echo $this->session->userdata('auth_token'); ?>'
                    },
                    dataType: 'json',
                    success: function(feedback) {
                        setTimeout(function() {
                            viewModel.apiKey(feedback.api_key);
                            viewModel.apiStatus(1);

                            if (feedback.status) {
                                toastr.success(feedback.message, "Success");
                                enableDisableButton(form, false);
                                $("body").removeClass("loading");
                            } else {
                                toastr.warning(feedback.message, "Failure!");
                                enableDisableButton(form, false);
                                $("body").removeClass("loading");
                            }
                        }, 203);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("Network error!");
                        network_error(jqXHR, textStatus, errorThrown, form);
                        enableDisableButton(form, false);
                        $("body").removeClass("loading");

                    }
                });
            }
        });
    });


    function getUserDetails() {
        $.ajax({
            url: '<?php echo api_url . "/user/user"; ?>',
            headers: {
                Authorization: 'Bearer ' + '<?php echo $this->session->userdata('auth_token'); ?>'
            },
            type: 'POST',
            data: {
                user_id: <?php echo $id; ?>
            },
            dataType: 'json',
            success: function(feedback) {
                if (feedback.success) {
                    viewModel.user(feedback.data);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {

            }
        });
    }


    function get_balance2() {
        $.ajax({
            url: '<?php echo api_url . "/utils/creditBalance2"; ?>',
            headers: {
                Authorization: 'Bearer ' + '<?php echo $this->session->userdata('auth_token'); ?>'
            },
            type: 'POST',
            data: {
                id: <?php echo $id; ?>
            },
            dataType: 'json',
            success: function(feedback) {
                if (feedback.success) {
                    viewModel.balance2(feedback.data.acc_balance);
                    viewModel.sms_cost2(feedback.cost);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {

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