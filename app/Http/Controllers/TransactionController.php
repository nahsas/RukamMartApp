<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Item;
use App\Models\ItemSold;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(){
        $datas = Transaction::where('cashierId',session('userId'))->orderby('id','desc')->get();
        return view('transactions.index',compact('datas'));
    }

    public function makeTransaction()
    {   
        Transaction::create([
            "cashierId"=>session('userId'),
            "success"=>0,
            "transaction_date"=>date("Y-m-d"),
            "total"=>0,
            "moneyPaid"=>0
        ]);
        $latestTransaction = Transaction::latest()->first();

        return redirect(route("transaction.start",$latestTransaction??['id']));
    }

    public $error = "";
    public function startTransaction(int $id){
        $transactionId = $id;
        $datenow = date("Y-m-d");
        $items = ItemSold::where([['transactionId',$transactionId]])->get();
        $i = 1;

        return view("transactions.transaction",compact(['datenow',"transactionId","items",'i']))->with(['error'=>$this->error]);        
    }

    public static function getItem($code){
        $res = Item::where('code',$code)->first();
        return $res;
    }

    public function add(Request $req){
        $datenow = date("Y-m-d");
        $res = Item::where('code','like',$req['barcode'].'%')->orwhere('name','like','%'.$req['barcode'].'%')->first();
        $transactionId = $req['transactionId'];
        $items = ItemSold::where('transactionId',$transactionId)->get();

        if($res != null){            
            $res->update([
                "stock"=>$res['stock']-1
            ]);

            ItemSold::create([
                "transactionId" => $transactionId,
                "productCode" => $res['code'],
                "isPaid"=>0,
            ]);
        }

        $item = Item::where('code','like',$req['barcode'].'%')->orwhere('name','like','%'.$req['barcode'].'%')->first();
        return redirect(route("transaction.start",$transactionId));
    }

    public static function transactionStatus(int $id){
        if($id == 0){
            return "UnComplete";
        }else{
            return "Complete";
        }
    }

    public function history(int $id){
        $transaction = Transaction::where('id',$id)->first();
        $datenow = $transaction['transaction_date'];
        $transactionId = $transaction['id'];
        $items = ItemSold::where([['transactionId',$id]])->get();
        $i=1;

        return view('transactions.history',compact(['items','datenow','transactionId','i']));
    }

    public function destroy(int $transactionId,int $id,Request $req)
    {
        $res = Item::where('code',$req['barcode'])->first();
        $delete = ItemSold::findorfail($id);

        $res->update([
            "stock"=>$res['stock']+1
        ]);

        $delete->delete();

        return redirect(route("transaction.start",$transactionId));
    }

    public function pay(int $id, Request $req){
        $total = $req['total'];
        $pay = $req['pay'];

        if($total >= $pay){
            return "Kurang";
        }else{
            return "anjayy";
        }
    }
}
