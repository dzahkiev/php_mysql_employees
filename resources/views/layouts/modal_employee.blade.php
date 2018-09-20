<div class="modal fade" id="employeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formEmployee">
          <div class="form-group">
            <label for="first_name" class="col-form-label">First name:</label>
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name">
          </div>
          <div class="form-group">
            <label for="last_name" class="col-form-label">Last name:</label>
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name">
          </div>
          <div class="form-group">
            <label for="middle_name" class="col-form-label">Middle name:</label>
            <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle name">
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
            <input type="text" class="form-control" id="salary" name="salary" placeholder="0">
          </div>
          <div class="form-group">
            <label for="departments" class="col-form-label">Departments:</label>
            <select class="form-control" name="departments[]" id="departments" multiple>
              @foreach($departments as $department)
                <option value="{{$department->id}}">{{$department->name}}</option>
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
    $('#employeeModal .modal-title').text('Add employee');
    $('#employeeModal').modal('show');
  });

  $('.editEmployee').click(function () {
    var tr = $(this).closest('tr');

    $('#formEmployee').find('input, select').each(function (i, el) {
      var name = $(el).attr('id');
      var text = '' + tr.children('[data-' + name + ']:first').data(name);
      if ($(el).is('select')) {
        text.split(',').forEach(function (str) {
          $(el).find('option[value="'+ str +'"]').attr('selected', 'selected');
        });
      } else {
        $(el).val(text);
      }
    });

    $('#formEmployee').attr('action', '/employee/' + tr.data('employee-id') + '/edit');
    $('#employeeModal .modal-title').text('Edit employee');
    $('#employeeModal').modal('show');
  });

  $('.removeEmployee').click(function () {
    var id = $(this).closest('tr').data('employee-id');
    if (id) {
      $.post(
        '/employee/' + id + '/remove',
        {"_token" : $('meta[name="csrf-token"]').attr('content')},
        window.location.reload()
      );
    }
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
        window.location.reload();
      },
      error: function (data) {
        console.log(data);
        if (data.responseJSON && data.responseJSON.errors) {
          var errors = data.responseJSON.errors;
          for (var key in errors) {
            $('#' + key).addClass('is-invalid');
            $('#' + key).after('<div class="invalid-feedback">' + errors[key] + '</div>');
          }
        }
      },
    });
  });

  $('#employeeModal').on('hidden.bs.modal', function (e) {
    $('form').find('input').val('').removeClass('is-invalid');
    $('form').find('select').removeClass('is-invalid');
    $('form select option:selected').attr('selected', false);
    $('form .invalid-feedback').remove();
  });
</script>
