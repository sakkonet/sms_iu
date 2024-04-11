<nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
    <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">All Messages</a>
</nav>
<div class="app-card app-card-orders-table shadow-sm mb-5 p-4">
    <div class="app-card-body">
        <div class="table-responsive">
            <table class="table app-table-hover mb-0 text-left" id="tblMessages">
                <thead>
                    <tr>
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
            
            self.totalconnected = ko.observable();
            self.totalsenttoday = ko.observable();
            self.totalfailedtoday = ko.observable();
            self.depletedbundles  = ko.observable();
        };

        viewModel = new ViewModel();
        ko.applyBindings(viewModel);

        dTable['tblMessages'] = $('#tblMessages').DataTable({
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
            buttons: getBtnConfig('<?php echo "Messages"; ?>'),
            ajax: {
                url: '<?php echo api_url . "/message/user"; ?>',
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
                    "data": "text"
                },
                {
                    "data": "recipients"
                },

                {
                    "data": 'cost',
                    render: function(data, type, full, meta) {
                        var ret_txt = 'UGX ' + data;
                        return ret_txt;
                    }
                },
                {
                    "data": 'status',
                    render: function(data, type, full, meta) {
                        var ret_txt = "";
                        if (data == 'Success') {
                            ret_txt += '<span class="badge bg-success">' + data + '</span>';
                        } else if (data === 'Pending') {
                            ret_txt += '<span class="badge bg-warning">' + data + '</span>';
                        } else {
                            ret_txt += '<span class="badge bg-danger">' + data + '</span>';
                        }
                        return ret_txt;
                    }
                }
            ]
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