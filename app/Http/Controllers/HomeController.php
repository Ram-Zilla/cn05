<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;
use DB;
use Carbon\Carbon;
use App\Product;
use App\Material;
use File;

class HomeController extends Controller
{


//ГЛАВНАЯ СТРАНИЦА
    public function index(){
        
        return view('default.user.home');
    }














//ОТКРЫТИЕ ОТДЕЛЬНО ВЫБРАННОЙ ПРОДУКЦИИ
    public function open_product($id){
        $material = Material::where('status', 1)->get();
        $category = Category::where('status', 1)->get();
        $product = Product::where('id', $id)->get();
        $gallery_product = Gallery_product::where('id_product', $id)->where('status', 1)->get();
        //if($massage) { $massage_new = $massage; } else { $massage_new = null; }

        return view('default.user.open_product', [
            'material' => $material,
            'category' => $category,
            'product' => $product,
            'gallery_product' => $gallery_product,
            'id' => $id,
            //'massage' => $massage_new
        ]);
    }


//ОТКРЫТИЕ ОТДЕЛЬНО ВЫБРАННОЙ КАТЕГОРИИ ПРОДУКЦИИ
    public function open_product_category($id){

        $material = Material::where('status', 1)->get();
        $category = Category::where('status', 1)->get();
        $products = Product::where('status', 1)->where('id_category', $id)->paginate(8);

        return view('default.user.production', [
            'material' => $material,
            'category' => $category,
            'products' => $products,
        ]);
    }


//ЗАЯВКА ДЛЯ БОТА В ТЕЛЕГРАМ
    public function bot(Request $request){

        $this->validate($request, [
            'fio' => 'required',
            'phone' => 'required'
        ]);

        $fio = $request->fio;
        $phone = $request->phone;
        $product = $request->product;
        $id_product = $request->id_product;

        // *******telegram bot  https://api.telegram.org/bot472181491:AAFsHJptC8NtcBS_TENEQRPCIUR6n_NE9hA/getUpdates
        $bot_token = '472181491:AAFsHJptC8NtcBS_TENEQRPCIUR6n_NE9hA';
        //$bot_chat_id = '121975392';
        $bot_chat_id = '108986028';
        //$link = "http://istambul/public/uploads/kFCNpEyygfnjxgN4wjzjCIck0r4FWj.jpg";

        $bot_text = "ЗАЯВКА!\n".
            "Продукт: ".$product."\n\n".
            "ФИО: ".$fio."\n".
            "Телефон: ".$phone."\n";
        file("https://api.telegram.org/bot" . $bot_token .
            "/sendMessage?chat_id=" .
            $bot_chat_id .
            "&text=" .
            urlencode($bot_text) );
        // *********telegram bot end

        return redirect("Production/$id_product")->with('massage', 'Заявка успешно отправлена!');

    }



}
