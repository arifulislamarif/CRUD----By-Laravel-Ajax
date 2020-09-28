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
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card">
                        <div class="card-header bg-dark text-light">
                            All Teacher
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead class="thead-dark">
                                  <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Title</th>
                                    <th>Institute Name</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  
                                </tbody>
                              </table>
                              
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-4">
                <div class="card">
                    <div class="card">
                        <div class="card-header bg-dark text-light">
                            <span id="addT">Add Student</span>
                            <span id="updateT">Update Student</span>
                        </div>
                        <div class="card-body">
                            <form id="add_form">
                                <div class="form-group">
                                  <label>Name</label>
                                  <input id="name" type="text" class="form-control" placeholder="Enter Name">
                                </div>
                                <div class="form-group">
                                  <label>Title</label>
                                  <input id="title" type="text" class="form-control" placeholder="Enter Title">
                                </div>
                                <div class="form-group">
                                  <label>Institute Name</label>
                                  <input id="institute" type="text" class="form-control" placeholder="Institute Name">
                                </div>
                                <div class="form-group">

                                <button id="addButton" class="btn btn-primary" type="button"><i class="fa fa-plus"></i> Add</button>                                                             
                                <button id="loading" class="btn btn-primary" type="button"><i class="fa fa-spinner fa-spin"></i> Adding...</button>                                                             
                                <button id="updateButton" class="btn btn-primary" type="button"><i id="loading" class="fa fa-spinner fa-spin"></i> Update</button>

                                </div>
                                
                              </form>
                              
                        </div>
                         </div>
                </div>
            </div>
        </div>
    </div>




    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" ></script>
    {{-- toastr  --}}
    <script src="https://izitoast.marcelodolza.com/js/iziToast.min.js" ></script>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" ></script>

   

{{-- ajax code --}}

    <script>

      // ---------------------- toast Start ---------------------------

        iziToast.settings({
            timeout: 3000,
            transitionIn: 'fadeInDown',
            transitionOut: 'fadeOutUp',
            position: 'topRight',
        });

      // ---------------------- toast End ---------------------------
        
      // ---------------------- Hide/Show Start---------------------------
            $('#addT').show();
            $('#updateT').hide();
            $('#addButton').show();
            $('#updateButton').hide();
            $('#updateButton').hide();
            $('#loading').hide();
      // ---------------------- Hide/Show End---------------------------

      // Ajax Setup Start 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
      // Ajax Setup End 

    // Fetch Data from DB Start  

        function allData(){
          $.ajax({
            type: "GET",
            dataType: "json",
            url: "/teacher/all",
            success: function(response){
              var data = ""
              $.each(response,function(key,value){
                data = data + "<tr>"
                data = data + "<td>"+value.id+"</td>"
                data = data + "<td>"+value.name+"</td>"
                data = data + "<td>"+value.title+"</td>"
                data = data + "<td>"+value.institute+"</td>"
                data = data + "<td>"
                data = data + "<button class='btn btn-warning'>Edit</button> "
                data = data + "<button class='btn btn-danger'>Delete</button>"
                data = data + "</td>"
                data = data + "</tr>"
              })
              $('tbody').html(data);
            },
          })
        }

        allData();

    // Fetch Data from DB End  

    // Adding Data Start 

        $(document).on("click", "#addButton", function(e) {

            e.preventDefault(); 

              var name = $('#name').val();
              var title = $('#title').val();
              var institute = $('#institute').val();

              $.ajax({
                  type: "POST",
                  dataType: "json",
                  data:{name:name, title:title, institute:institute},
                  url: "/teacher/add",
                  beforeSend:function(){
                    // $('#loading').show();
                    // $('#addButton').html('Adding..');
                    $('#addButton').hide();
                    $('#loading').show();
                  },
                  success: function(response){
                    allData();
                    $('#add_form').each(function(){
                      this.reset();
                    });
                    iziToast.success({
                        title: 'Done',
                        message: response.success,
                    });
                  },
                  complete:function(){
                    //  $('#loading').hide();
                    //  $('#addButton').html('Add');
                    $('#loading').hide();
                    $('#addButton').show();
                  },
              })

          });

    // Adding Data End  

    </script>



  </body>
</html>