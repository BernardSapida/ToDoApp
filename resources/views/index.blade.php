@extends("main.main")

@section("content") 
    <div class="container mx-auto my-5 overflow-auto flex">
        <label for="add-todo" class="btn btn-primary modal-button">Add Todo &nbsp; <i class="fa-sharp fa-solid fa-plus"></i></label>
        <input type="text" placeholder="Search" class="input input-bordered" id="search"/>
    </div>
    <div class="container mx-auto my-5 overflow-auto" id="table">
        <table class="table w-full table-normal">
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
                @if(count($list) == 0)
                    <tr class="hover">
                        <td class="text-center" colspan="4">Nothing to do</td>
                    </tr>
                @else
                    @foreach ($list as $todo)
                        <tr class="hover" data="{{ $todo->id }}">
                            <th>{{ $todo->id }}</th>
                            <td>{{ $todo->to_do }}</td>
                            <td>{{ $todo->status }}</td>
                            <td>
                                <label for="edit-todo" class="btn btn-edit">Edit &nbsp; <i class="fa-regular fa-pen-to-square"></i></label>
                                <button class="btn btn-secondary btn-delete">Delete &nbsp; <i class="fa-solid fa-trash"></i></button>
                                @if(strcmp($todo->status, 'Completed') == 0)
                                    <button class="btn btn-primary btn-updateStatus">Not started</button>
                                @else
                                    <button class="btn btn-accent btn-updateStatus">Set as Completed</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <input type="checkbox" id="add-todo" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box p-7">
            <h3 class="font-bold text-lg">Add to do</h3>
            <hr>
            {{-- <div class="btn-error p-4">
                <p class="text-white">Title is required!</p>
            </div> --}}
            <form action="/add" method="POST">
                @csrf
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text">Title</span>
                    </label>
                    <input type="text" name="title" placeholder="Title" class="input input-bordered w-full" />
                </div>
                <div class="text-right">
                    <label for="add-todo" class="btn mt-5">Close</label>
                    <button type="submit" class="btn btn-info btn-add mt-5">Add to list</button>
                </div>
            </form>
        </div>
    </div>
    <input type="checkbox" id="edit-todo" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box p-7">
            <h3 class="font-bold text-lg">Edit to do</h3>
            <hr>
            {{-- <div class="btn-error p-4">
                <p class="text-white">Title is required!</p>
            </div> --}}
            <form action="/edit" method="POST">
                @csrf
                <div class="form-control w-full" id="container-id">
                    <label class="label">
                        <span class="label-text">ID</span>
                    </label>
                    <input type="text" name="id" id="id" placeholder="ID" class="input input-bordered w-full" />
                </div>
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text">Title</span>
                    </label>
                    <input type="text" name="title" id="title" placeholder="Title" class="input input-bordered w-full" />
                </div>
                <div class="text-right">
                    <label for="edit-todo" class="btn mt-5">Cancel</label>
                    <button type="submit" class="btn btn-info btn-save mt-5">Save changes</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#container-id, .notFound").hide();

            $(".btn-edit").click(function () {
                $("#id").val($(this).parents("tr").attr("data"));
            });

            $(".btn-delete").click(function () {
                window.location.href = `/delete?id=${$(this).parents("tr").attr("data")}`;
            });

            $(".btn-updateStatus").click(function () {
                let id = $(this).parents("tr").attr("data");
                let status = $(this).parents("tr").children("td:nth-child(3)").text();

                window.location.href = `/update?id=${id}&status=${status}`;
            });

            $("#search").keyup(function() {
                searchItem($(this).val());
            });

            function searchItem(value) {
                let isEmpty = true;

                $("tbody tr").each(function() {
                    let isFound = false;
                    
                    $(this).each(function() {
                        if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0) {
                            isFound = true;
                        }
                    });
                    
                    if(isFound) {
                        $(this).show();
                        isEmpty = false;
                    } else {
                        $(this).hide();
                    }
                });

                if(isEmpty) {
                    $(".notFound").show();
                } else {
                    $(".notFound").hide();
                }
            }
        });
    </script>
@endsection