<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use DB;
use Carbon\Carbon;
use App\Product;
use App\Material;
use App\Category;
use App\Gallery_product;
use File;


class EditorController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

//ГЛАВНАЯ СТРАНИЦА
    public function index(){

        return view('default.Administrator.home');
    }


//СТРАНИЦА О НАС
    public function about(){
        $gallery_about = Gallery_about::where('status', 1)->get();

        return view('default.Administrator.about', [
            'gallery_about' => $gallery_about
        ]);
    }


//СТРАНИЦА СО СПИСКОМ ВИДОВ ПРОДУКЦИИ
    public function production(){

        $material = Material::where('status', 1)->get();
        $category = Category::where('status', 1)->get();
        $products = Product::where('status', 1)->paginate(8);

        return view('default.Administrator.production', [
            'material' => $material,
            'category' => $category,
            'products' => $products,
        ]);
    }


//ЗАПРОС НА ДОБАВЛЕНИЕ УДАЛЕНИЕ НОВОГО ПРОДУКТА, МАТЕРИАЛА, КАТЕГОРИИ, ФОТОГРАФИИ
    public function add_product(Request $request){

        $date = Carbon::now();
        $date_now = ($date->addHours(3));

    //Добавление материала
        if($request->add_material){
            $this->validate($request, [
                'name' => 'required'
            ]);

            $material = new Material();
                $material->name = $request->name;
                $material->status = 1;
            $material->save();
        }
    //Редактирование названии материала
        if($request->material_edit){
            $id_name_edit_input = $request->material_edit;
            if($request->$id_name_edit_input != null){
                $id = $request->material_edit;
                $edit_material = Material::find($id);
                $edit_material->name = $request->$id_name_edit_input;
                $edit_material->save();
            }
        }
    //Удаление материала
        if($request->material_del){
            $id = $request->material_del;
            $del_material = Material::find($id);
                $del_material->status = 0;
            $del_material->save();
        }


    //Добавление категории
        if($request->add_category){
            $this->validate($request, [
                'name' => 'required'
            ]);

            $category = new Category();
                $category->name = $request->name;
                $category->status = 1;
            $category->save();
        }
    //Редактирование названии категории
        if($request->category_edit){
            $id_name_edit_input = $request->category_edit;
            if($request->$id_name_edit_input != null){
                $id = $request->category_edit;
                $edit_category = Category::find($id);
                    $edit_category->name = $request->$id_name_edit_input;
                $edit_category->save();
            }
        }
    //Удаление категории
        if($request->category_del){
            $id = $request->category_del;
            $del_category = Category::find($id);
                $del_category->status = 0;
            $del_category->save();
        }


    //Добавление продукта
        if($request->add_product){
            $this->validate($request, [
                'name' => 'required',
                'price' => 'required',
                'size' => 'required',
                'guarantees' => 'required',
                'description' => 'required',
            ]);

            $product = new Product();
                $product->name = $request->name;
                $product->description = $request->description;
                $product->id_material = $request->list_material;
                $product->id_category = $request->list_category;
                $product->price = $request->price;
                $product->size = $request->size;
                $product->guarantees = $request->guarantees;
                $product->status = 1;
                $product->date = $date_now;
                if($request->popular) $product->popular = 1 ;
                if($request->recommended) $product->recommended = 1;

                if ($request->file('image')) {
                    $dir = '/uploads/';
                    do {
                        $filename = str_random(30).'.jpg';
                    } while (File::exists(public_path().$dir.$filename));
                    $request->file('image')->move(public_path().$dir, $filename);
                    $product->photo = $dir.$filename;
                        $product->save();
                }
        }
    //Редактирование продукта
        if($request->edit_product){
            $this->validate($request, [
                'name' => 'required',
                'price' => 'required',
                'size' => 'required',
                'guarantees' => 'required',
                'description' => 'required',
            ]);
            $id_product = $request->id_product;

            $product = Product::find($id_product);
                $product->name = $request->name;
                $product->description = $request->description;
                $product->id_material = $request->list_material;
                $product->id_category = $request->list_category;
                $product->price = $request->price;
                $product->size = $request->size;
                $product->guarantees = $request->guarantees;
                ($request->popular) ? $product->popular = 1 : $product->popular = 0;
                ($request->recommended) ? $product->recommended = 1 : $product->recommended = 0;

                if ($request->file('image')) {
                    $dir = '/uploads/';
                    do {
                        $filename = str_random(30).'.jpg';
                    } while (File::exists(public_path().$dir.$filename));
                    $request->file('image')->move(public_path().$dir, $filename);
                    $product->photo = $dir.$filename;
                }
            $product->save();

            return redirect("Edit/Production/$id_product");
        }
    //Удаление продукта
        if($request->del_product){
            $id_product = $request->id_product;
            $product = Product::find($id_product);
                $product->status = 0;
            $product->save();
        }


    //Добавление фотографии в галерею
        if($request->add_photo){
            $gallery_product = new Gallery_product();
            $gallery_product->status = 1;
            $id_product = $request->id_product;

            if ($request->file('image_gallery')) {
                $dir = '/uploads/';
                do {
                    $filename = str_random(30).'.jpg';
                } while (File::exists(public_path().$dir.$filename));
                $request->file('image_gallery')->move(public_path().$dir, $filename);
                    $gallery_product->photo = $dir.$filename;
                    $gallery_product->id_product = $id_product;
                $gallery_product->save();
            }
            return redirect("Edit/Production/$id_product");
        }

    //Удаление фотографии из галереии
        if($request->del_photo){
            $id_product = $request->id_product;

            $gallery_product = Gallery_product::find($id_product);
                $gallery_product->status = 0;
            $gallery_product->save();

            return redirect("Edit/Production/$id_product");
        }


        return redirect("Edit/Production");

    }


//ФУНКЦИЯ ДЛЯ ОТОБРАЖЕНИЯ ОТДЕЛЬНО ВЫБРАННОГО ПРОДУКТА
    public function open_product($id){
        $material = Material::where('status', 1)->get();
        $category = Category::where('status', 1)->get();
        $product = Product::where('id', $id)->get();
        $gallery_product = Gallery_product::where('id_product', $id)->where('status', 1)->get();

        return view('default.Administrator.open_product', [
            'material' => $material,
            'category' => $category,
            'product' => $product,
            'gallery_product' => $gallery_product,
            'id' => $id
        ]);
    }



}
