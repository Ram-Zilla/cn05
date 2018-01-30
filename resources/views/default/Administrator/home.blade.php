@extends('default.layouts.layout_edit')

@section('content')
    <div style="color: red; padding-bottom: 20px">Главная (Администратор): Добавление недвижимости->Продажа->Квартира</div>

    <form method="post" action="{{route('add_ads')}}">
        {{ csrf_field() }}
        <div>
                    <hr>
                    <span style="color: #5cb85c">Адрес для клиентов</span>
                    <br>
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
            <div>
                <label for="maps_x">Долгота</label>
                <input placeholder="Долгота" name="maps_x" type="text">
            </div>
            <div>
                <label for="maps_y">Широта</label>
                <input placeholder="Широта" name="maps_y" type="text">
            </div>
            <hr>


                    <span style="color: #5cb85c">Точный адрес</span>
                    <br>
            <div>
                <label for="street">Улица</label>
                <input name="street" placeholder="Улица" type="text">
            </div>
            <div>
                <label for="home">Дом</label>
                <input name="home" placeholder="Улица" type="number">
            </div>
            <div>
                <label for="housing">Корпус</label>
                <input name="housing" placeholder="Корпус" type="text">
            </div>
            <div>
                <label for="entrance">Подъезд</label>
                <input name="entrance" placeholder="Подъезд" type="number">
            </div>
            <div>
                <label for="apartment_number">Номер квартиры</label>
                <input name="apartment_number" placeholder="Номер квартиры" type="number">
            </div>
            <hr>


                    <span style="color: #5cb85c">Основные характеристики объекта</span>
                    <br>
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
                <option value="null">Наличие лифта</option>
                <option value="1">Да</option>
                <option value="2">Нет</option>
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
            <hr>




                    <span style="color: #5cb85c">Дополнительные параметры</span>
                    <br>

            <select>
                <option value="null">Выберите источник информации ($more_info)</option>
                @foreach($more_info as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
            <div>
                <label for="exclusive_of">Эксклюзив от</label>
                <input placeholder="Эксклюзив от" name="exclusive_of" type="number">
            </div>
            <select>
                <option value="null">Наличие ключа</option>
                <option value="1">Да</option>
                <option value="2">Нет</option>
            </select>
            <select>
                <option value="null">Выберите цена-качество ($price_quality)</option>
                @foreach($price_quality as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
            <select>
                <option value="null">Выберите заполненость информации ($fill_info)</option>
                @foreach($fill_info as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
            <div>
                <label for="date_recall">Дата созвона</label>
                <input placeholder="Дата созвона" name="date_recall" type="date">
            </div>
            <hr>
            <span style="color: #5cb85c">Дополнительные параметры</span>
            <br>
            <div>
                <h5>Контактные данные</h5>
                <div>
                    <div>
                        <label for="hostName">Имя хозяина</label>
                        <input placeholder="Имя хозяина" name="hostName" required="" type="text">
                    </div>
                </div>
                <div>
                    <div>
                        <label for="hostPhone">Номер хозяина</label>
                        <input placeholder="_ (___) ___-__-__" class="form-control tel-host" required="" maxlength="17" type="tel">
                        <input placeholder="Номер хозяина" name="hostPhone" required="" type="hidden">
                    </div>
                </div>
                <div>
                    <div>
                        <label for="hostSecPhone">Дополнительный номер</label>
                        <input placeholder="_ (___) ___-__-__" class="form-control tel-sec" maxlength="17" type="tel">
                        <input placeholder="Дополнительный номер" name="hostSecPhone" type="hidden">
                    </div>
                </div>
                <div>
                    <div>
                        <label for="agentName">Представитель хозяина</label>
                        <input placeholder="Представитель хозяина" name="agentName" type="text">
                    </div>
                </div>
                <div>
                    <div>
                        <label for="agentPhone">Номер представителя</label>
                        <input placeholder="_ (___) ___-__-__" class="form-control tel-agent" maxlength="17" type="tel">
                        <input placeholder="Номер представителя" name="agentPhone" type="hidden">
                    </div>
                </div>
                <div>
                    <div>
                        <label for="access">Недоступен</label>
                        <select name="access" id="" class="form-control">
                            <option value="">Выберите</option>
                            <option value="1">Да</option>
                            <option value="0">Нет</option>
                        </select>
                    </div>
                </div>
                <div>
                    <div>
                        <label for="nabor">Набрать</label>
                        <input name="nabor" type="text">
                        <script>
                            var Data = new Date();
                            $("#nabor").dateRangePicker({
                                autoClose: true,
                                singleDate : true,
                                showShortcuts: false,
                                format: "DD.MM.YYYY",
                            });
                        </script>
                    </div>
                </div>
                <div>
                    <div class="form-group">
                        <label for="comments">Комментарии</label>
                        <textarea rows="4" name="comments"></textarea>
                    </div>
                </div>
            </div>
            <div>
                <h5>Описание</h5>
                <div>
                    <div>
                        <label for="clientDescr">Описание для клиентов</label>
                        <textarea name="clientDescr" rows="10" required=""></textarea>
                    </div>
                </div>
                <div>
                    <div>
                        <label for="specDescr">Описание для Специалистов</label>
                        <textarea name="specDescr" rows="10"></textarea>
                    </div>
                </div>
            </div>
            <div class="row bottom_bordered" style="margin-bottom: 15px">
                <div>
                    <div>
                        <label>Фото</label>
                        <input name="img[]" class="form-control" multiple="" accept="image/*" type="file">
                    </div>
                    <div>
                        <button>Загрузить фото</button>
                        <progress max="100" value="0">0</progress>
                        <input name="imgtext" type="hidden">
                    </div>
                </div>
                <div>
                    <div>
                        <label>Видео(Введите ссылку)</label>
                        <input name="video" pattern="https://.*" class="form-control" placeholder="https://..." type="text">
                    </div>
                </div>
                <div>
                    <div>
                        <label>Фото двора</label>
                        <input name="imgYard[]" class="form-control" multiple="" accept="image/*" type="file">
                    </div>
                    <div>
                        <button class="btn btn-primary">Загрузить фото</button>
                        <progress max="100" value="0">0</progress>
                        <input name="imgYtext" type="hidden">
                    </div>
                </div>
                <div>
                    <div>
                        <label>Фото планировки</label>
                        <input name="imgLayout[]" multiple="" accept="image/*" type="file">
                    </div>
                    <div>
                        <button>Загрузить фото</button>
                        <progress max="100" value="0">0</progress>
                        <input name="imgLtext" type="hidden">
                    </div>
                </div>
            </div>




        </div>
        <div>

        </div>
        <button>Отправить</button>
    </form>
@endsection