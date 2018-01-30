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

        $city = City::get_city();
        $region = Region::get_region();
        $territory = Territory::get_territory();
        $district = District::get_district();
        $type_object = Type_object::get_type_object();
        $material = Material::get_material();
        $repairs = Repairs::get_repairs();
        $lay_out = Lay_out::get_lay_out();
        $position = Position::get_position();
        $documents = Documents::get_documents();
        $type_pay = Type_pay::get_type_pay();
        $more_info = More_info::get_more_info();
        $price_quality = Price_quality::get_price_quality();
        $fill_info = Fill_info::get_fill_info();
        

        return view('default.Administrator.home', [
            'city' => $city,
            'region' => $region,
            'territory' => $territory,
            'district' => $district,
            'type_object' => $type_object,
            'material' => $material,
            'repairs' => $repairs,
            'lay_out' => $lay_out,
            'position' => $position,
            'documents' => $documents,
            'type_pay' => $type_pay,
            'more_info' => $more_info,
            'price_quality' => $price_quality,
            'fill_info' => $fill_info,
        ]);
    }

}
