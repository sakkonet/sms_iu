<!-- added a filter and print for the messages-->
<div class="" style="width: 100%; border: 1px solid #ccc; height: 110px; margin-bottom: 20px; border-radius:15px">
    <div>
        <table id="datata" style="margin-top: 10px;">
            <tr>
                <td>
                </td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td><label for="row_num">Rows:&nbsp;</label></td>
                <td>
                    <form><select class="form-control input-sm" id="row_num">
                            <option>10</option>
                            <option selected>20</option>
                            <option>30</option>
                            <option>40</option>
                            <option>50</option>
                            <option>60</option>
                            <option>70</option>
                            <option>80</option>
                            <option>95</option>
                            <option>100</option>
                            <option>200</option>
                            <option>300</option>
                            <option value="All">All</option>
                        </select></form>
                </td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td><label for="from_ag">Date from:&nbsp;</label></td>
                <td><input class="form-control input-sm customDatepicker" onkeydown="return false" autocomplete="off" id="from_date" type="text" placeholder="DD-MM-YYYY"></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td><label for="from_age">To:&nbsp;</label></td>
                <td><input class="form-control input-sm customDatepicker" onkeydown="return false" autocomplete="off" id="to_date" type="text" placeholder="DD-MM-YYYY"></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td><button class="btn btn-primary btn-block ml-5" id="btn_filter">Filter</button></td>
            </tr>
        </table>
        </table>
    </div>
</div>
<!-- upton here-->
<nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
    <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">All Messages</a>
</nav>
<div class="app-card app-card-orders-table shadow-sm mb-5 p-4">
    <div class="app-card-body">
        <div class="table-responsive">
            <table class="table app-table-hover mb-0 text-left" id="tblMessages">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="cell">Date</th>
                        <th class="cell" width="300px">Message</th>
                        <th class="cell">Recipients</th>
                        <th class="cell">Cost</th>
                        <th class="cell">Status</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <!--//table-responsive-->

    </div>
    <!--//app-card-body-->
</div>
<!--//tab-content-->


<script>
    var dTable = {};
    var viewModel = {};
    var TableManageButtons = {};
    var displayed_tab = '';
    $(document).ready(function() {

        $("#btn_filter").click((e) => {
            var from_date = $("#from_date").val().trim();
            var to_date = $("#to_date").val().trim();

            from_date = typeof(from_date) == 'string' && from_date.length > 0 ? from_date : false;
            to_date = typeof(to_date) == 'string' && to_date.length > 0 ? to_date : false;

            if (from_date && to_date) {
                alert("All good to go");
            } else {
                alert("Please Fill up all the date fields");
            }
        })

        $('form#formMessages').validate({
            submitHandler: saveData2
        });

        var ViewModel = function() {
            var self = this;
            self.initialize_edit = function() {
                edit_data(self.formatOptions(), "form");
            };

            self.display_table = function(data, click_event) {
                TableManageButtons.init($(click_event.currentTarget).prop("hash").toString().replace("#", ""));
            };
            self.balance = ko.observable(0);
            self.sms_cost = ko.observable(0);
            self.positions = ko.observableArray(<?php echo (isset($positions)) ? json_encode($positions) : ''; ?>);
            self.position = ko.observable();
            self.roles = ko.observableArray(<?php echo (isset($roles)) ? json_encode($roles) : ''; ?>);
            self.role = ko.observable();

            self.totalconnected = ko.observable(0);
            self.totalsenttoday = ko.observable(0);
            self.totalfailedtoday = ko.observable(0);
            self.depletedbundles = ko.observable(0);
        };

        viewModel = new ViewModel();
        ko.applyBindings(viewModel);

        $.ajax({
            url: '<?php echo api_url . "/message/user"; ?>',
            dataType: 'JSON',
            type: 'POST',
            headers: {
                Authorization: 'Bearer ' + '<?php echo $this->session->userdata('auth_token'); ?>'
            },
            data: {
                data_select: 'ALL',
                limit_data: 20
            },
            success: function(response) {
                console.log(response);
                // $("#loader1").hide();
                // $("#data_result").append(response);
                // $("#buttons").show();
            }
        });
    });

    function reload_data(formId, reponse_data) {
        switch (formId) {
            case "tblMessages":
                dTable['tblMessages'].ajax.reload(null, false);
                break;
            default:
                break;
        }
    }
</script>