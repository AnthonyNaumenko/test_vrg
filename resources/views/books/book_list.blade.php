<table class="table table-dark table-striped">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Картинка</th>
        <th scope="col">Название</th>
        <th scope="col">Дата публикации</th>
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
            <td>{{$book->date}}</td>
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
