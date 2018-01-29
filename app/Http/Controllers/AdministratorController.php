<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use DB;
use Carbon\Carbon;
use File;
use App\Address;
use App\Archive;
use App\City;
use App\District;
use App\Documents;
use App\Fill_info;
use App\Furniture;
use App\Info_home;
use App\Lay_out;
use App\Main;
use App\Material;
use App\More_info;
use App\Personal_information;
use App\Photos;
use App\Position;
use App\Prepayment;
use App\Price_quality;
use App\Region;
use App\Repairs;
use App\Street;
use App\Territory;
use App\Type_flats;
use App\Type_house;
use App\Type_object;
use App\Type_pay;
use App\Video;



class AdministratorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    //ГЛАВНАЯ СТРАНИЦА
    public function index(){

        $city = City::where('status', 1)->get();
        $region = Region::where('status', 1)->get();
        $territory = Territory::where('status', 1)->get();
        $district = District::where('status', 1)->get();
        $type_object = Type_object::where('status', 1)->get();
        $material = Material::where('status', 1)->get();
        $repairs = Repairs::where('status', 1)->get();
        $lay_out = Lay_out::where('status', 1)->get();
        $position = Position::where('status', 1)->get();
        $documents = Documents::where('status', 1)->get();
        $type_pay = Type_pay::where('status', 1)->get();
        $more_info = More_info::where('status', 1)->get();
        $price_quality = Price_quality::where('status', 1)->get();
        $fill_info = Fill_info::where('status', 1)->get();



        return view('default.Administrator.home', [
            '$city' => $city,
            '$region' => $region,
            '$territory' => $territory,
            '$district' => $district,
            '$type_object' => $type_object,
            '$material' => $material,
            '$repairs' => $repairs,
            '$lay_out' => $lay_out,
            '$position' => $position,
            '$documents' => $documents,
            '$type_pay' => $type_pay,
            '$more_info' => $more_info,
            '$price_quality' => $price_quality,
            '$fill_info' => $fill_info,
        ]);
    }

}
