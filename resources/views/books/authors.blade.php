@extends('books.index')
@section('body')

    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <form action="{{route('search_authors')}}" method="post" class="d-flex">
                {{csrf_field()}}
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <div class="row">
        <div class="col-lg-9">
            <h3>Авторы</h3>
        </div>


        <div class="col-lg-9" style="margin-bottom: 10px">
            <button type="button" class="btn btn-success add--p" data-bs-toggle="modal" data-bs-target="#authorForm">
                + Добавить автора
            </button>
        </div>
    </div>

    <!-- Add -->
    <div class="modal fade" id="authorForm" tabindex="-1" aria-labelledby="authorFormLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="authorFormLabel">Добавить автора</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="form-author-create">
                    <form id="addAuthor" {{--method="post"--}}>
                        <div class="modal-body">
                            {{csrf_field()}}
                            {{--<input type="text" name="id" class="form-control" value="@if($author->id){{$author->id}}@endif" hidden>--}}
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Фамилия</label>
                                <div class="col-sm-10">
                                    {{--<input type="text" name="last_name" class="form-control" value="@if($author->last_name){{$author->last_name}}@endif">--}}
                                    <input type="text" name="last_name" required class="form-control" value="">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Имя</label>
                                <div class="col-sm-10">
                                    {{--<input type="text" name="first_name" class="form-control" value="@if($author->first_name){{$author->first_name}}@endif">--}}
                                    <input type="text" name="first_name" required class="form-control" value="">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Отчество</label>
                                <div class="col-sm-10">
                                    {{--<input type="text" name="middle_name" class="form-control" value="@if($author->middle_name){{$author->middle_name}}@endif">--}}
                                    <input type="text" name="middle_name" class="form-control" value="">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" id="close" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть
                                </button>
                                <button type="submit" class="btn btn-success">Сохранить</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit -->
    <div class="modal fade" id="editAuthorForm" tabindex="-1" aria-labelledby="authorFormLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="authorFormLabel">Изменить автора</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="form--edit">
                    <form id="editAuthor" method="post">
                        <div class="modal-body">

                            {{csrf_field()}}
                            {{method_field('PUTCH')}}
                            <input type="text" id="id" name="id" class="form-control" value="" hidden>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Фамилия</label>
                                <div class="col-sm-10">
                                    {{--<input type="text" name="last_name" class="form-control" value="@if($author->last_name){{$author->last_name}}@endif">--}}
                                    <input id="lName" type="text" name="last_name" class="form-control" value="">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Имя</label>
                                <div class="col-sm-10">
                                    {{--<input type="text" name="first_name" class="form-control" value="@if($author->first_name){{$author->first_name}}@endif">--}}
                                    <input id="fName" type="text" name="first_name" class="form-control" value="">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Отчество</label>
                                <div class="col-sm-10">
                                    {{--<input type="text" name="middle_name" class="form-control" value="@if($author->middle_name){{$author->middle_name}}@endif">--}}
                                    <input id="mName" type="text" name="middle_name" class="form-control" value="">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" id="close-edit" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть
                                </button>
                                <button type="submit" class="btn btn-success">Обновить</button>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
{{--Edit--}}

    <!-- Delete -->
    <div class="modal fade" id="deleteAuthorForm" tabindex="-1" aria-labelledby="authorFormLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="authorFormLabel">Изменить автора</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="deleteAuthor" method="post">
                    <div class="modal-body">

                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <input type="text" id="delete_id" name="id" class="form-control" value="" hidden>
                        Подтвердите удаление
                        <div class="modal-footer">
                            <button type="button" id="close-delete" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть
                            </button>
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--Delete--}}
    <div class="authors--table">
    <table class="table table-dark table-striped">
        <thead>
        <tr>
            {{--<th scope="col">#</th>--}}
            <th scope="col">Фамилия</th>
            <th scope="col">Имя</th>
            <th scope="col">Отчество</th>
            <th scope="col" style="width: 50px">Редактировать</th>
            <th scope="col" style="width: 50px">Удалить</th>
        </tr>
        </thead>
        <tbody>

        @foreach($authors as $author)
            <tr>

                <td hidden>{{$author->id}}</td>
                <td>{{$author->last_name}}</td>
                <td>{{$author->first_name}}</td>
                <td>{{$author->middle_name}}</td>
                <td>
                    <button id="ed" type="button" class="btn edit--author btn-outline-success">Edit</button>
                </td>
                <td>
                    <button id="del" type="button" class="btn delete--author btn-outline-danger">Delete</button>
                </td>
            </tr>
        @endforeach

    </table>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
        $('#addAuthor').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: "/author",
                type: "POST",
                data: $('#addAuthor').serialize(),
                success: function (data) {
                    $("#close").trigger("click");
                    $('.authors--table').html(data);
                    /*location.reload();*/
                },
                error: function (error) {
                    alert('Автор не добавлен!')
                }
            });
        });

        $(document).on('click', '.edit--author', function () {
            $('#editAuthorForm').modal('show');
            var tr = $(this).closest('tr'),
                data = tr.children('td').map(function () {
                    return $(this).text();
                }).get();
            console.log(data);
            $('#id').val(data[0]);
            $('#lName').val(data[1]);
            $('#fName').val(data[2]);
            $('#mName').val(data[3]);
        });

        $('#editAuthor').on('submit', function (e) {
            e.preventDefault();
            var id = $('#id').val();
            $.ajax({
                url: "/author/"+id,
                type: "PATCH",
                data: $('#editAuthor').serialize(),
                success: function (data) {
                    $("#close-edit").trigger("click");
                    $('.authors--table').html(data);
                },
                error: function (error) {
                    alert('Автор не добавлен!')
                }
            });
        });
        $(document).on('click','.delete--author', function () {
        /*$('.delete--author').on('click', function () {*/
            $('#deleteAuthorForm').modal('show');
            var tr = $(this).closest('tr'),
                data = tr.children('td').map(function () {
                    return $(this).text();
                }).get();

            $('#delete_id').val(data[0]);
        });
        $('#deleteAuthor').on('submit', function (e) {
            e.preventDefault();
            var id = $('#delete_id').val();
            $.ajax({
                url: "/author/"+id,
                type: "DELETE",
                data: $('#deleteAuthor').serialize(),
                success: function (data) {
                    $("#close-delete").trigger("click");
                    $('.authors--table').html(data);
                },
                error: function (error) {

                }
            });
        });

        });
    </script>
@endsection


