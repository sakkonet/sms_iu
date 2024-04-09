<!-- <a href="<?php echo base_url('home/topUp'); ?>" class="btn btn-warning float-end"><i class="fa fa-wallet"></i>&nbsp; Top Up </a><br><br> -->
<nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
    <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">Income Report</a>
</nav>


<div class="app-card app-card-orders-table shadow-sm mb-5 p-4">
    <div class="app-card-body">
        <div class="table-responsive">
            <table class="table app-table-hover mb-0 text-left" id="tblTransactions">
                <thead>
                    <tr>
                        <th class="cell">Date</th>
                        <th class="cell">Type</th>
                        <th class="cell">Credit</th>
                        <th class="cell">Debit</th>
                        <th class="cell" width="300px">Narrative</th>
                    </tr>
                </thead>
                <tbody>

                    <!-- <tr>
                        <td class="cell">#15341</td>
                        <td class="cell"><span class="truncate">Morbi vulputate lacinia neque et sollicitudin</span></td>
                        <td class="cell">Raymond Atkins</td>
                        <td class="cell"><span class="cell-data">11 Oct</span><span class="note">11:18 AM</span></td>
                        <td class="cell"><span class="badge bg-success">Paid</span></td>
                        <td class="cell">$678.26</td>
                        <td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a></td>
                    </tr> -->

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
        };

        viewModel = new ViewModel();
        ko.applyBindings(viewModel);

        dTable['tblTransactions'] = $('#tblTransactions').DataTable({
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            "deferRender": true,
            responsive: true,
            order: [
                [0, 'desc']
            ],
            dom: "<'row'<'col-sm-12 col-md-4'><'col-sm-12 col-md-4'b><'col-sm-12 col-md-4'>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-2'><'col-sm-12 col-md-6'p><'col-sm-12 col-md-4'>>",
            buttons: getBtnConfig('<?php echo "Transactions"; ?>'),
            ajax: {
                url: '<?php echo api_url . "/transaction/user"; ?>',
                dataType: 'JSON',
                type: 'POST',
                headers: {
                    Authorization: 'Bearer ' + '<?php echo $this->session->userdata('auth_token'); ?>'
                },
                data: function(d) {
                    //d.created_by = 1;
                }
            },
            columns: [{
                    "data": "date_created"
                },
                {
                    "data": "type"
                },
                {
                    "data": 'CREDIT',
                    render: function(data, type, full, meta) {
                        return curr_format(round(data, 0));
                    }
                },

                {
                    "data": 'DEBIT',
                    render: function(data, type, full, meta) {
                        return curr_format(round(data, 0));
                    }
                },
                {
                    "data": "narrative"
                }
            ]
        });
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