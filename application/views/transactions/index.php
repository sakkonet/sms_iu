<!-- <a href="<?php echo base_url('home/topUp'); ?>" class="btn btn-warning float-end"><i class="fa fa-wallet"></i>&nbsp; Top Up </a><br><br> -->
<nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
    <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">Income Report</a>
    <div class="col-md-12 pt-2 pb-2">
        <table id="datata">
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
                <td><input class="form-control input-sm customDatepickerDefaultDate" onkeydown="return false" autocomplete="off" id="from_date" type="text" placeholder="DD-MM-YYYY"></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td><label for="from_age">To:&nbsp;</label></td>
                <td><input class="form-control input-sm customDatepickerDefaultDate" onkeydown="return false" autocomplete="off" id="to_date" type="text" placeholder="DD-MM-YYYY"></td>
                <td><button class="btn btn-primary btn-block pl-5" id="btn_filter">Filter</button></td>
            </tr>
        </table>
    </div>
</nav>


<div class="app-card app-card-orders-table shadow-sm mb-5 p-4">
    <div class="app-card-body">
        <div class="table-responsive">
            <table class="table app-table-hover mb-0 text-left" id="tblTransactions">
                <thead>
                    <tr>
                        <th class="cell">#</th>
                        <th class="cell">Date</th>
                        <th class="cell" width="300px">Narrative</th>
                        <th class="cell">SMS COST</th>
                        <th class="cell">UCCFS COMMISSION</th>
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
            url: '<?php echo api_url . "/transaction/allIncomes"; ?>',
            dataType: 'JSON',
            method: 'POST',
            headers: {
                Authorization: 'Bearer ' + '<?php echo $this->session->userdata('auth_token'); ?>'
            },
            data: {
                data_type: 'ALL_DATA'
            },
            success: function(response) {
                console.log((response));
            }
        });

        // $.ajax({
        //         url: '<?php echo api_url . "/transaction/user"; ?>',
        //         dataType: 'JSON',
        //         type: 'POST',
        //         headers: {
        //             Authorization: 'Bearer ' + '<?php echo $this->session->userdata('auth_token'); ?>'
        //         },

        //     });
        // dTable['tblTransactions'] = $('#tblTransactions').DataTable({
        //     "lengthMenu": [
        //         [10, 25, 50, 100, -1],
        //         [10, 25, 50, 100, "All"]
        //     ],
        //     "language": {
        //         processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
        //     },
        //     "deferRender": true,
        //     responsive: true,
        //     order: [
        //         [0, 'desc']
        //     ],
        //     dom: "<'row'<'col-sm-12 col-md-4'><'col-sm-12 col-md-4'b><'col-sm-12 col-md-4'>>" +
        //         "<'row'<'col-sm-12'tr>>" +
        //         "<'row'<'col-sm-12 col-md-2'><'col-sm-12 col-md-6'p><'col-sm-12 col-md-4'>>",
        //     buttons: getBtnConfig('<?php echo "Transactions"; ?>'),

        //     columns: [{
        //             "data": "date_created"
        //         },
        //         {
        //             "data": "type"
        //         },
        //         {
        //             "data": 'CREDIT',
        //             render: function(data, type, full, meta) {
        //                 return curr_format(round(data, 0));
        //             }
        //         },

        //         {
        //             "data": 'DEBIT',
        //             render: function(data, type, full, meta) {
        //                 return curr_format(round(data, 0));
        //             }
        //         },
        //         {
        //             "data": "narrative"
        //         }
        //     ]
        // });
    });

    function reload_data(formId, reponse_data) {
        switch (formId) {
            case "tblTransactions":
                dTable['tblTransactions'].ajax.reload(null, false);
                break;
            default:
                break;
        }
    }
</script>