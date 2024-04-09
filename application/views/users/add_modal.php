<div class="modal fade" id="add_user-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add/Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class=" needs-validation" class="formValidate" novalidate="" action="<?php echo api_url . '/user/update'; ?>" method="post" id="formUsers" name="formUsers">
                <div class="modal-body">
                    <div class="row g-3  p-4 pb-0">
                        <input type="hidden" name="id" id="id" />
                        <div class="col-md-6"><label class="form-label" for="validationCustom03">Account Type <span class="text-danger">*</span></label>
                            <select data-bind='options: $root.userType, optionsText: "type", optionsCaption: "-- Select Account Type --" ,optionsAfterRender: setOptionValue("id"),value:$root.selected_type, attr:{name:"user_type_id"}' class="form-select" id="selected_type" required>
                            </select>
                        </div>
                        <div class="col-md-6"><label class="form-label" for="validationCustom03">Status <span class="text-danger">*</span></label>
                            <select class="form-control" id="status_id" name="status_id" required>
                                <option value="">--Selected --</option>
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="row g-3  p-4 pb-0" id="name">
                        <div class="col-md-6" id="name"><label class="form-label" for="validationCustom01">First
                                name <span class="text-danger">*</span></label><input class="form-control" id="firstname" type="text" name="firstname" required />
                        </div>
                        <div class="col-md-6"><label class="form-label">Last name <span class="text-danger">*</span></label><input class="form-control" id="lastname" name="lastname" type="text" required />
                        </div>
                    </div>
                    <div class="row g-3  p-4 pb-0" id="organisation">
                        <div class="col-md-12">
                            <label class="form-label">Organisation Name <span class="text-danger">*</span></label><input class="form-control" name="organisation" type="text" required />
                        </div>
                    </div>
                    <div class="row g-3  p-4 pb-0" id="name">
                        <div class="col-md-6"><label class="form-label" for="validationCustom03">Email <span class="text-danger">*</span></label><input class="form-control" id="" type="email" name="email" id="email" required />
                        </div>
                        <div class="col-md-6"><label class="form-label" for="validationCustom03">Phone Number <span class="text-danger">*</span></label><input class="form-control" id="" type="text" name="mobile_number" id="mobile_number" required />
                        </div>
                    </div>
                    <div class="row g-3  p-4 pb-0">
                        <div class="col-md-12">
                            <label class="form-label"> Charge Per SMS <span class="text-danger">*</span></label><input class="form-control" name="sms_rate" type="number" required />
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="submit" class="btn btn-primary">Create User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#selected_type').on('change', function() {
        if (this.value == 1) {
            $("#name").show();
            $("#organisation").hide();
        } else if (this.value > 1) {
            $("#organisation").show();
            $("#name").hide();
        } else {
            $("#name").hide();
            $("#organisation").hide();
        }
    }).trigger("change");
</script>