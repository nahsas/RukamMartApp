<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Unit;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public static function getUnitById(int $id){
        $res = Unit::where('id',$id)->first();

        return $res;
    }

    public static function tes(){
        $login_error = "";
        return view('users.login',compact('login_error'));
    }

    public function index()
    {
        if(session('LoggedIn') == null){
            return redirect(route('user.login'));
        }

        $items = Item::all();
        $i = 1;
        $brandname = Item::select('brand')->groupby('brand')->get();

        return view('items.index',compact(['items','i','brandname']));
    }

    public function search(Request $req){
        if($req['brand'] == 'N/A'){
            $items = Item::where('name','like','%'.$req['search'].'%')->orwhere('code','like',$req['search'].'%')->get();
        }else{
            $items = Item::where([['name','like','%'.$req['search'].'%'],['brand',$req['brand']]])->orwhere([['code','like',$req['search'].'%'],['brand',$req['brand']]])->get();
        }
        $i = 1;
        $brandname = Item::select('brand')->groupby('brand')->get();

        return view('items.index',compact(['items','i','brandname']));    
    }

    public function buy(){
        return view('items.buy');
    }

    public function proccessbuy(Request $req){

        $res = Item::where('code',$req['barcode'])->first();

        return $res;

    }

    public function add(){
        $error_text = "";

        return view('items.item',compact('error_text'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $barcode = $request['barcode'];
        $datenow = date('Y-m-d');
        $units = Unit::all();
        $check = Item::where('code',$request['barcode'])->first();
        $error_text = "";

        if(!empty($barcode)){
            if($check != null){
                $error_text = "Item already added";
                return view('items.item',compact(['error_text']));
            }
            return view('items.itemAdd',compact(['barcode','datenow','units','error_text']));
        }

        return "Please scan the product barcode";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "barcode"=>"required",
            "itemName"=>"required",
            "brand"=>"required",
            "stock"=>"required",
            "price"=>"required",
            "unit"=>"required",
            "price"=>"required",
            "discount"=>"required"
        ]);

        $total = $request['stock'] * $request['price'];
        $unit = Unit::where('name',$request['unit'])->first();

        Item::create([
            "code"=>$request['barcode'],
            "name"=>$request['itemName'],
            "brand"=>$request['brand'],
            "stock"=>$request['stock'],
            "price"=>$request['price'],
            "unitId"=>$unit['id'],
            "discount"=>$request['discount'],
            "total"=>$total,
        ]);

        return redirect(route('item.index'));
    }

    public function destroy(int $id){
        $removeitem = Item::findorfail($id);

        $removeitem->delete();

        return redirect(route('item.index'));
    }

    public function edit(string $barcode){
        $datenow = date('Y-m-d');
        $units = Unit::all();
        $item = Item::where('code',$barcode)->first();

        return view('items.itemEdit',compact(['datenow','barcode','units','item']));
    }

    public function update(Request $request, int $id){
        $cutprice = ($request['stock'] * $request['price']) * $request['discount'] / 100;
        $total = ($request['stock'] * $request['price']) - $cutprice;
        $unit = Unit::where('name',$request['unit'])->first();
        $item = Item::findorfail($id);

        $item->update([
            "code"=>$request['barcode'],
            "name"=>$request['itemName'],
            "brand"=>$request['brand'],
            "stock"=>$request['stock'],
            "price"=>$request['price'],
            "unitId"=>$unit['id'],
            "discount"=>$request['discount'],
            "total"=>$total,
        ]);
        return redirect(route('item.index'));

    }
}
