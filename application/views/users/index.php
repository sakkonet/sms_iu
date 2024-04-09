<?php $this->load->view('users/add_modal'); ?>

<!-- .card-body -->
<div class="app-card app-card-chart h-100 shadow-sm">
  <div class="app-card-header p-3">
    <div class="row justify-content-between align-items-center">
      <div class="col-auto">
        <h4 class="app-card-title">Connected Entities/ SACCOS</h4>
      </div>
      <div class="col-auto">
        <div class="card-header-action ">
          <button class="btn btn-primary " type="button" data-bs-toggle="modal" data-bs-target="#add_user-modal">
            <span class="fas fa-plus me-1" data-fa-transform="shrink-3"></span>Add New Entity
          </button>
        </div>
        <!--//card-header-actions-->
      </div>
      <!--//col-->
      <!--//row-->
    </div>
    <!--//app-card-header-->
    <div class="app-card-body">
      <br>
      <div class="table-responsive">
        <table class="table-sm table-hover display compact nowrap table app-table-hover mb-0 text-left" id="tblUsers" width="100%">
          <thead>
            <tr>
              <th>Full Name</th>
              <th>Type</th>
              <th>Email</th>
              <th>Phone Number</th>
              <th>Charge/SMS</th>
              <th>A/C Balance</th>
              <th>Status</th>
              <th>Action</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>


</div>
<script>
  var dTable = {};
  var viewModel = {};
  var TableManageButtons = {};
  var displayed_tab = '';
  $(document).ready(function() {
    getUserDetails();
    $('form#formUsers').validate({
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

      self.userType = ko.observableArray();
      self.selected_type = ko.observable();
      self.balance = ko.observable(0);
      self.sms_cost = ko.observable(0);
    };

    viewModel = new ViewModel();
    ko.applyBindings(viewModel);

    dTable['tblUsers'] = $('#tblUsers').DataTable({
      "lengthMenu": [
        [50, 100, 250, 500, -1],
        [50, 100, 250, 500, "All"]
      ],
      "language": {
        processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
      },
      "deferRender": true,
      responsive: true,
      dom: "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
      buttons: getBtnConfig('<?php echo "USERS"; ?>'),
      ajax: {
        url: "<?php echo api_url . "/users"; ?>",
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
          "data": 'user_type_id',
          render: function(data, type, full, meta) {
            if (parseInt(data) == 1) {
              var ret_txt = '<a href="#">' + full.firstname + ' ' + full.lastname + ' ' + '' + '</a>';
            } else {
              var ret_txt = '<a href="#">' + full.organisation + '' + '</a>';
            }
            return ret_txt;
          }
        },
        {
          "data": "type"
        },
        {
          "data": "email"
        },
        {
          "data": "mobile_number"
        },
        {
          "data": "sms_rate"
        },
        {
          "data": 'balance',
          render: function(data, type, full, meta) {
            var ret_txt = '<b>' + curr_format(data) + '</b>';
            return ret_txt;
          }
        },
        {
          "data": 'status_id',
          render: function(data, type, full, meta) {
            var ret_txt = "";
            if (parseInt(data) === 1) {
              ret_txt += '<span class="badge bg-success">Active</span>';
            } else if (parseInt(data) === 2) {
              ret_txt += '<span class="badge bg-warning">Inactive</span>';
            } else {
              ret_txt += '<span class="badge bg-danger">Inactive</span>';
            }
            return ret_txt;
          }
        },
        {
          data: 'id',
          render: function(data, type, full, meta) {
            var ret_txt = "<div class='btn-group'><a href='#add_user-modal' data-bs-toggle='modal' class='btn btn-xs btn-warning edit_me' title='Update user details'><i class='fa fa-edit'></i></a></div>";
            return ret_txt;
          }
        },
        {
          data: 'id',
          render: function(data, type, full, meta) {
            var ret_txt = '<a href="<?php echo site_url("users/settings"); ?>/' + data + '"><i class="fa fa-cogs"></i> Settings</a>';
            return ret_txt;
          }
        },
      ]
    });
  });

  function getUserDetails() {
    $.ajax({
      url: '<?php echo api_url . "/user/UserType"; ?>',
      headers: {
        Authorization: 'Bearer ' + '<?php echo $this->session->userdata('auth_token'); ?>'
      },
      type: 'POST',
      dataType: 'json',
      success: function(feedback) {
        if (feedback.success) {
          viewModel.userType(feedback.data);
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {

      }
    });
  }

  function reload_data(formId, reponse_data) {
    switch (formId) {
      case "formUsers":
        dTable['tblUsers'].ajax.reload(null, false);
        break;
      default:
        break;
    }
  }
</script>