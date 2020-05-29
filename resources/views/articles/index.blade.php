@extends('layouts.app')

@section('content')

    <nav class="navbar navbar-expand-sm bg-light">

        <ul class="navbar-nav">
        <li class="nav-item">
            <button type='button' class="btn btn-primary openBtn" data-toggle="modal" data-target="#editModal" data-id='-1'>Create an Article</button>
        </li>
        </ul>

    </nav>
    <div>
        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td>{{$article->title}}</td>
                        <td>{{$article->body}}</td>

                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary openBtn" data-toggle="modal" data-target="#editModal" data-id="{{$article->id}}">
                                Edit
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary" data-id="{{$article->id}}" onclick="confirmDelete({{$article->id}})">Delete</button>
                            <!-- <form action='{{ route("delete.article", ["id"=> $article->id]) }}' method='POST'>
                                @csrf
                                @method('DELETE')

                                <button type='submit' class='btn btn-primary'>Delete</button>
                            </form> -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
            
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                            <input class="form-control" name='title' id='title'/>
                            <textarea class="input-group-text" name='body' id='body'></textarea> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveBtn">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <form action='{{ route("create.article") }}' method='POST'> 
        @csrf
        <label>Title: </label>
        <input type='text' name='title'/> 
        <label>Article: </label>
        <textarea name='body'></textarea> 
        <button type='submit'>Submit</button>
    </form>

@endsection


@section('script')

<script>

    const confirmDelete = (id) => {
        swal("Hello world!");
        console.log("indelete");

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                swal("Poof! Your imaginary file has been deleted!", {
                icon: "success",
                })
                .then(()=>{
                    $.ajax({
                        url: `http://127.0.0.1:8000/api/v1/articles/${id}`,
                        type: 'DELETE',
                        data: "",
                        success: function(data) {
                            console.log("delete");
                        }
                    }).then(()=>{
                        location.reload();
                    });
                });
            } else {
                swal("Your imaginary file is safe!");
            }
        });
    }

    $('#editModal').on('show.bs.modal', (e)=>{

        //getting id from button from modal popup event

        let button = e.relatedTarget;
        let id = button.dataset.id;
        let modal = $(e.currentTarget);

        if (id === '-1') {

            $('#saveBtn').on('click', (e)=>{

                let titleUpdate=modal.find('.modal-body #title').val();
                let bodyUpdate=modal.find('.modal-body #body').val();

                $.ajax({
                    url: `http://127.0.0.1:8000/api/v1/articles`,
                    type: 'POST',
                    data: `title=${titleUpdate}&body=${bodyUpdate}`,
                    success: function(data) {
                        console.log("loadsuccess");
                    }
                }).then(()=>{
                    $('#editModal').modal('toggle');
                    location.reload();
                });
            }); 
        } else {
            //finding input and text field, filling with ajax(id)
            
            $.get(`http://127.0.0.1:8000/api/v1/articles/${id}`, (data, status)=>{
                const article = data[0]
                modal.find('.modal-body #title').val(article.title);
                modal.find('.modal-body #body').val(article.body);
                
            });
            //taking new input and saving it with ajaxx call
        
            $('#saveBtn').on('click', (e)=>{

                let titleUpdate=modal.find('.modal-body #title').val();
                let bodyUpdate=modal.find('.modal-body #body').val();

                $.ajax({
                    url: `http://127.0.0.1:8000/api/v1/articles/${id}`,
                    type: 'PUT',
                    data: `title=${titleUpdate}&body=${bodyUpdate}`,
                    success: function(data) {
                        console.log("loadsuccess");
                    }
                }).then(()=>{
                    $('#editModal').modal('toggle');
                    location.reload();
                });
            }); 

        }
    });

</script>

@endsection




