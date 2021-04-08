
<form id="editBook" method="post" action="book/{{$book->id}}" enctype="multipart/form-data">
    <div class="modal-body">
        {{csrf_field()}}
        {{method_field('PUT')}}
        <div class="row">
            <label class="col-sm-2 col-form-label">Название</label>
            <div class="col-sm-10">
                <input type="text" id="id" name="id" class="form-control" value="{{$book->id}}" hidden>
                <input type="text" id="name" name="name" class="form-control" value="{{$book->name}}" required>
            </div>
        </div>
        <div class="row">
            <label class="col-sm-2 col-form-label">Дата публикации</label>
            <div class="col-sm-10">
                <input type="text" name="date" class="form-control" value="{{$book->date}}" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Описание</label>
            <div class="col-sm-10">
                <textarea id="description" name="description" class="form-control" >{{$book->description}}</textarea>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Авторы</label>
            <div class="col-sm-10">

                <select multiple="multiple" name="authors_ids[]" id="authorsSelect" required>
                    @foreach($authors as $a)
                        <option value='{{$a->id}}' @if(in_array($a->id, $book->author_ids)) selected @endif>{{$a->first_name}} {{$a->last_name}}</option>
                    @endforeach
                </select>


            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Изображение</label>
            <div class="col-sm-12">
                <input class="form-control" id="image" type="file" name="image" id="formFile" >
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" id="close" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть
            </button>
            <button type="submit" class="btn btn-success">Обновить</button>
        </div>

    </div>
</form>
