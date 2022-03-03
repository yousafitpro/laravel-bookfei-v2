<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\area;
use App\Models\hotel;
use App\Models\hotelRateTable;
use App\Models\hotelRoomType;
use App\Models\tour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HotelRateTableController extends Controller
{
    private $uploadPath = "uploads/hotel-rate-table";
    private $title = "Hotel Rate Table";
    public function __construct()
    {
        view()->share('title',$this->title);
    }
    public function list(Request $request,$id)
    {
        $list=hotelRateTable::where("deleted_at",null);
        if($request->has("status"))
        {
            $list=$list->where('status',$request->status);
        }
        $list=$list->get();
        return view('dashboard.hotel.rate-table')->with(['list'=>$list]);
    }
    public function delete($id)
    {
        $city=hotelRateTable::find($id);
        $city->deleted_at=Carbon::now();
        if($city->save())
        {
            return redirect()->back()->with('doneMessage', __('backend.deleteDone'));
        }
    }
    public function update(Request $request,$id)
    {



        $this->validate($request, [
            'effective_end_date' => 'after_or_equal:effective_start_date'
        ]);
        $data=$request->except(['file','_token']);

        if (!$request->has("early_bird"))
        {

            $data['early_bird']=0;

        }
        else
        {
            $data['early_bird']=1;
        }
        if (!$request->has("bonus_night"))
        {

            $data['bonus_night']=0;

        }
        else
        {
            $data['bonus_night']=1;
        }


        $city= hotelRateTable::where('id',$id)->update($data);

        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            Storage::disk('public')->delete($city->image);
            $path = $request->file('file')->storeAs($this->uploadPath,$city->id.'.'.$extension);

            $city->image= $path;

            $city->save();
        }
        return redirect()->back()->with('doneMessage', __('backend.updateDone'));
    }
    public function editOrCreate(Request $request,$id)
    {
        if ($id==0 && $request->tab!="Basic")
        {
            return redirect()->back()->with('errorMessage', "Please Create a Hotel first");
        }
        $data['hotel_id']=$id;
        $data['table_id']=$_GET['table_id'];
        if ($id!=0)
        {
            $data['rateTables']=hotelRateTable::where("deleted_at",null)->get();
            $data['roomTypes']=hotelRoomType::where("deleted_at",null)->where("hotel_id",$id)->get();
            $data['hotel']=hotel::find($id);
            $data['table']=hotelRateTable::find($_GET['table_id']);
        }


        return view('dashboard.hotel.rate-table-tabs',$data);
    }
    public function create(Request $request)
    {

        $this->validate($request, [
            'effective_end_date' => 'after_or_equal:effective_start_date'
        ]);
        $data=$request->except('file');

        if (!$request->has("early_bird"))
        {

            $data['early_bird']=0;

        }
        else
        {
            $data['early_bird']=1;
        }
        if (!$request->has("bonus_night"))
        {

            $data['bonus_night']=0;

        }
        else
        {
            $data['bonus_night']=1;
        }

        $city= hotelRateTable::create($data);

        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            Storage::disk('public')->delete($city->image);
            $path = $request->file('file')->storeAs($this->uploadPath,$city->id.'.'.$extension);

            $city->image= $path;

            $city->save();
        }
        return redirect(route('admin.hotelRateTable.editOrCreate',$city->id).'?tab=RoomType')->with('doneMessage', __('backend.addDone'));

    }
}
