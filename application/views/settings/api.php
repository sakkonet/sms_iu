<div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
    <div class="inner">
        <div class="app-card-body p-3 p-lg-4">
            <div data-bind="visible:apiStatus()==1,text:apiKey()" style="background-color: #f0f5f1;padding:10px; font-size:20px;" class="mb-3"> </div>
            <div class="row gx-5 gy-3">
                <div class="col-12 col-lg-9">

                    <div data-bind="visible:apiStatus()==1" class="text-danger">Copy and save the generated API key somewhere as you will not be able to retrieve it incase you leave or refresh this page. </div>
                    <div data-bind="visible:apiStatus()==0">Use the button to generate the API Key</div>
                </div>
                <!--//col-->
                <div class=" col-12 col-lg-3">
                    <form class="auth-form login-form" id="get-api">
                        <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('id'); ?>" />
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
<!-- start:: CUSTOM JS -->
<script type="text/javascript">
    var viewModel = {};
    $(document).ready(function() {

        var ViewModel = function() {
            var self = this;
            self.apiStatus = ko.observable(0);
            self.apiKey = ko.observable();
            self.balance = ko.observable(0);
            self.sms_cost = ko.observable(0);
        };
        viewModel = new ViewModel();
        ko.applyBindings(viewModel);


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