<?php

namespace App\Http\Controllers;

use App\Models\myfile;
use App\Models\offer;
use App\Models\travel_product_offer;
use App\Models\travelProduct;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class TravelProductController extends Controller
{
    private $uploadPath = "uploads/travelProducts";
    private $title = "travelProducts";
    public function __construct()
    {
        view()->share('title',$this->title);
    }
    public function list(Request $request)
    {
        $list=travelProduct::where("deleted_at",null);
        if($request->has("status"))
        {
            $list=$list->where('status',$request->status);
        }
        if ($request->has('searchWord') && $request->searchWord!="")
        {
            $list=$list->where('name', 'LIKE',"%{$request->searchWord}%");
            Session::put('searchWord',$request->searchWord);
        }
        else
        {
            Session::put('searchWord','');
        }
        if ($request->has('searchCode') && $request->searchCode!="")
        {
            $list=$list->where('code', 'LIKE',"%{$request->searchCode}%");
            Session::put('searchCode',$request->searchCode);
        }
        else
        {
            Session::put('searchCode','');
        }
        if ($request->has('searchType') && $request->searchType!="none")
        {
            $list=$list->where('type',$request->searchType);
            Session::put('searchType',$request->searchType);
        }
        else
        {
            Session::put('searchType','none');
        }
        if ($request->has('searchCategory') && $request->searchCategory!="none")
        {
            $list=$list->where('category', 'LIKE',"%{$request->searchCategory}%");

            Session::put('searchCategory',$request->searchCategory);
        }
        else
        {
            Session::put('searchCategory','none');
        }
        if ($request->has('searchDestination') && $request->searchDestination!="none")
        {
            $list=$list->where('destination', 'LIKE',"%{$request->searchDestination}%");

            Session::put('searchDestination',$request->searchDestination);
        }
        else
        {
            Session::put('searchDestination','none');
        }
        $list=$list->get();

        return view('dashboard.travel_product.list')->with(['list'=>$list]);
    }
    public function clear_filter()
    {
        Session::put('searchWord','');
        Session::put('searchCategory','none');
        Session::put('searchDestination','none');
        Session::put('searchType','none');
        Session::put('searchCode','');
        return redirect(url('admin/travel-product/list'));
    }
    public function editOrCreate(Request $request,$id)
    {
        if ($id==0 && $request->tab!="Basic")
        {
            return redirect()->back()->with('errorMessage', "Please Create a Hotel first");
        }
        $data['product_id']=$id;
        $data['offers']=[];
        $data['oldoffers']=[];
        if ($id!=0)
        {

            $data['travelProduct']=travelProduct::find($id);
            $data['offers']=travel_product_offer::where(['deleted_at'=>null,'travel_product_id'=>$id])->get();
            $data['oldoffers']=offer::where(['deleted_at'=>null])->get();
        }


        return view('dashboard.travel_product.tabs',$data);

    }
    public function delete($id)
    {
        $city=travelProduct::find($id);
        $city->deleted_at=Carbon::now();
        if($city->save())
        {
            return redirect()->back()->with('doneMessage', __('backend.deleteDone'));
        }
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'name'=>'required',
            'code'=>'required',
            'type'=>'required',
            'effective_date_start'=>'required',
            'effective_date_end'=>'required',
            'sort_type'=>'required',
            'sort_number'=>'required',
            'category'=>'required',
            'destination'=>'required',
        ]);
        $data=$request->except(['_token','redirectUrl']);

        $city=travelProduct::where('id',$id)->update($data);
        if ($request->redirectUrl=='')
        {
            return redirect(route('admin.travel_product.editOrCreate',$id).'?tab=Basic')->with('doneMessage', __('backend.addDone'));
        }
        return redirect($request->redirectUrl);
    }
    public function create(Request $request)
    {

        $request->validate([
           'name'=>'required',
            'code'=>'required',
            'type'=>'required',
            'effective_date_start'=>'required',
            'effective_date_end'=>'required',
            'sort_type'=>'required',
            'sort_number'=>'required',
            'category'=>'required',
            'destination'=>'required',
        ]);
        $data=$request->except(['_token']);
        $new= travelProduct::create($data);
        myfile::where('type','travel_product')->where('item_id','temp')->update([
            'item_id'=>$new->id
        ]);
        if ($request->redirectUrl=='')
        {
        return redirect(route('admin.travel_product.editOrCreate',$new->id).'?tab=Basic')->with('doneMessage', __('backend.addDone'));
    }
return redirect($request->redirectUrl);

    }
    public function deleteBulk(Request $request)
    {
        travelProduct::whereIn('id', $request->data)->update(['deleted_at'=>Carbon::now()]);

        if(Request::capture()->expectsJson())
        {
            return response()->json(['message'=>"Operation Successful"]);
        }
    }
    public function addOffer(Request $request)
    {

        if (travel_product_offer::where(['travel_product_id'=>$request->travel_product_id,'offer_id'=>$request->offer_id,'deleted_at'=>null])->exists())
        {
            return response()->json(['message'=>"Offer Already Added",'code'=>'0']);
        }
        $data=$request->except(['_token']);
            travel_product_offer::create($data);
        return response()->json(['message'=>"Operation Successful",'code'=>'1']);

    }
    public function deleteOffers(Request $request)
    {
        travel_product_offer::whereIn('id', $request->data)->update(['deleted_at'=>Carbon::now()]);

        if(Request::capture()->expectsJson())
        {
            return response()->json(['message'=>"Operation Successful"]);
        }
    }
}
