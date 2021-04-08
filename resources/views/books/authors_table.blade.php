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
                <button  type="button" class="btn edit--author btn-outline-success">Edit</button>
            </td>
            <td>
                <button type="button" class="btn delete--author btn-outline-danger">Delete</button>
            </td>
        </tr>
    @endforeach

</table>
