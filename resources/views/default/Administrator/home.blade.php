@extends('default.layouts.layout_edit')

@section('content')
    <div style="color: red; padding-bottom: 20px">Главная (Администратор): Добавление недвижимости->Продажа->Квартира</div>

    <form method="post" action="#">
        {{ csrf_field() }}
        <div>
            <label>Причина надобности в материале</label>
            <select name="responsible">
                <option value="1"></option>
            </select>
        </div>

        <div>
            <label>Причина надобности в материале</label>
                <input type="text" name="end_time" value=""/>
        </div>

    </form>
@endsection