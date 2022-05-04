<?php

namespace App\Http\Controllers;

use App\Models\hotel;
use App\Models\hotelRateTable;
use App\Models\myfile;
use App\Models\offer;

use App\Models\offerFlight;
use App\Models\offerHotel;
use App\Models\offerTour;
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
    public function updateTotalHotel(Request $request)
    {
        $offer=offer::find($request->offer_id);
        $offer->total_num_of_hotels=$request->total_num_of_hotels;
        $offer->save();
        return redirect()->back()->with('doneMessage', "Total number of hotels updated");
    }
    public function editOrCreate(Request $request,$id)
    {

        if ($id==0 && $request->tab!="Basic")
        {
            return redirect()->back()->with('errorMessage', "Please Create an Offer first");
        }

        $data['offer_id']=$id;
        $data['hotels']=[];
        $data['flights']=[];
        $data['tours']=[];
        $data['offer']=null;
        if ($id!=0)
        {
            $data['hotels']=offerHotel::where(['offer_id'=>$id,'deleted_at'=>null])->get();
            $data['flights']=offerFlight::where(['offer_id'=>$id,'deleted_at'=>null])->get();
            $data['tours']=offerTour::where(['offer_id'=>$id,'deleted_at'=>null])->get();
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
            'min_guest'=>'nullable|integer',
            'max_guest'=>'nullable|integer',
            'effective_date_start'=>'required',
            'effective_date_end'=>'required',
            'departure_date_start'=>'required',
            'departure_date_end'=>'required',
//            'booking_date_start'=>'required',
//            'booking_date_end'=>'required',
//            'sort_number'=>'required',
//            'markup_percentage'=>'required',
//            'markup_amount'=>'required',
//            'agent_commission'=>'required',
//            'commission_percentage'=>'required',
//            'commission_amount'=>'required',
//            'tag'=>'required',
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
            'code'=>'required|unique:offers',
            'type'=>'required',
            'min_guest'=>'nullable|integer',
            'max_guest'=>'nullable|integer',
            'effective_date_start'=>'required',
            'effective_date_end'=>'required',
            'departure_date_start'=>'required',
            'departure_date_end'=>'required',
//            'booking_date_start'=>'required',
//            'booking_date_end'=>'required',
//            'sort_number'=>'required',
//            'markup_percentage'=>'required',
//            'markup_amount'=>'required',
//            'agent_commission'=>'required',
//            'commission_percentage'=>'required',
//            'commission_amount'=>'required',
//            'tag'=>'required',
        ]);
        $data=$request->except(['_token']);
        $new= offer::create($data);
        myfile::where('type','offer')->where('item_id','temp')->update([
            'item_id'=>$new->id
        ]);
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
    public function UpdateHotelRateTableList(Request $request)
    {
        $data['list']=[];
        if ($request->id!='none')
        {
            $data['list']=hotelRateTable::where(['deleted_at'=>null,'hotel_id'=>$request->id])->get();

        }
        return view('dashboard.offer.hotelratetablelist',$data);
    }
    public function addHotel(Request $request)
    {

        $offer=offer::find($request->offer_id);
        if ($offer->type=="Hotel")
        {
//sasasas
            $request->validate([
                'rate_table_id'=>'required',
                'min_nights'=>'required|integer',
                'max_nights'=>'required|integer',
                'max_nights'=>'gt:min_nights'
            ],[
                'rate_table_id.required'=>"Hotel Table is required"
            ]);
            if (offerHotel::where(['offer_id'=>$offer->id,'deleted_at'=>null])->exists())
            {

                return  redirect()->back()->with(['errorMessage'=>"Sorry Can have only One Hotel With Offer Type `Hotel`"]);

            }
        }
        else
        {
            //asas
            $request->validate([
                'rate_table_id'=>'required',
                'hotel_group'=>'required',
                'nights'=>'required'
            ],[
                'rate_table_id.required'=>"Hotel Table is required"
            ]);
            if ($offer->total_num_of_hotels==offerHotel::where(['offer_id'=>$offer->id,'deleted_at'=>null])->get()->count())
            {
                return  redirect()->back()->with(['errorMessage'=>"You cannot add hotel more than total`"]);

            }
        }

        $ratetable=hotelRateTable::find($request->rate_table_id);


        if ($request->hotel_id=='none')
        {
            return redirect()->back()->with('doneMessage', "Please Select a Hotel First");
        }

        if ($ratetable->effective_end_date>$offer->departure_date_end || $ratetable->effective_start_date<$offer->departure_date_start)
        {

            return  redirect()->back()->with(['errorMessage'=>"Rate table effective dates should be between Departure Date of office"]);
        }

       $data=$request->except(['_token','tab']);
        if ($request->has('is_compulsory'))
        {
            $data['is_compulsory']='true';
        }

        offerHotel::create($data);


        return  redirect($request->redirectUrl)->with(['doneMessage'=>"Hotel has been Added"]);



    }
    public function removeHotel(Request $request,$id)
    {
        offerHotel::where('id',$id)->update([
            'deleted_at'=>Carbon::now()
        ]);
        return redirect()->back()->with('doneMessage', "Hotel has been Removed");
    }
    public function addFlight(Request $request)
    {
        $request->validate([
            'flight_route_type'=>'required',
            'arrival_airport'=>'required',
            'departure_airport'=>'required',
            'airline'=>'required',
            'class'=>'required'
        ]);

        $data=$request->except(['_token','tab']);


        offerFlight::create($data);


        return  redirect($request->redirectUrl)->with(['doneMessage'=>"Flight has been Added"]);



    }
    public function removeFlight(Request $request,$id)
    {
        offerFlight::where('id',$id)->update([
            'deleted_at'=>Carbon::now()
        ]);
        return redirect()->back()->with('doneMessage', "Flight has been Removed");
    }
    public function addTour(Request $request)
    {
        $request->validate([
            'tour_id'=>'required',
        ]);

        $data=$request->except(['_token','tab']);


        offerTour::create($data);


        return  redirect()->back()->with(['doneMessage'=>"Tour has been Added"]);

    }
    public function removeTour(Request $request)
    {
        offerTour::whereIn('id', $request->data)->update(['deleted_at'=>Carbon::now()]);

        if(Request::capture()->expectsJson())
        {
            return response()->json(['message'=>"Operation Successful"]);
        }
    }
}
