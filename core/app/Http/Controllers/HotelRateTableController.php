<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\area;
use App\Models\hotel;
use App\Models\hotelRateTable;
use App\Models\hotelRateTableRoomType;
use App\Models\hotelRoomRate;
use App\Models\hotelRoomType;
use App\Models\tour;
use App\Models\tourRate;
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
    public function deleteBulk(Request $request)
    {
        hotelRateTable::whereIn('id', $request->data)->update(['deleted_at'=>Carbon::now()]);

        if(Request::capture()->expectsJson())
        {
            return response()->json(['message'=>"Operation Successful"]);
        }
    }
    public function cloneBulk(Request $request)
    {
        foreach ($request->data as $d)
        {
          $tb= hotelRateTable::find($d);
          $ntb=$tb->replicate();
            $ntb->created_at = Carbon::now();
            $ntb->save();
            $roomTypes=hotelRateTableRoomType::where('hotel_rate_table_id',$tb->id)->get();
            foreach ($roomTypes as $rt)
            {
                $nrt=$rt->replicate();
                $nrt->hotel_rate_table_id=$ntb->id;
                $nrt->created_at = Carbon::now();
                $nrt->save();
               $rtr= hotelRoomRate::where('hotel_room_type_id',$rt->id)->get();
               foreach ($rtr as $i)
               {
                   $i2=$i->replicate();
                   $i2->hotel_room_type_id=$nrt->id;
                   $i2->save();
               }

            }


        }

        if(Request::capture()->expectsJson())
        {
            return response()->json(['message'=>"Operation Successful"]);
        }
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
            'effective_end_date' => 'after_or_equal:effective_start_date',

        ]);
        if (hotelRateTable::where('id','!=',$id)->where('code',$request->code)->exists())
        {
            return redirect()->back()->with('errorMessage', 'Code Already Existed');
        }
        $data=$request->except(['file','_token','redirectUrl']);

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
//        $roomTypes=hotelRoomType::where('hotel_rate_table_id',$id)->get();
//        foreach ($roomTypes as $rt)
//        {
//            HotelRoomTypeController::checkRoomRates($id,$rt->id);
//        }

        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            Storage::disk('public')->delete($city->image);
            $path = $request->file('file')->storeAs($this->uploadPath,$city->id.'.'.$extension);

            $city->image= $path;

            $city->save();
        }
        if ($request->redirectUrl=='')
        {
            return redirect()->back()->with('doneMessage', __('backend.updateDone'));
        }
        return redirect($request->redirectUrl);
//        return redirect()->back()->with('doneMessage', __('backend.updateDone'));
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
            $data['roomTypes']=hotelRateTableRoomType::where("deleted_at",null)->where("hotel_rate_table_id",$request->table_id)->get();
            $data['hotel']=hotel::find($id);
            $data['table']=hotelRateTable::find($_GET['table_id']);
        }
foreach ($data['roomTypes'] as $i)
{
    $i->roomType=hotelRoomType::find($i->hotel_room_type_id);
}

        return view('dashboard.hotel.rate-table-tabs',$data);
    }
    public function create(Request $request)
    {

        $this->validate($request, [
            'effective_end_date' => 'after_or_equal:effective_start_date',
            'code'=>'unique:hotel_rate_tables,code'
        ]);
        $data=$request->except('file','redirectUrl');

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
        $roomTypes=hotelRoomType::where(['hotel_id'=>$request->hotel_id])->get();
        foreach ($roomTypes as $i)
        {
              hotelRateTableRoomType::create([
                  'user_id'=>auth()->user()->id,
                  'hotel_rate_table_id'=>$city->id,
                  'hotel_room_type_id'=>$i->id
              ]);
        }

        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            Storage::disk('public')->delete($city->image);
            $path = $request->file('file')->storeAs($this->uploadPath,$city->id.'.'.$extension);

            $city->image= $path;

            $city->save();
        }
        if ($request->redirectUrl=='')
        {
            return redirect(route('admin.hotelRateTable.editOrCreate',$request->hotel_id).'?tab=RoomType&table_id='.$city->id)->with('doneMessage', __('backend.addDone'));

        }
        return redirect($request->redirectUrl);
//        return redirect(route('admin.hotelRateTable.editOrCreate',$request->hotel_id).'?tab=RoomType&table_id='.$city->id)->with('doneMessage', __('backend.addDone'));

    }
    public function toggle(Request $request,$id)
    {
        $t=hotelRoomRate::find($id);
        if ($t->is_disabled)
        {
            $t->is_disabled=false;
        }
        else
        {
            $t->is_disabled=true;
        }
        $t->save();

        return "ok";

    }
    public function updateColumn(Request $request,$id)
    {
        if ($request->column=="room_price" && $request->val=="")
        {
            hotelRoomRate::where('id',$id)->update([
                $request->column=>$request->val,
                'is_disabled'=>false

            ]);
        }
        if ($request->column=="room_price" && $request->val!="")
        {
            hotelRoomRate::where('id',$id)->update([
                $request->column=>$request->val,
                'is_disabled'=>true

            ]);
        }

        $t=hotelRoomRate::where('id',$id)->update([$request->column=>$request->val]);
    }
}
