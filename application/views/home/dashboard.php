<!-- New cards for the dashboard -->
<div class="row g-4 mb-3 pb-5">
    <div class="col-12 col-lg-3">
            <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm home-cards">
                <span class="badge bg-primary text-base"> Total Connected SACCOS</span>
                <div class="app-card-header p-3 border-bottom-0">
                    <div class="row align-items-center gx-3">
                        <div class="col-auto">
                            <div class="app-icon-holder">
                                <span class="icon-holder">
                                    <i class="fas fa-network-wired success"></i>
                                </span>
                            </div>
                            <!--//icon-holder-->
                        </div>
                        <!--//col-->
                        <div class="col-auto">
                            <h4 class="app-card-title">0</h4>
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                </div>

            </div>
    </div>

    <div class="col-12 col-lg-3">
        <a href="<?php echo base_url('messages/new'); ?>">
            <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm home-cards">
                <span class="badge bg-success">Total Messages Sent Today</span>
                <div class="app-card-header p-3 border-bottom-0">
                    <div class="row align-items-center gx-3">
                        <div class="col-auto">
                            <div class="app-icon-holder">
                                <span class="icon-holder">
                                    <i class="fas fa-mail-bulk success"></i>
                                </span>
                            </div>
                            <!--//icon-holder-->
                        </div>
                        <!--//col-->
                        <div class="col-auto">
                            <h4 class="app-card-title">100,000</h4>
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                </div>

            </div>
        </a>
    </div>

    <div class="col-12 col-lg-3">
        <a href="<?php echo base_url('messages/new'); ?>">
            <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm home-cards">
                <span class="badge bg-danger"> Total Failed Messages Today</span>
                <div class="app-card-header p-3 border-bottom-0">
                    <div class="row align-items-center gx-3">
                        <div class="col-auto">
                            <div class="app-icon-holder">
                                <span class="icon-holder">
                                    <i class="fas fa-box-tissue danger"></i>
                                </span>
                            </div>
                            <!--//icon-holder-->
                        </div>
                        <!--//col-->
                        <div class="col-auto">
                            <h4 class="app-card-title">0</h4>
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                </div>

            </div>
        </a>
    </div>

    <div class="col-12 col-lg-3">
        <a href="<?php echo base_url('messages/new'); ?>">
            <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm home-cards">
                <span class="badge bg-warning"> SACCOS With Depleted Bundles</span>
                <div class="app-card-header p-3 border-bottom-0">
                    <div class="row align-items-center gx-3">
                        <div class="col-auto">
                            <div class="app-icon-holder">
                                <span class="icon-holder">
                                    <i class="fas fa-braille success"></i>
                                </span>
                            </div>
                            <!--//icon-holder-->
                        </div>
                        <!--//col-->
                        <div class="col-auto">
                            <h4 class="app-card-title">0</h4>
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                </div>

            </div>
        </a>
    </div>
</div>
<!-- EOF New cards for the dashboard -->

<!--  -->

<div class="row g-4">

    <div class="col-lg-3 ">
        <div class="app-card app-card-doc shadow-sm h-100">
            <div class="app-card-thumb-holder p-3">
                <span class="icon-holder">
                    <i class="fas fa-comments warning"></i>
                </span>
                <a class="app-card-link-mask" href="<?php echo base_url('messages'); ?>"></a>
            </div>
            <div class="text-center fs-5 fw-bold"> OUTBOX MESSAGES</div>
        </div>
    </div>
    <div class="col-lg-1 "></div>
    <div class="col-lg-4 ">
        <div class="app-card app-card-doc shadow-sm h-100">
            <div class="app-card-thumb-holder p-3">
                <span class="icon-holder">
                    <i class="fas fa-exchange purple"></i>
                </span>
                <a class="app-card-link-mask" href="<?php echo base_url('home/transactions'); ?>"></a>
            </div>
            <div class="text-center fs-5 fw-bold">INCOMES REPORT</div>

        </div>
    </div>
    <div class="col-lg-1 "></div>
    <div class="col-lg-3 ">
        <div class="app-card app-card-doc shadow-sm h-100">
            <div class="app-card-thumb-holder p-3">
                <span class="icon-holder">
                    <i class="fas fa-address-book primary"></i>
                </span>
                <a class="app-card-link-mask" href="<?php echo base_url('users'); ?>"></a>
            </div>
            <div class="text-center fs-5 fw-bold">ONBOARD NEW SACCOS</div>
        </div>
    </div>

</div>


<script>
    var viewModel = {};
    $(document).ready(function() {
        var ViewModel = function() {
            var self = this;
            self.balance = ko.observable(0);
            self.sms_cost = ko.observable(0);
        };
        viewModel = new ViewModel();
        ko.applyBindings(viewModel);

    });
</script>