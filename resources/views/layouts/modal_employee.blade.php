<div class="modal fade" id="employeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formEmployee">
          <div class="form-group">
            <label for="first_name" class="col-form-label">First name:</label>
            <input type="text" class="form-control" name="first_name" placeholder="First name">
          </div>
          <div class="form-group">
            <label for="last_name" class="col-form-label">Last name:</label>
            <input type="text" class="form-control" name="last_name" placeholder="Last name">
          </div>
          <div class="form-group">
            <label for="middle_name" class="col-form-label">Middle name:</label>
            <input type="text" class="form-control" name="middle_name" placeholder="Middle name">
          </div>
          <div class="form-group">
            <label for="gender" class="col-form-label">Gender:</label>
            <select class="form-control" id="gender" name="gender">
              <option></option>
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
          </div>
          <div class="form-group">
            <label for="salary" class="col-form-label">Salary:</label>
            <input type="text" class="form-control" name="salary" placeholder="0">
          </div>
          <div class="form-group">
            <label for="departments" class="col-form-label">Departments:</label>
            <select class="form-control" name="departments[]" id="departments" multiple>
              @foreach($departments as $department)
                <option value="{{$department->id}}">
                  {{$department->name}}
                </option>
              @endforeach
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button id="btnSave" type="button" class="btn btn-success">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

  $('#addEmployee').click(function () {
    $('#formEmployee').attr('action', '/employee/add');
    $('#employeeModal').modal('show');
  });

  $('#btnSave').click(function () {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: $('#formEmployee').attr('action'),
      type: "post",
      data: $('#formEmployee').serialize(),
      dataType: "json",
      beforeSend: function (data) {
        $('form').find('input, select').removeClass('is-invalid');
        $('form .invalid-feedback').remove();
      },
      success: function () {
        $('#employeeModal').modal('hide');
       // window.location.reload();
      },
      error: function (data) {
        console.log(data);
        if (data.responseJSON && data.responseJSON.errors) {
          var errors = data.responseJSON.errors;
          for (var key in errors) {
            console.log(key);
            $('[name="' + key + '"]').addClass('is-invalid');
            $('[name="' + key + '"]').after('<div class="invalid-feedback">' + errors[key] + '</div>');
          }
        }
      },
    });
  });
</script>
