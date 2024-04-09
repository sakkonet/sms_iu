<div class="row g-0 ">
    <div class="col-12 col-md-12 col-lg-2 auth-main-col   p-5">

    </div>
    <div class="col-12 col-md-12 col-lg-8 auth-main-col  p-5">
        <div class="d-flex flex-column align-content-end">
            <div class="app-card app-card-stat shadow-lg h-100">
                <div class="app-card-body p-3 p-lg-4">
                    <div class="app-auth-body mx-auto">
                        <h5 class="auth-heading text-center mb-3">New Message</h5>
                        <hr>
                        <div class="auth-form-container text-start">
                            <form class="auth-form login-form" id="send-sms">
                                <div class=" mb-3">
                                    <label class="fw-bold">Enter Number(s)</label>
                                    <textarea style="height:80px;box-shadow: 0 0 1px #719ECE;" name="recipients" id="recipients" class=" form-control" placeholder="Enter numbers separated by commas.  e.g 0772988899,0755334223" required="required">0775959489</textarea>
                                </div>
                                <!--//form-group-->
                                <div class="mb-3">
                                    <label class="fw-bold">Text Message</label>
                                    <textarea id="message" onkeyup="countChar(this)" style="height:100px;box-shadow: 0 0 1px #719ECE;" rows="5" cols="50" name="message" class="form-control " placeholder="Your Message......... Max 160 characters" required="required">Dear Ajuna, Deposit on A/C xxxx673, amt: 20,000/=, Today: <?php echo date('Y-m-d H:i:s'); ?> . Balance:1,893,000/= Thank You!</textarea></textarea>
                                    <div class="float-end" id="charNum"></div>
                                </div>
                                <!--//form-group-->
                                <div class="text-center">
                                    <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Send</button>
                                </div>
                            </form>
                        </div>
                        <!--//auth-form-container-->
                    </div>
                </div>
            </div>

        </div>
        <!--//flex-column-->
    </div>
    <div class="col-12 col-md-12 col-lg-2 auth-main-col   p-5">

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
            return this.optional(element) || /^[0-9\,+\s]+$/i.test(value);
        }, "Numbers must be separated by commas(,) only");

        $.validator.addMethod("ug_phone", function(value, element) {
            return this.optional(element) || /^\+256|0/i.test(value);
        }, "Number is invalid: Please enter a valid number.");

        $('#send-sms').validate({
            rules: {
                // simple rule, converted to {required:true}
                recipients: {
                    required: true,
                    minlength: 10,
                    nowhitespace: true,
                    letterswithbasicpunc: true
                },
                // compound rule
                message: {
                    required: true,
                }
            },
            submitHandler: function(form) {

                enableDisableButton(form, true);
                $.ajax({
                    url: '<?php echo api_url . "/sms/send"; ?>',
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

    function countChar(val) {
        var len = val.value.length;
        // if (len >= 160) {
        //     val.value = val.value.substring(0, 160);
        // } else {
        //     $('#charNum').text(0 + len);
        // }
        $('#charNum').text(0 + len);
    };

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