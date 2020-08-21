<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class APIProductController extends Controller
{
    //
    function getProduct(){
      $p=Product::all();
      return response()->json($p,200);
    }

    function addProduct(Request $req){
       $p=new Product();
       $p->name=$req->name;
       $p->description=$req->description;
       $p->price=$req->price;
       $p->image='http://127.0.0.1:8000/'.$this->createImage($req->image,'storage/public/');
       $p->save();
       return response()->json('added',200);
    }

    function deleteProduct(Request $req){
        Product::find($req->id)->delete();
        return response()->json('deleted',200);
    }

    function updateProduct(Request $req){
        $p=Product::find($req->id);
        $p->name=$req->name;
        $p->description=$req->description;
        $p->price=$req->price;
        $p->image=$this->createImage($req->image,'storage/public/');
        $p->save();
        return response()->json('updated',200);
    }

    public function createImage($img,$folderPath)
    {
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $folderPath . uniqid() . '. '.'png';
        file_put_contents($file, $image_base64);
        return $file;
    }
}
