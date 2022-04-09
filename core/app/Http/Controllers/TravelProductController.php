<?php

namespace App\Http\Controllers;

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
    public function editOrCreate(Request $request,$id)
    {
        if ($id==0 && $request->tab!="Basic")
        {
            return redirect()->back()->with('errorMessage', "Please Create a Hotel first");
        }
        $data['product_id']=$id;
        if ($id!=0)
        {

            $data['travelProduct']=travelProduct::find($id);

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
}
