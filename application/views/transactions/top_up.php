<div class="row g-0 ">
    <div class="col-12 col-md-12 col-lg-3 auth-main-col   p-5">

    </div>
    <div class="col-12 col-md-12 col-lg-6 auth-main-col   p-5">
        <div class="d-flex flex-column ">
            <div class="app-card app-card-stat shadow-sm h-100">
                <div class="app-card-body p-3 p-lg-4">
                    <h5 class="auth-heading text-center mb-2">Topup/Deposit</h5>
                    <hr>
                    <div class="auth-form-container text-start">
                        <form class="auth-form login-form" id="send-sms">
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
    <div class="col-12 col-md-12 col-lg-3 auth-main-col   p-5">

    </div>
    <!--//flex-column-->
</div>

</div>

<!-- start:: CUSTOM JS -->
<script type="text/javascript">
    var viewModel = {};

    $(document).ready(function() {
        var ViewModel = function() {
            var self = this;
            self.balance = ko.observable(0);
            self.sms_cost = ko.observable(0);
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
                            get_balance();
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