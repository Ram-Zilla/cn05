<?php

namespace App\Http\Controllers;

use App\Notifications\PostPublished;
use App\Fine;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\Employee;
use App\View_fine;
use Auth;
use Excel;
use View;


class AdministratorController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    //ГЛАВНАЯ СТРАНИЦА СО СПИСКОМ ШТРАФОВ
    public function index(){
        $user = Auth::user();
        $code = $user->code; // получение кода авторизованного пользователя
        if ( $code != 100 && $code != 200 ) {return redirect('/');}
        $user_id = Auth::id();

        $options = null;
        $date = null;
        $start_date = null;
        $end_date = null;
        if($code == 200){
            $fines = Fine::where('status', 1)->where('initiator', $user_id)->orderBy('date', 'desc')->get();
            $del_fines = Fine::where('status', 0)->where('initiator', $user_id)->orderBy('date', 'desc')->get();
        }
        elseif($code == 100) {
            $fines = Fine::where('status', 1)->orderBy('date', 'desc')->get();
            $del_fines = Fine::where('status', 0)->orderBy('date', 'desc')->get();
        }




        return view('default.Administrator.AdministratorFines',
            [
                'user_id'=>$user_id,
                'code'=>$code,
                'fines'=>$fines,
                'del_fines'=>$del_fines,

                'options'=>$options,
                'date'=>$date,
                'start_date'=>$start_date,
                'end_date'=>$end_date,
            ]);
    }


    //ГЛАВНАЯ СТРАНИЦА СО СПИСКОМ ШТРАФОВ С ПРИМЕНЕНИЕМ ФИЛЬТРА
    public function post_filter_fine(Request $request){
        $user = Auth::user();
        $code = $user->code; // получение кода авторизованного пользователя
        if ( $code != 100 && $code != 200 ) {return redirect('/');}

        $user_id = Auth::id();

        $options = $request->optionsRadios;
        $date = $request->date;
        $start_date = $request->start_date;
        $end_date = $request->end_date;



        if($options == 1){ // Сегодня
            $date = Carbon::today()->toDateString('Y-m-d', 'ru');
            if($code == 200){
                $fines = Fine::where('status', 1)
                    ->whereDate('date',  $date)
                    ->where('initiator', $user_id)
                    ->orderBy('date', 'desc')->get();
                $del_fines = Fine::where('status', 0)
                    ->whereDate('date',  $date)
                    ->where('initiator', $user_id)
                    ->orderBy('date', 'desc')->get();
            }
            elseif ($code == 100){
                $fines = Fine::where('status', 1)
                    ->whereDate('date',  $date)
                    ->orderBy('date', 'desc')->get();
                $del_fines = Fine::where('status', 0)
                    ->whereDate('date',  $date)
                    ->orderBy('date', 'desc')->get();
            }

        }
        elseif ($options == 2){ // Если выбрана дата
            $this->validate($request, [
                'date' => 'required',
            ]);
            if($code == 200){
                $fines = Fine::where('status', 1)
                    ->whereDate('date',  $date)
                    ->where('initiator', $user_id)
                    ->orderBy('date', 'desc')->get();
                $del_fines = Fine::where('status', 0)
                    ->whereDate('date',  $date)
                    ->where('initiator', $user_id)
                    ->orderBy('date', 'desc')->get();
            }
            elseif ($code == 100){
                $fines = Fine::where('status', 1)
                    ->whereDate('date',  $date)
                    ->orderBy('date', 'desc')->get();
                $del_fines = Fine::where('status', 0)
                    ->whereDate('date',  $date)
                    ->orderBy('date', 'desc')->get();
            }
        }
        elseif ($options == 3){ // Если выбран диапазон даты
            $this->validate($request, [
                'start_date' => 'required',
                'end_date' => 'required',
            ]);
            if($code == 200){
                $fines = Fine::where('status', 1)
                    ->where('initiator', $user_id)
                    ->whereDate('date', '>=',  $start_date)
                    ->whereDate('date', '<=',  $end_date)
                    ->orderBy('date', 'desc')
                    ->get();
                $del_fines = Fine::where('status', 0)
                    ->where('initiator', $user_id)
                    ->whereDate('date', '>=',  $start_date)
                    ->whereDate('date', '<=',  $end_date)
                    ->orderBy('date', 'desc')
                    ->get();
            }
            elseif ($code == 100){
                $fines = Fine::where('status', 1)
                    ->whereDate('date', '>=',  $start_date)
                    ->whereDate('date', '<=',  $end_date)
                    ->orderBy('date', 'desc')
                    ->get();
                $del_fines = Fine::where('status', 0)
                    ->whereDate('date', '>=',  $start_date)
                    ->whereDate('date', '<=',  $end_date)
                    ->orderBy('date', 'desc')
                    ->get();
            }
        }

        return view('default.Administrator.AdministratorFines',
            [
                'user_id'=>$user_id,
                'code'=>$code,
                'fines'=>$fines,
                'del_fines'=>$del_fines,

                'options'=>$options,
                'date'=>$date,
                'start_date'=>$start_date,
                'end_date'=>$end_date,
            ]);
    }


    //СТРАНИЦА СО СПИСКОМ СОТРУДНИКОВ И ШТРАФОВ ДЛЯ РЕДАКТИРОВАНИЯ
    public function edit(){
        $user = Auth::user();
        $code = $user->code; // получение кода авторизованного пользователя
        if ( $code != 100 && $code != 200 ) {return redirect('/');}
        $user_id = Auth::id();

        $employees = Employee::where('status', 1)->get();
        $view_fines = View_fine::where('status', 1)->get();

        $del_employees = Employee::where('status', 0)->get();
        $del_view_fines = View_fine::where('status', 0)->get();

        return view('default.Administrator.AdministratorEdit',
            [
                'user_id'=>$user_id,
                'code'=>$code,
                'employees'=>$employees,
                'view_fines'=>$view_fines,
                'del_employees'=>$del_employees,
                'del_view_fines'=>$del_view_fines,
            ]);
    }


    //СТРАНИЦА ДЛЯ ДОБАВЛЕНИЯ СОТРУДНИКА
    public function add_employee(){
        $user = Auth::user();
        $code = $user->code; // получение кода авторизованного пользователя
        if ( $code != 100 && $code != 200 ) {return redirect('/');}
        $user_id = Auth::id();




        return view('default.Administrator.AdministratorAddEmployee',
            [
                'user_id'=>$user_id,
                'code'=>$code,
            ]);
    }


    //ФУНКЦИЯ ДЛЯ ДОБАВЛЕНИЯ НОВОГО СОТРУДНИКА В БД
    public function post_add_employee(Request $request){
        $user = Auth::user();
        $code = $user->code; // получение кода авторизованного пользователя
        if ( $code != 100 && $code != 200 ) {return redirect('/');}
        $user_id = Auth::id();

        $date = Carbon::now();
        $dateplus = ($date->addHours(3));

        $this->validate($request, [
            'fio' => 'required',
            'nikname' => 'required',
        ]);

        $employee = new Employee();
        $employee->fio = $request->fio;
        $employee->nikname = $request->nikname;
        $employee->status = 1; // 0 - уволен, 1 - работает
        $employee->start_time = $dateplus;
        $employee->save();

        return redirect('Edit');
    }


    //СТРАНИЦА ДЛЯ ДОБАВЛЕНИЯ НОВОГО ВИДА ШТРАФА
    public function add_view_fine(){
        $user = Auth::user();
        $code = $user->code; // получение кода авторизованного пользователя
        if ( $code != 100 && $code != 200 ) {return redirect('/');}
        $user_id = Auth::id();




        return view('default.Administrator.AdministratorAddViewFine',
            [
                'user_id'=>$user_id,
                'code'=>$code,
            ]);
    }


    //ФУНКЦИЯ ДЛЯ ДОБАВЛЕНИЯ НОВОГО ШТРАФА В БД
    public function post_add_view_fine(Request $request)
    {
        $user = Auth::user();
        $code = $user->code; // получение кода авторизованного пользователя
        if ( $code != 100 && $code != 200 ) {return redirect('/');}
        $user_id = Auth::id();

        $date = Carbon::now();
        $dateplus = ($date->addHours(3));

        $this->validate($request, [
            'name' => 'required',
            'summ' => 'required',
        ]);

        $fine = new View_fine();
            $fine->name = $request->name;
            $fine->summ = $request->summ;
            $fine->status = 1; // 0 - не активна, 1 - активна
            $fine->date = $dateplus;
        $fine->save();

        return redirect('Edit');
    }


    //СТРАНИЦА ДОБАВЛЕНИЯ ШТРАФА
    public function add_fine(){
        $user = Auth::user();
        $code = $user->code; // получение кода авторизованного пользователя
        if ( $code != 100 && $code != 200 ) {return redirect('/');}
        $user_id = Auth::id();

        $view_fines = View_fine::where('status', 1)->get();
        $employees = Employee::where('status', 1)->get();


        return view('default.Administrator.AdministratorAddFine',
            [
                'user_id'=>$user_id,
                'code'=>$code,
                'view_fines'=>$view_fines,
                'employees'=>$employees,
            ]);
    }


    //ФУНКЦИЯ ДЛЯ ДОБАВЛЕНИЯ ШТРАФА В БД
    public function post_add_fine(Request $request){
        $user = Auth::user();
        $code = $user->code; // получение кода авторизованного пользователя
        if ( $code != 100 && $code != 200 ) {return redirect('/');}
        $user_id = Auth::id();
        $users = User::all();

        $name_initiator = null;
        foreach ($users as $item){
            if($item->id == $user_id){
                $name_initiator = $item->name;
            }
        }

        $id_employee = $request->employee;
        $id_view_fine = $request->view_fine;

        $date = Carbon::now();
        $dateplus = ($date->addHours(3));

        $fine = new Fine();
            $fine->id_fine = $request->view_fine;
            $fine->id_employee = $request->employee;
            $fine->initiator = $user_id;
                $employee = Employee::find($id_employee);
            $fine->employee = $employee->fio;
                $view_fine = View_fine::find($id_view_fine);
            $fine->view_fine = $view_fine->name;
            $fine->summ = $view_fine->summ;
            $fine->status = 1; // 0 - удалён, 1 - активен
            $fine->date = $dateplus;
            $fine->commentary = $request->commentary;
        $fine->save();

        // *******telegram bot
        $bot_token = '346415370:AAEb6s5RzW7ITJSwviU8uUvdD3lXKeWXiJg';
        $bot_chat_id = '-1001299617959';

        $bot_text = "НОВЫЙ ШТРАФ!\n".
            "Имя сотрудника: ".$employee->fio."(".$employee->nikname.")\n".
            "Вид: ".$view_fine->name."\n".
            "Сумма: ".$view_fine->summ." руб.\n\n".
            "Поставщик: ".$name_initiator."\n".
            "Хочешь обжаловать?\nНапиши здесь.";
        file("https://api.telegram.org/bot" . $bot_token .
            "/sendMessage?chat_id=" .
            $bot_chat_id .
            "&text=" .
            urlencode($bot_text) );
        // *********telegram bot end

        return redirect('Fines');
    }


    //ФУНКЦИЯ ДЛЯ ОТОБРАЖЕНИЯ ОТДЕЛЬНО ВЫБРАННОГО ШТРАФА
    public function open_fine($id){

        $user = Auth::user();
        $code = $user->code; // получение кода авторизованного пользователя
        if ( $code != 100 && $code != 200 ) {return redirect('/');}

        $user_id = Auth::id();
        $users = User::all();


        if($code == 100){
            $fine = Fine::where('id', $id)->get();
        }
        elseif ($code == 200){
            $fine = Fine::where('id', $id)->where('initiator', $user_id)->get();
        }

        return view('default.Administrator.AdministratorOpenFine',
            [
                'user_id' => $user_id,
                'users' => $users,
                'code' => $code,
                'fine' => $fine,

            ]);
    }


    //ФУНКЦИЯ ДЛЯ УДАЛЕНИЯ ОТДЕЛЬНО ВЫБРАННОГО ШТРАФА
    public function del_fine($id){

        $user = Auth::user();
        $code = $user->code; // получение кода авторизованного пользователя
        if ( $code != 100 && $code != 200 ) {return redirect('/');}

        $user_id = Auth::id();
        $users = User::all();

        $fine = Fine::find($id);
            $fine->status = 0;
        $fine->save();



        // *******telegram bot
        $bot_token = '346415370:AAEb6s5RzW7ITJSwviU8uUvdD3lXKeWXiJg';
        $bot_chat_id = '-1001299617959';

        $name_initiator = null;
        foreach ($users as $item){
            if($item->id == $user_id){
                $name_initiator = $item->name;
            }
        }

        $bot_fine = Fine::find($id);
            $id_employee = $bot_fine->id_employee;
            $id_fine = $bot_fine->id_fine;
        $bot_employee = Employee::find($id_employee);
        $bot_view_fine = View_fine::find($id_fine);

        $bot_text = "Штраф УДАЛЁН!\n".
            "Имя сотрудника: ".$bot_employee->fio."(".$bot_employee->nikname.")\n".
            "Вид: ".$bot_view_fine->name."\n".
            "Сумма: ".$bot_view_fine->summ." руб.\n\n".
            "Поставщик: ".$name_initiator."\n".
            "Хочешь обжаловать?\nНапиши здесь.";
        file("https://api.telegram.org/bot" . $bot_token .
            "/sendMessage?chat_id=" .
            $bot_chat_id .
            "&text=" .
            urlencode($bot_text) );
        // *********telegram bot end




        return redirect('Fines');
    }


    //ФУНКЦИЯ ДЛЯ СОХРАНЕНИЯ ИЗМЕНЕНИЙ ШТРАФА
    public function post_edit_fine(Request $request){
        $user = Auth::user();
        $code = $user->code; // получение кода авторизованного пользователя
        if ( $code != 100 && $code != 200 ) {return redirect('/');}
        $user_id = Auth::id();

        $date = Carbon::now();
        $dateplus = ($date->addHours(3));

//        $id_employee = $request->employee;
//        $id_view_fine = $request->view_fine;


        $fine = Fine::find($request->id);
            $fine->commentary = $request->commentary;
        $fine->save();

        $name = 'OpenFine/'.$request->id;
        return redirect($name);
    }


    //ФУНКЦИЯ ДЛЯ ОТОБРАЖЕНИЯ ОТДЕЛЬНО ВЫБРАННОГО СОТРУДНИКА
    public function open_employee($id){

        $user = Auth::user();
        $code = $user->code; // получение кода авторизованного пользователя
        if ( $code != 100 && $code != 200 ) {return redirect('/');}

        $user_id = Auth::id();

        $employee = Employee::where('id', $id)->get();


        return view('default.Administrator.AdministratorOpenEmployee',
            [
                'user_id' => $user_id,
                'code' => $code,
                'employee' => $employee,
            ]);
    }


    //ФУНКЦИЯ ДЛЯ СОХРАНЕНИЯ ИЗМЕНЕНИЙ СОТРУДНИКА
    public function post_edit_employee(Request $request){
        $user = Auth::user();
        $code = $user->code; // получение кода авторизованного пользователя
        if ( $code != 100 && $code != 200 ) {return redirect('/');}
        $user_id = Auth::id();


        if( ($request->fio != null) && ($request->nikname != null) ){
            $employee = Employee::find($request->id);
                $employee->fio = $request->fio;
                $employee->nikname = $request->nikname;
            $employee->save();
        }

        $name = 'OpenEmployee/'.$request->id;
        return redirect($name);
    }


    //ФУНКЦИЯ ДЛЯ УДАЛЕНИЯ ОТДЕЛЬНО ВЫБРАННОГО СОТРУДНИКА
    public function del_employee($id){

        $user = Auth::user();
        $code = $user->code; // получение кода авторизованного пользователя
        if ( $code != 100 && $code != 200 ) {return redirect('/');}

        $user_id = Auth::id();
        $users = User::all();

        $employee = Employee::find($id);
            $employee->status = 0;
        $employee->save();


        return redirect('Edit');
    }


    //ФУНКЦИЯ ДЛЯ ОТОБРАЖЕНИЯ ОТДЕЛЬНО ВЫБРАННОГО ВИДА ШТРАФА
    public function open_view_fine($id){

        $user = Auth::user();
        $code = $user->code; // получение кода авторизованного пользователя
        if ( $code != 100 && $code != 200 ) {return redirect('/');}

        $user_id = Auth::id();

        $view_fine = View_fine::where('id', $id)->get();


        return view('default.Administrator.AdministratorOpenViewFine',
            [
                'user_id' => $user_id,
                'code' => $code,
                'view_fine' => $view_fine,
            ]);
    }


    //ФУНКЦИЯ ДЛЯ СОХРАНЕНИЯ ИЗМЕНЕНИЙ ВИДА ШТРАФА
    public function post_edit_view_fine(Request $request){
        $user = Auth::user();
        $code = $user->code; // получение кода авторизованного пользователя
        if ( $code != 100 && $code != 200 ) {return redirect('/');}
        $user_id = Auth::id();


        if( ($request->name != null) && ($request->summ != null) ){
            $view_fine = View_fine::find($request->id);
                $view_fine->name = $request->name;
                $view_fine->summ = $request->summ;
            $view_fine->save();
        }

        $name = 'OpenViewFine/'.$request->id;
        return redirect($name);
    }


    //ФУНКЦИЯ ДЛЯ УДАЛЕНИЯ ОТДЕЛЬНО ВЫБРАННОГО СОТРУДНИКА
    public function del_view_fine($id){

        $user = Auth::user();
        $code = $user->code; // получение кода авторизованного пользователя
        if ( $code != 100 && $code != 200 ) {return redirect('/');}

        $user_id = Auth::id();
        $users = User::all();

        $view_fine = View_fine::find($id);
            $view_fine->status = 0;
        $view_fine->save();


        return redirect('Edit');
    }


    //ФУНКЦИЯ ДЛЯ ВОССТАНОВЛЕНИЯ ОТДЕЛЬНО ВЫБРАННОГО СОТРУДНИКА
    public function recovery_employee($id){

        $user = Auth::user();
        $code = $user->code; // получение кода авторизованного пользователя
        if ( $code != 100 && $code != 200 ) {return redirect('/');}

        $user_id = Auth::id();
        $users = User::all();

        $employee = Employee::find($id);
            $employee->status = 1;
        $employee->save();


        return redirect('Edit');
    }


    //ФУНКЦИЯ ДЛЯ ВОССТАНОВЛЕНИЯ ОТДЕЛЬНО ВЫБРАННОГО ВИДА ШТРАФА
    public function recovery_view_fine($id){

        $user = Auth::user();
        $code = $user->code; // получение кода авторизованного пользователя
        if ( $code != 100 && $code != 200 ) {return redirect('/');}

        $user_id = Auth::id();
        $users = User::all();

        $view_fine = View_fine::find($id);
            $view_fine->status = 1;
        $view_fine->save();


        return redirect('Edit');
    }


    //ФУНКЦИЯ ДЛЯ ВОССТАНОВЛЕНИЯ ОТДЕЛЬНО ВЫБРАННОГО ШТРАФА
    public function recovery_fine($id){

        $user = Auth::user();
        $code = $user->code; // получение кода авторизованного пользователя
        if ( $code != 100 && $code != 200 ) {return redirect('/');}

        $user_id = Auth::id();
        $users = User::all();

        $fine = Fine::find($id);
            $fine->status = 1;
        $fine->save();

        // *******telegram bot
        $bot_token = '346415370:AAEb6s5RzW7ITJSwviU8uUvdD3lXKeWXiJg';
        $bot_chat_id = '-1001299617959';

        $name_initiator = null;
        foreach ($users as $item){
            if($item->id == $user_id){
                $name_initiator = $item->name;
            }
        }

        $bot_fine = Fine::find($id);
        $id_employee = $bot_fine->id_employee;
        $id_fine = $bot_fine->id_fine;
        $bot_employee = Employee::find($id_employee);
        $bot_view_fine = View_fine::find($id_fine);

        $bot_text = "Штраф ВОССТАНОВЛЕН!\n".
            "Имя сотрудника: ".$bot_employee->fio."(".$bot_employee->nikname.")\n".
            "Вид: ".$bot_view_fine->name."\n".
            "Сумма: ".$bot_view_fine->summ." руб.\n\n".
            "Поставщик: ".$name_initiator."\n".
            "Хочешь обжаловать?\nНапиши здесь.";
        file("https://api.telegram.org/bot" . $bot_token .
            "/sendMessage?chat_id=" .
            $bot_chat_id .
            "&text=" .
            urlencode($bot_text) );
        // *********telegram bot end


        return redirect('Fines');
    }


    //ФУНКЦИЯ ДЛЯ ВЫГРУЗКИ ОТЧЁТА В EXCEL
    public function download_excel(Request $request){
        $user = Auth::user();
        $code = $user->code; // получение кода авторизованного пользователя
        if ( $code != 100 && $code != 200 ) {return redirect('/');}
        $users = User::all();
        $user_id = Auth::id();

        $options = $request->options;
        $date = $request->date;
        $start_date = $request->start_date;
        $end_date = $request->end_date;


        if($options == 1){ // Сегодня
            $date = Carbon::today()->toDateString('Y-m-d', 'ru');
            if($code == 200){
                $fines = Fine::where('status', 1)
                    ->whereDate('date',  $date)
                    ->where('initiator', $user_id)
                    ->orderBy('date', 'desc')->get();
            }
            elseif ($code == 100){
                $fines = Fine::where('status', 1)
                    ->whereDate('date',  $date)
                    ->orderBy('date', 'desc')->get();
            }

        }
        elseif ($options == 2){ // Если выбрана дата
            $this->validate($request, [
                'date' => 'required',
            ]);
            if($code == 200){
                $fines = Fine::where('status', 1)
                    ->whereDate('date',  $date)
                    ->where('initiator', $user_id)
                    ->orderBy('date', 'desc')->get();
            }
            elseif ($code == 100){
                $fines = Fine::where('status', 1)
                    ->whereDate('date',  $date)
                    ->orderBy('date', 'desc')->get();
            }
        }
        elseif ($options == 3){ // Если выбран диапазон даты
            $this->validate($request, [
                'start_date' => 'required',
                'end_date' => 'required',
            ]);
            if($code == 200){
                $fines = Fine::where('status', 1)
                    ->where('initiator', $user_id)
                    ->whereDate('date', '>=',  $start_date)
                    ->whereDate('date', '<=',  $end_date)
                    ->orderBy('date', 'desc')
                    ->get();
            }
            elseif ($code == 100){
                $fines = Fine::where('status', 1)
                    ->whereDate('date', '>=',  $start_date)
                    ->whereDate('date', '<=',  $end_date)
                    ->orderBy('date', 'desc')
                    ->get();
            }
        }
        elseif ($options == null){
            if($code == 200){
                $fines = Fine::where('status', 1)
                    ->where('initiator', $user_id)
                    ->where('status', 1)
                    ->orderBy('date', 'desc')
                    ->get();
            }
            elseif ($code == 100){
                $fines = Fine::where('status', 1)
                    ->where('status', 1)
                    ->orderBy('date', 'desc')
                    ->get();
            }


        }

        $report = array();
        $summa = 0;
        foreach ($fines as $item){
            foreach ($users as $us){
                if($item->initiator == $us->id) $initiator = $us->name;
            }
            $summa += $item->summ;
            $report[] = array($item->date,
                        $initiator,
                        $item->employee,
                        $item->view_fine,
                        $item->summ,
                        $item->commentary);
        }


        Excel::create('Filename', function($excel) use($report, $summa) {
            $excel->sheet('Sheetname', function($sheet) use($report, $summa) {

                $sheet->fromArray($report);
                $sheet->row(1, array(
                    'Дата', 'Инициатор', 'Сотрудник', 'Вид штрафа', 'Сумма', 'Коментарий'
                ));
                $sheet->cells('A1:F1', function($cells) {
                    $cells->setFont(array('bold' => true));
                });
                $sheet->appendRow(array(
                    '------------------', '------------------', '------------------', '------------------', '------------------', '------------------'
                ));
                $sheet->appendRow(array(
                    'Итого', $summa
                ));

            });
        })->download('xls');

        //return redirect('Fines');


    }





}
