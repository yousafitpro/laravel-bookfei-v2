<?php

namespace App\Http\Controllers;

use App\Models\offer;

use App\Models\travelProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OfferController extends Controller
{
    private $uploadPath = "uploads/offers";
    private $title = "Offers";
    public function __construct()
    {
        view()->share('title',$this->title);
    }
    public function list(Request $request)
    {
        $list=offer::where("deleted_at",null);
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
        if ($request->has('searchTag') && $request->searchCategory!="none")
        {
            $list=$list->where('tag', 'LIKE',"%{$request->searchCategory}%");

            Session::put('searchTag',$request->searchCategory);
        }
        else
        {
            Session::put('searchTag','none');
        }
//        if ($request->has('searchDestination') && $request->searchDestination!="none")
//        {
//            $list=$list->where('destination', 'LIKE',"%{$request->searchDestination}%");
//
//            Session::put('searchDestination',$request->searchDestination);
//        }
//        else
//        {
//            Session::put('searchDestination','none');
//        }
        $list=$list->get();

        return view('dashboard.offer.list')->with(['list'=>$list]);
    }
    public function editOrCreate(Request $request,$id)
    {
        if ($id==0 && $request->tab!="Basic")
        {
            return redirect()->back()->with('errorMessage', "Please Create a Hotel first");
        }
        $data['offer_id']=$id;
        if ($id!=0)
        {

            $data['offer']=offer::find($id);

        }


        return view('dashboard.offer.tabs',$data);

    }
    public function delete($id)
    {
        $city=offer::find($id);
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
            'min_guest'=>'required',
            'max_guest'=>'required',
            'effective_date_start'=>'required',
            'effective_date_end'=>'required',
            'departure_date_start'=>'required',
            'departure_date_end'=>'required',
            'booking_date_start'=>'required',
            'booking_date_end'=>'required',
            'sort_number'=>'required',
            'markup_percentage'=>'required',
            'markup_amount'=>'required',
            'agent_commission'=>'required',
            'commission_percentage'=>'required',
            'commission_amount'=>'required',
            'tag'=>'required',
        ]);
        $data=$request->except(['_token','redirectUrl']);
        $new= offer::where('id',$id)->update($data);

        if ($request->redirectUrl=='')
        {
            return redirect(route('admin.offer.editOrCreate',$id).'?tab=Basic')->with('doneMessage', __('backend.addDone'));
        }
        return redirect($request->redirectUrl);
    }
    public function create(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'code'=>'required',
            'type'=>'required',
            'min_guest'=>'required',
            'max_guest'=>'required',
            'effective_date_start'=>'required',
            'effective_date_end'=>'required',
            'departure_date_start'=>'required',
            'departure_date_end'=>'required',
            'booking_date_start'=>'required',
            'booking_date_end'=>'required',
            'sort_number'=>'required',
            'markup_percentage'=>'required',
            'markup_amount'=>'required',
            'agent_commission'=>'required',
            'commission_percentage'=>'required',
            'commission_amount'=>'required',
            'tag'=>'required',
        ]);
        $data=$request->except(['_token']);
        $new= offer::create($data);
        if ($request->redirectUrl=='')
        {
            return redirect(route('admin.offer.editOrCreate',$new->id).'?tab=Basic')->with('doneMessage', __('backend.addDone'));
        }
        return redirect($request->redirectUrl);
    }
    public function deleteBulk(Request $request)
    {
        offer::whereIn('id', $request->data)->update(['deleted_at'=>Carbon::now()]);

        if(Request::capture()->expectsJson())
        {
            return response()->json(['message'=>"Operation Successful"]);
        }
    }
}
