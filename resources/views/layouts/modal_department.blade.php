<div class="modal fade" id="departmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add department</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formDepartment">
          <div class="form-group">
            <label for="name" class="col-form-label">Department Name:</label>
            <input type="text" class="form-control" name="name">
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
  $('#addDepartment').click(function () {
    $('#formDepartment').attr('action', '/department/add');
    $('#departmentModal').modal('show');
  });

  $('.editDepartment').click(function () {
    var tr = $(this).closest('tr');
    $('#formDepartment').attr('action', '/department/' + tr.data('department-id') + '/edit');
    $('input[name="name"]').val(tr.children('[data-name]:first').data('name'));
    $('#departmentModal').modal('show');
  });

  $('.removeDepartment').click(function () {
    var id = $(this).closest('tr').data('department-id');
    if (id) {
      $.post(
        '/department/' + id + '/remove',
        {"_token":$('meta[name="csrf-token"]').attr('content')},
        window.location.reload()
      );
    }
  });

  $('#btnSave').click(function () {
    console.log($('#formDepartment').attr('action'));
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: $('#formDepartment').attr('action'),
      type: "POST",
      data: {name : $('input[name="name"]').val()},
      dataType: "JSON",
      beforeSend: function (data) {
        $('form input').removeClass('is-invalid');
        $("form .invalid-feedback").remove();
      },
      success: function () {
        $('#departmentModal').modal('hide');
        window.location.reload();
      },
      error: function (data) {
        console.log(data);
        if (data.responseJSON && data.responseJSON.errors) {
          var errors = data.responseJSON.errors;
          for (var key in errors) {
            $('input[name="' + key + '"]').addClass('is-invalid');
            $('input[name="' + key + '"]').after('<div class="invalid-feedback">' + errors[key] + '</div>');
          }
        }
      },
    });
  });

  $('#departmentModal').on('hidden.bs.modal', function (e) {
    $('#formDepartment input').val('');
    $('#formDepartment input').removeClass('is-invalid');
    $('#formDepartment .invalid-feedback').remove();
  });
</script>