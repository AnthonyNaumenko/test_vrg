@extends('books.index')
@section('body')

    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <form action="{{route('search_books')}}" method="post" class="d-flex">
                {{csrf_field()}}
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <div class="row">
        <div class="col-lg-9">
            <h3>Книги</h3>
        </div>


        <div class="col-lg-9" style="margin-bottom: 10px">
            <button type="button" class="btn btn-success add--p" data-bs-toggle="modal" data-bs-target="#bookForm">
                + Добавить книгу
            </button>
        </div>
    </div>

    <!-- Add -->
    <div class="modal fade" id="bookForm" tabindex="-1" aria-labelledby="bookFormLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookFormLabel">Добавить книгу</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="addbook" method="post" action="{{ route('book.store') }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        {{csrf_field()}}
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Название</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" value="" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Описание</label>
                            <div class="col-sm-10">
                                <textarea name="description" class="form-control" value=""></textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Авторы</label>
                            <div class="col-sm-10">

                                <select multiple="multiple" name="authors_ids[]" id="authorsSelect" required>
                                    @foreach($authors as $a)
                                        <option value='{{$a->id}}'>{{$a->first_name}} {{$a->last_name}}</option>
                                    @endforeach
                                </select>


                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Изображение</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" name="image" id="formFile">
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

    <!-- Delete -->
    <div class="modal fade" id="deleteBookForm" tabindex="-1" aria-labelledby="authorFormLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="authorFormLabel">Изменить автора</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="deleteBook" method="post">
                    <div class="modal-body">

                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <input type="text" id="delete_id" name="id" class="form-control" value="" hidden>
                        Подтвердите удаление
                        <div class="modal-footer">
                            <button type="button" id="close-delete" class="btn btn-secondary" data-bs-dismiss="modal">
                                Закрыть
                            </button>
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--Delete--}}


    {{--Edit--}}

    <div class="modal fade" id="editBookForm" tabindex="-1" aria-labelledby="authorFormLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookFormLabel">Добавить книгу</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="book--edit">
                    <form id="editBook" method="post" action="" enctype="multipart/form-data">
                        <div class="modal-body">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Название</label>
                                <div class="col-sm-10">
                                    <input type="text" id="name" name="name" class="form-control" value="">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Описание</label>
                                <div class="col-sm-10">
                                    <textarea id="name" name="description" class="form-control" value=""></textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Авторы</label>
                                <div class="col-sm-10">

                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Изображение</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="image" type="file" name="image" id="formFile">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" id="close" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Закрыть
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

    <div class="row book--table">
        <table class="table table-dark table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Картинка</th>
                <th scope="col">Название</th>
                <th scope="col">Описание</th>
                <th scope="col">Авторы</th>
                <th scope="col" style="width: 50px">Редактировать</th>
                <th scope="col" style="width: 50px">Удалить</th>
            </tr>
            </thead>
            <tbody>

            @foreach($books as $key=>$book)
                <tr>
                    <th scope="row">{{++$key}}</th>
                    <td hidden>{{$book->id}}</td>
                    <td style="max-width: 150px;"><img src="{{ Storage::url($book->image) }}" class="card-img-top"
                                                       style="max-height: 150px; max-width: 150px;"></td>
                    <td>{{$book->name}}</td>
                    <td>{{$book->description}}</td>
                    <td>
                        <ul>
                            @foreach($book->authors as $a)
                                <li>{{$a->first_name}} {{$a->last_name}}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <button id="ed" type="button" class="btn edit--book btn-outline-success"
                                data-book_id="{{$book->id}}">Edit
                        </button>
                    </td>
                    <td>
                        <button id="del" type="button" class="btn delete--book btn-outline-danger"
                                data-book_id="{{$book->id}}">Delete
                        </button>
                    </td>
                </tr>
            @endforeach

        </table>

    </div>

    <script type="text/javascript">

        $(document).on('click', '.edit--book', function () {
            var id = $(this).data('book_id');
            $('#editBookForm').modal('show');
            $.ajax({

                url: "/book/" + id + "/edit",
                type: "GET",
                data: id,
                success: function (data) {

                    $('.book--edit').html(data);

                },
                error: function (error) {
                    /*alert('Автор не добавлен!')*/
                }
            });

        });

        $(document).on('click', '.delete--book', function () {
            $('#deleteBookForm').modal('show');
            var id = $(this).data('book_id');

            $('#delete_id').val(id);

            $('#deleteBook').on('submit', function (e) {
                e.preventDefault();
                console.log($('#deleteBook').serialize());
                $.ajax({
                    url: "/book/" + id,
                    type: "DELETE",
                    data: $('#deleteBook').serialize(),
                    success: function (data) {
                        $("#close-delete").trigger("click");
                        $('.book--table').html(data);
                    },
                    error: function (error) {
                    }
                });
            });
        });
        $(document).on('submit', '#search', function (e) {
            e.preventDefault();

            $.ajax({
                url: "/book/search/",
                type: "POST",
                data: $('#search').serialize(),
                success: function (data) {
                    $('.book--table').html(data);
                },
                error: function (error) {
                }
            });
        });

    </script>
    <style>
        .custom--list {
            width: 32.333333%;
            margin-right: -195px;
            margin-left: 41px;
            margin-bottom: 40px;
        }
    </style>
@endsection
