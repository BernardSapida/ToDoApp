@extends("main.main")

@section("content")
    @if($message = Session::get('success'))
        <div class="mt-4 p-3 alert alert-success message">
            {{ $message }}
        </div>
    @endif
    <div class="container mx-auto mt-3 overflow-auto flex">
        <label for="add-todo" class="btn btn-primary modal-button" data-bs-toggle="modal" data-bs-target="#addTodoModal">Add Todo &nbsp; <i class="fa-sharp fa-solid fa-plus"></i></label>
        <input type="text" class="form-control" id="search" placeholder="Search"/>
    </div>
    <div class="container mx-auto mt-4 overflow-auto" id="table">
        <table class="table table-hover">
            <!-- head -->
            <thead>
            <tr class="hover">
                <th>ID</th>
                <th>TODO</th>
                <th>STATUS</th>
                <th>ACTIONS</th>
            </tr>
            </thead>
            <tbody>
                <tr class="hover notFound">
                    <td class="text-center" colspan="4">Not found</td>
                </tr>
                <tr class="hover emptyList">
                    <td class="text-center" colspan="4">Nothing to do</td>
                </tr>
                @foreach ($list as $todo)
                    <tr class="hover" data="{{ $todo->id }}" title="{{ $todo->title }}">
                        <th>{{ $todo->id }}</th>
                        <td>{{ $todo->title }}</td>
                        <td>{{ $todo->status }}</td>
                        <td>
                            <button type="button" onclick="{{ session(['id' => $todo->id]) }}" class="btn btn-dark btn-edit" data-bs-toggle="modal" data-bs-target="#editTodoModal"><i class="fa-regular fa-pen-to-square"></i>&nbsp; Edit</button>
                            <form action="{{ route("todo.destroy", $todo->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger btn-delete"><i class="fa-solid fa-trash"></i>&nbsp; Delete</button>
                            </form>
                            <form class="d-inline" action="todo/{{ $todo->id }}/status" method="POST">
                                @csrf
                                @method("PUT")
                                @if(strcmp($todo->status, 'Completed') == 0)
                                    <button type="submit" class="btn btn-warning btn-updateStatus">Not started</button>
                                @else
                                    <button type="submit" class="btn btn-success btn-updateStatus">Set as Completed</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="addTodoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addTodoModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="font-bold text-lg">Add to do</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="needs-validation" id="formAdd" method="POST" action="{{ route("todo.store") }}" novalidate>
                    @csrf
                    <div class="modal-body">
                        <div>
                            <label for="addTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="addTitle" placeholder="Title" aria-label="Title" required>
                            <div class="invalid-feedback">Please provide to do title.</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-closeAdd" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-add">Add to list</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editTodoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editTodoModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="font-bold text-lg">Edit to do</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="needs-validation" id="formEdit" method="POST" action="todo/{{ session()->get('id') }}/update" novalidate>
                    @csrf
                    @method("PUT")
                    <div class="modal-body">
                        <div>
                            <label for="id" class="form-label">ID</label>
                            <input type="text" class="form-control" name="id" id="id" placeholder="ID" aria-describedby="ID" required>
                            <div class="invalid-feedback">Please provide current ID.</div>
                        </div>
                        <div class="mt-3">
                            <label for="id" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="edit_title" placeholder="Title" aria-describedby="Title" required>
                            <div class="invalid-feedback">Please provide new to do title.</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-closeEdit" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-save">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection