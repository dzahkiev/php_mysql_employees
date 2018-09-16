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
        <form id="departmentAdd">
          <div class="form-group">
            <label for="name" class="col-form-label">Department Name:</label>
            <input type="text" class="form-control" id="name">
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
    $('#departmentModal').modal('show');
  });

  $('#btnSave').click(function () {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: '/department/add',
      type: "POST",
      data: {name : $('#name').val()},
      dataType: "JSON",
      beforeSend: function (data) {
        $('form input').removeClass('is-invalid');
        $("form .invalid-feedback").remove();
      },
      success: function () {
        $('#departmentModal').modal('show');
        window.location.reload();
      },
      error: function (data) {
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

</script>