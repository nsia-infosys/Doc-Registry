@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <a href="javascript:void(0)" style="float: right;" class="btn btn-success mb-2" onclick="newRecord()" id="create-new-book"><span class="oi oi-plus"></span></a>
            <table class="table table-bordered" id="book_crud">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Book Number</th>
                        <th>Book Type</th>
                        <th>Book Name</th>
                        <th>Assign To Registrar</th>
                        <th>Assigned Date</th>
                        <th>Registrar Status</th>
                        <th width="250px;">Action</th>
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
                        <td>
                            <!-- <a href="/books/{{ $record->id }}/pages" id="view-book" title="Open Book" data-id="{{ $record->id }}" class="btn btn-light"><span class="oi oi-book"></span></a> -->
                            <a href="/main/{{ $record->id }}" id="view-book" title="Open Book" data-id="{{ $record->id }}" class="btn btn-light"><span class="oi oi-book"></span></a>
                            <a href="javascript:void(0)" id="assign-book" title="Assign Book" onclick="assignRecord({{ $record->id }}, '{{ $record->book_name }}')" data-id="{{ $record->id }}" class="btn btn-light"><span class="oi oi-share-boxed"></span></a>
                            <a href="javascript:void(0)" id="view-book" title="View Book" onclick="viewRecord({{ $record->id }})" data-id="{{ $record->id }}" class="btn btn-light text-info"><span class="oi oi-eye"></span></a>
                            <a href="javascript:void(0)" id="edit-book" title="Edit Book" onclick="editRecord({{ $record->id }})" data-id="{{ $record->id }}" class="btn btn-light text-primary"><span class="oi oi-pencil"></span></a>
                            <a href="javascript:void(0)" id="delete-book" title="Delete Book" onclick="deleteRecord({{ $record->id }})" data-id="{{ $record->id }}" class="btn btn-light delete-book text-danger"><span class="oi oi-trash"></span></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $books->links() }}
        </div>
    </div>
</div>

@include('book.partials.new')

@include('book.partials.assign')

<script>
    function refershPage() {
        location.reload();
    }

    function newRecord() {
        console.log("New Record");
        $('#create-book-modal').trigger("reset");
        $('#create-book-modal').modal('show');
        $("#create-book-modal").modal();
    }

    function viewRecord(recordId) {
        console.log("View: " + recordId);
        
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url : "{!! url('/books'); !!}/" + recordId,
            type: "GET"
        }).done(function (data) {
            $(data).modal();
            // $('#list-table').html(data);
            // location.hash = page;
        }).fail(function () {
            alert('Data could not be loaded.');
        });
    }

    function editRecord(recordId) {
        console.log("Edit: " + recordId);

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url : "{!! url('/books'); !!}/" + recordId + "/edit",
            type: "GET"
        }).done(function (data) {
            $(data).modal();
            // $('#list-table').html(data);
            // location.hash = page;
        }).fail(function () {
            alert('Data could not be loaded.');
        });
    }

    function deleteRecord(recordId) {
        console.log("Delete: " + recordId);

        if (confirm("Do you want to delete this record?")) {
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url : "{!! url('/books'); !!}/" + recordId,
                type: "DELETE"
            }).done(function (data) {
                console.log(data);
                refershPage();
            }).fail(function () {
                alert('Data could not be loaded.');
            });
        }
    }

    function assignRecord(id, book_name) {
        console.log("Assign Record");
        $('#assign-book-modal').trigger("reset");
        $('#id', '#assign-book-modal').val(id);
        $('#book_name', '#assign-book-modal').val(book_name);
        $('#assign-book-modal').modal('show');
        $("#assign-book-modal").modal();
    }

    function calculateTotalPages(el) {
        var modalEl = $(el).closest(".modal")
        var startPage = $("input[name='start_page_no']", modalEl).val();
        var endPage = $("input[name='end_page_no']", modalEl).val();

        if(startPage && endPage) {
            $("input[name='total_pages']", modalEl).val(endPage-startPage);
        }
    }

    $("#create-book-modal").on("submit", function(e) {
        var modalEl = $(e.currentTarget);
        if (!e.isDefaultPrevented()) {
            var formData = $("form", modalEl).serialize();

            $("button[type='submit']", modalEl).prop('disabled', true);
            $(".spinner-border", modalEl).show();
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: formData,
                url : "{!! url('/books'); !!}" ,
                type: "POST",
                dataType: 'json',
            }).done(function (data) {
                console.log(data);
                refershPage();
            }).fail(function () {
                $(".spinner-border", modalEl).hide();
                $("button[type='submit']", modalEl).prop('disabled', false);
                alert('Data could not be save.');
            });
        }
        return false;
    });

    $("#edit-book-modal").on("submit", function(e) {
        var modalEl = $(e.currentTarget);
        if (!e.isDefaultPrevented()) {
            var formData = $("form", modalEl).serialize();

            $("button[type='submit']", modalEl).prop('disabled', true);
            $(".spinner-border", modalEl).show();
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: formData,
                url : "{!! url('/books'); !!}" ,
                type: "POST",
                dataType: 'json',
            }).done(function (data) {
                console.log(data);
                refershPage();
            }).fail(function () {
                $(".spinner-border", modalEl).hide();
                $("button[type='submit']", modalEl).prop('disabled', false);
                alert('Data could not be save.');
            });
        }
        return false;
    });






//     $(document).ready(function () {
//         $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//         });

//         /*  When user click add user button */
//         $('#create-new-book').click(function () {
//             $('#create-book-modal').trigger("reset");
//             $('#create-book-modal').modal('show');
//         });

//         /* When click edit user */
//         $('body').on('click', '#edit-user', function () {
//             var book_id = $(this).data('id');
//             $.get('books/' + book_id +'/edit', function (data) {
//                 $('#userCrudModal').html("Edit User");
//                 $('#btn-save').val("edit-user");
//                 $('#ajax-crud-modal').modal('show');
//                 $('#user_id').val(data.id);
//                 $('#name').val(data.name);
//                 $('#email').val(data.email);
//             });
//         });
        









        
 
   
//    //delete user login
//     $('body').on('click', '.delete-user', function () {
//         var user_id = $(this).data("id");
//         confirm("Are You sure want to delete !");
 
//         $.ajax({
//             type: "DELETE",
//             url: "{{ url('ajax-crud')}}"+'/'+user_id,
//             success: function (data) {
//                 $("#user_id_" + user_id).remove();
//             },
//             error: function (data) {
//                 console.log('Error:', data);
//             }
//         });
//     });   
//   });
 
//  if ($("#userForm").length > 0) {
//       $("#userForm").validate({
 
//      submitHandler: function(form) {
 
//       var actionType = $('#btn-save').val();
//       $('#btn-save').html('Sending..');
      
//       $.ajax({
//           data: $('#userForm').serialize(),
//           url: "https://www.tutsmake.com/laravel-example/ajax-crud/store",
//           type: "POST",
//           dataType: 'json',
//           success: function (data) {
//               var user = '<tr id="user_id_' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td>' + data.email + '</td>';
//               user += '<td><a href="javascript:void(0)" id="edit-user" data-id="' + data.id + '" class="btn btn-info">Edit</a></td>';
//               user += '<td><a href="javascript:void(0)" id="delete-user" data-id="' + data.id + '" class="btn btn-danger delete-user">Delete</a></td></tr>';
               
              
//               if (actionType == "create-user") {
//                   $('#users-crud').prepend(user);
//               } else {
//                   $("#user_id_" + data.id).replaceWith(user);
//               }
 
//               $('#userForm').trigger("reset");
//               $('#ajax-crud-modal').modal('hide');
//               $('#btn-save').html('Save Changes');
              
//           },
//           error: function (data) {
//               console.log('Error:', data);
//               $('#btn-save').html('Save Changes');
//           }
//       });
//     }
//   })
// }
</script>
@endsection
