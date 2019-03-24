@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-book">Add Book</a> 
            <a href="https://www.tutsmake.com/jquery-submit-form-ajax-php-laravel-5-7-without-page-load/" class="btn btn-secondary mb-2 float-right">Back to Post</a>
            <table class="table table-bordered" id="laravel_crud">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Book Number</th>
                        <th>Book Type</th>
                        <th>Book Name</th>
                        <th>Assign To Registrar</th>
                        <th>Assigned Date</th>
                        <th>Registrar Status</th>
                        <td colspan="2">Action</td>
                    </tr>
                </thead>
                <tbody id="books-crud">
                    @foreach($books as $record)
                    <tr id="book_id_{{ $record->id }}">
                        <td>{{ $record->id  }}</td>
                        <td>{{ $record->book_number }}</td>
                        <td>{{ $record->book_type }}</td>
                        <td>{{ $record->book_name }}</td>
                        <td>{{ $record->assign_to_registrar }}</td>
                        <td>{{ $record->assigned_date }}</td>
                        <td>{{ $record->registrar_status }}</td>
                        <td><a href="javascript:void(0)" id="edit-book" data-id="{{ $record->id }}" class="btn btn-info">Edit</a></td>
                        <td>
                        <a href="javascript:void(0)" id="delete-book" data-id="{{ $record->id }}" class="btn btn-danger delete-book">Delete</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $books->links() }}
        </div>
    </div>
</div>

<script>
  $(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    /*  When user click add user button */
    $('#create-new-book').click(function () {
        $('#btn-save').val("create-user");
        $('#userForm').trigger("reset");
        $('#userCrudModal').html("Add New User");
        $('#ajax-crud-modal').modal('show');
    });
 
   /* When click edit user */
    $('body').on('click', '#edit-user', function () {
      var user_id = $(this).data('id');
      $.get('ajax-crud/' + user_id +'/edit', function (data) {
         $('#userCrudModal').html("Edit User");
          $('#btn-save').val("edit-user");
          $('#ajax-crud-modal').modal('show');
          $('#user_id').val(data.id);
          $('#name').val(data.name);
          $('#email').val(data.email);
      })
   });
   //delete user login
    $('body').on('click', '.delete-user', function () {
        var user_id = $(this).data("id");
        confirm("Are You sure want to delete !");
 
        $.ajax({
            type: "DELETE",
            url: "{{ url('ajax-crud')}}"+'/'+user_id,
            success: function (data) {
                $("#user_id_" + user_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });   
  });
 
 if ($("#userForm").length > 0) {
      $("#userForm").validate({
 
     submitHandler: function(form) {
 
      var actionType = $('#btn-save').val();
      $('#btn-save').html('Sending..');
      
      $.ajax({
          data: $('#userForm').serialize(),
          url: "https://www.tutsmake.com/laravel-example/ajax-crud/store",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              var user = '<tr id="user_id_' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td>' + data.email + '</td>';
              user += '<td><a href="javascript:void(0)" id="edit-user" data-id="' + data.id + '" class="btn btn-info">Edit</a></td>';
              user += '<td><a href="javascript:void(0)" id="delete-user" data-id="' + data.id + '" class="btn btn-danger delete-user">Delete</a></td></tr>';
               
              
              if (actionType == "create-user") {
                  $('#users-crud').prepend(user);
              } else {
                  $("#user_id_" + data.id).replaceWith(user);
              }
 
              $('#userForm').trigger("reset");
              $('#ajax-crud-modal').modal('hide');
              $('#btn-save').html('Save Changes');
              
          },
          error: function (data) {
              console.log('Error:', data);
              $('#btn-save').html('Save Changes');
          }
      });
    }
  })
}
</script>
@endsection
