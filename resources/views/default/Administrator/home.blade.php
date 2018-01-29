@extends('default.layouts.layout_edit')

@section('content')
    <div style="color: red; padding-bottom: 20px">Главная (Администратор): Добавление недвижимости->Продажа->Квартира</div>

    <form method="post" action="#">
        {{ csrf_field() }}
        <div>
            <select>
                <option value="null">Выберите город</option>
                @foreach($city as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
            <select>
                <option value="null">Выберите район</option>
                @foreach($region as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
            <select>
                <option value="null">Выберите территорую</option>
                @foreach($territory as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
            <select>
                <option value="null">Выберите округ</option>
                @foreach($district as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
            <select>
                <option value="null">Выберите вид объекта</option>
                @foreach($type_object as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
            <select>
                <option value="null">Выберите материал</option>
                @foreach($material as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
            <select>
                <option value="null">Выберите ремонт(repairs)</option>
                @foreach($repairs as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
            <select>
                <option value="null">Выберите планоровку(lay_out)</option>
                @foreach($lay_out as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
            <select>
                <option value="null">Выберите позицию (position)</option>
                @foreach($position as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
            <select>
                <option value="null">Выберите ($documents)</option>
                @foreach($documents as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
            <select>
                <option value="null">Выберите ($type_pay)</option>
                @foreach($type_pay as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
            <select>
                <option value="null">Выберите ($more_info)</option>
                @foreach($more_info as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
            <select>
                <option value="null">Выберите ($price_quality)</option>
                @foreach($price_quality as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
            <select>
                <option value="null">Выберите ($fill_info)</option>
                @foreach($fill_info as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <div>
                <label for="flat">Количество комнат</label>
                <input name="flat" placeholder="Количество комнат" type="number">
            </div>
            <div>
                <label for="floor">Этаж квартиры</label>
                <input placeholder="Этаж квартиры" name="floor" type="number">
            </div>
            <div>
                <label for="house">Этаж дома</label>
                <input placeholder="Этаж дома" name="house" type="number">
            </div>
            <div>
                <label for="host_price">Цена хозяина</label>
                <input placeholder="Цена хозяина" name="host_price">
            </div>
            <div>
                <label for="price">Цена</label>
                <input placeholder="Цена" name="price">
            </div>
            <div>
                <label for="green_area">Квадратура по зеленке</label>
                <input placeholder="Квадратура по зеленке" name="green_area" type="number">
            </div>
            <div>
                <label for="total_area">Общая квадратура</label>
                <input placeholder="Общая квадратура" name="total_area" type="number">
            </div>
            <div>
                <label for="count_balcony">Количество балконов</label>
                <input placeholder="Количество балконов" name="count_balcony" type="number">
            </div>
        </div>
        <button>Отправить</button>
    </form>
@endsection