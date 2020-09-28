<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- ajax csrf token  --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- Toastr  --}}
    <link rel="stylesheet" href="https://izitoast.marcelodolza.com/css/iziToast.min.css">
    
    <title>Teacher Ajax Crud</title>

 
  </head>
  <body>
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">

            <div class="col-8">
                <div class="card">
                    <div class="card">
                        <div class="card-header bg-dark text-light">
                            All Student
                            <button onclick="add_modal_show()" class="btn btn-primary float-right" type="button"><i class="fa fa-plus fa-3"></i></button>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead class="thead-dark">
                                  <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Roll</th>                                
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody id="add_tbody">
                                  @foreach ($student as $item)                                                   
                                  <tr data-id="{{$item->id}}">
                                    <td class="table_id">{{$item->id}}</td>
                                    <td class="table_name">{{$item->name}}</td>
                                    <td class="table_roll">{{$item->roll}}</td>
                                    <td>
                                      <button data-toggle="modal" data-target="#editModal" id="edit_Modal_show" class='btn btn-warning'>Edit</button>
                                      <button data-toggle="modal" data-target="#deleteModal" onclick="delete_student({{$item->id}})" class='btn btn-danger'>Delete</button>
                                    </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                              {{$student->links()}}
                              
                        </div>
                    </div>
                </div>
            </div>

          </div>
          
            <!-- Add Modal Start-->
              <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal3Label" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header bg-dark text-light">
                      <h5 class="modal-title" id="exampleModal3Label">Add Student</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form id="addForm">
                    <div class="modal-body">

                          <div class="form-group">
                            <label>Name</label>
                            <input id="name" type="text" class="form-control" placeholder="Enter Name">
                            <span id="nameError" class="text-danger"></span>
                          </div>
                          <div class="form-group">
                            <label>Roll</label>
                            <input min="0" id="roll" type="number" class="form-control" placeholder="Enter Roll">                          
                            <span id="rollError" class="text-danger"></span> 
                          </div>
                          
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                      </form>
                  </div>
                </div>
              </div>
            <!-- Add Modal End-->

            <!-- Edit Modal Start-->
              <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal3Label" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header bg-dark text-light">
                      <h5 class="modal-title" id="exampleModal3Label">Edit Student</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form id="updateForm">
                    <div class="modal-body">
                          <input hidden id="edit_id" type="text">
                          <div class="form-group">
                            <label>Name</label>
                            <input id="edit_name" type="text" class="form-control" placeholder="Enter Name">
                            <span id="nameError_edit" class="text-danger"></span>
                          </div>
                          <div class="form-group">
                            <label>Roll</label>
                            <input min="0" id="edit_roll" type="number" class="form-control" placeholder="Enter Roll">                          
                            <span id="rollError_edit" class="text-danger"></span> 
                          </div>
                          
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Update changes</button>
                    </div>
                      </form>
                  </div>
                </div>
              </div>
            <!-- Edit Modal End-->

            <!-- Delete Modal Start-->
              <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal3Label" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header bg-danger text-light">
                      <h5 class="modal-title" id="exampleModal3Label">Delete Student</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form id="deleteForm">
                        <input hidden id="delete_id">
                        <div class="modal-body text-center">
                            <h4>Are you sure to delete ?</h4>
                        </div>
                        <div class="modal-footer bg-dark">
                          <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> No,cancel</button>
                          <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Yes,delete</button>
                        </div>
                      </form>
                  </div>
                </div>
              </div>
            <!-- Delete Modal End-->
        </div>
            
         
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" ></script>
    {{-- toastr  --}}
    <script src="https://izitoast.marcelodolza.com/js/iziToast.min.js" ></script>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" ></script>
    <script>

      // ---------------------- toast Start ---------------------------

        iziToast.settings({
            timeout: 3000,
            transitionIn: 'fadeInDown',
            transitionOut: 'fadeOutUp',
            position: 'topRight',
        });

      // ---------------------- toast End ---------------------------

      // Add Modal Show Start
       function add_modal_show() {
          $('#addModal').modal('show');
        }
      // Add Modal Show End

      // Ajax Setup Start 
        $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
      // Ajax Setup End 

       // Adding Data Start 
        $('#addForm').submit(function(e){        
            e.preventDefault(); 

              var name = $('#name').val();
              var roll = $('#roll').val();
              $('#nameError').text('');
              $('#rollError').text('');
             
              $.ajax({
                  type: "POST",
                  dataType: "json",
                  data:{name:name, roll:roll},
                  url: "/student/add",
                  success: function(response){ 

                    $('#addForm').each(function(){
                      this.reset();
                    });

                    $('#addModal').modal('hide');
                
                    $('#add_tbody').prepend(`
                        <tr data-id="`+response.id+`">
                          <td>`+response.id+`</td>
                          <td>`+response.name+`</td>
                          <td>`+response.roll+`</td>
                          <td>
                            <button data-toggle="modal" data-target="#editModal" id="edit_Modal_show" class='btn btn-warning'>Edit</button>
                            <button data-toggle="modal" data-target="#deleteModal" onclick="delete_student(`+response.id+`)" class='btn btn-danger'>Delete</button>
                          </td>
                        </tr>
                      `)
                    iziToast.success({
                        title: 'Done',
                        message: "Student Added Successfully",
                    });

                   
                  },
                  error: function(error){                
                    $('#nameError').text(error.responseJSON.errors.name);
                    $('#rollError').text(error.responseJSON.errors.roll);
                     iziToast.error({
                        title: 'Sorry',
                        message: "Something went wrong",
                    });
                  },
                 
              })

          });

      // Adding Data End 

      // Editing Start 
          $(document).on('click','#edit_Modal_show',function(){        
            let id = $(this).closest('tr').data('id');
            let modal = $('#editModal');
             $.ajax({
                  type: "GET",
                  dataType: "json",                
                  url: "/student/edit/"+id,
                  success: function(response){ 
                    $(modal).find('#edit_id').val(response.id);
                    $(modal).find('#edit_name').val(response.name);
                    $(modal).find('#edit_roll').val(response.roll);                                                
                  },
                  error: function(error){
                    console.log(error)                  
                  },
                 
              })
           
          });
      // Editing End 

      // Fetch Data from DB Start  

        // function allData(){
        //   $.ajax({
        //     type: "GET",
        //     dataType: "json",
        //     url: "/student/all",
        //     success: function(response){
        //       var data = ""
        //       $.each(response,function(key,value){
        //         data = data + "<tr>"
        //         data = data + "<td>"+value.id+"</td>"
        //         data = data + "<td>"+value.name+"</td>"
        //         data = data + "<td>"+value.title+"</td>"
        //         data = data + "<td>"+value.institute+"</td>"
        //         data = data + "<td>"
        //         data = data + "<button class='btn btn-warning'>Edit</button> "
        //         data = data + "<button class='btn btn-danger'>Delete</button>"
        //         data = data + "</td>"
        //         data = data + "</tr>"
        //       })
        //       $('tbody').html(data);
        //     },
        //   })
        // }

        // allData();

      // Fetch Data from DB End 

      // Updating Data Start 

          $('#updateForm').submit(function(e){        
              e.preventDefault(); 

                var id = $('#edit_id').val();            
                var name = $('#edit_name').val();
                var roll = $('#edit_roll').val();           
                $('#nameError_edit').text('');
                $('#rollError_edit').text('');
              
                $.ajax({
                    type: "PUT",
                    dataType: "json",
                    data:{id:id,name:name, roll:roll},
                    url: "/student/update",
                    success: function(response){ 

                      $('#editModal').modal('hide');
                      let studentRow = $('#add_tbody').find('tr[data-id="'+id+'"]');
                      $(studentRow).find('td.table_id').text(response.id);
                      $(studentRow).find('td.table_name').text(response.name);
                      $(studentRow).find('td.table_roll').text(response.roll);
                     
                      iziToast.success({
                          title: 'Done',
                          message: "Student Updated Successfully",
                      });
                      
                      $('#nameError_edit').text('');
                      $('#rollError_edit').text('');
                  
                    },
                    error: function(error){                 
                      $('#nameError_edit').text(error.responseJSON.errors.name);
                      $('#rollError_edit').text(error.responseJSON.errors.roll);
                      iziToast.error({
                          title: 'Sorry',
                          message: "Something went wrong",
                      });
                    },
                  
                })

            });

      // Updating Data End 

      // Deleting Popup Start 
        function delete_student(id){
          $('#delete_id').val(id);
        }
      // Deleting Popup End 

      // Deleting Data Start 
        $('#deleteForm').submit(function(e){        
              e.preventDefault();             
              var id = $('#delete_id').val();
                                                      
                $.ajax({
                    type: "DELETE",
                    dataType: "json",
                    url: "/student/destroy/"+id,
                    success: function(response){ 
                      $('#deleteModal').modal('hide');
                      let studentRow = $('#add_tbody').find('tr[data-id="'+id+'"]');
                      $(studentRow).remove();
                      $('#deleteForm').each(function(){
                          this.reset();
                      }); 
                      iziToast.success({
                          title: 'Done',
                          message: "Student Updated Successfully",
                      });
                                        
                    },
                    error: function(error){                                      
                      iziToast.error({
                          title: 'Sorry',
                          message: "Something went wrong",
                      });
                    },
                  
                })

            });

      // Deleting Data End 











      // Deleting Popup Start 
          // $(document).on('click','#delete_Modal_show',function(){        
          //   let id = $(this).closest('tr').data('id');     
          //   let modal = $('#deleteForm');
          //   $(modal).attr('data-id',id);           
          // });
        // Deleting Popup End 

        // Deleting Data Start 

          // $('#deleteForm').submit(function(e){        
          //     e.preventDefault(); 

          //     let id = $('#deleteForm').data('id');   
          //     console.log(id)         
                                       
          //       $.ajax({
          //           type: "DELETE",
          //           dataType: "json",
          //           url: "/student/destroy/"+id,
          //           success: function(response){ 
          //             console.log(response);
          //             $('#deleteModal').modal('hide');
          //             let studentRow = $('#add_tbody').find('tr[data-id="'+id+'"]');
          //             $(studentRow).remove();
          //             $('#deleteForm').each(function(){
          //                 this.reset();
          //             }); 
          //             iziToast.success({
          //                 title: 'Done',
          //                 message: "Student Updated Successfully",
          //             });
                                        
          //           },
          //           error: function(error){                                      
          //             iziToast.error({
          //                 title: 'Sorry',
          //                 message: "Something went wrong",
          //             });
          //           },
                  
          //       })

          //   });

      // Deleting Data End 

    </script>

  </body>
</html>