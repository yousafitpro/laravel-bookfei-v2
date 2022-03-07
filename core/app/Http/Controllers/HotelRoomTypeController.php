<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\area;
use App\Models\hotel;
use App\Models\hotelRateTable;
use App\Models\hotelRoomRate;
use App\Models\hotelRoomType;
use App\Models\myfile;
use App\Models\tour;
use App\Models\tourRate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HotelRoomTypeController extends Controller
{
    private $uploadPath = "uploads/rooms";
    private $title = "Hotel Rooms";
    public function __construct()
    {
        view()->share('title',$this->title);
    }
    public function list(Request $request,$id)
    {
        $list=hotelRoomType::where("deleted_at",null)->where("hotel_id",$id);
        if($request->has("status"))
        {
            $list=$list->where('status',$request->status);
        }
        $list=$list->get();
        return view('dashboard.hotel-room.list')->with(['list'=>$list,'id'=>$id,'NBanner'=>hotel::find($id)]);
    }
    public function delete($id)
    {
        $city=hotelRoomType::find($id);
        $city->deleted_at=Carbon::now();
        if($city->save())
        {
            return redirect()->back()->with('doneMessage', __('backend.deleteDone'));
        }
    }
    public function updateView($id)
    {

        $data['Banner']=hotelRoomType::find($id);
        $data['hotel']=hotel::find($data['Banner']->hotel_id);
        return view('dashboard.hotel-room.edit',$data);
    }
    public function createView($id)
    {
        $data['hotel']=hotel::find($id);
        return view('dashboard.hotel-room.add',$data);
    }
    public function update(Request $request,$id)
    {

        $this->validate($request, [
            'effective_end_date' => 'after_or_equal:effective_start_date'
        ]);
        $data=$request->except(['file','_token','myImage']);


        if (!$request->has("is_adult"))
        {

            $data['is_adult']=0;

        }
        else
        {
            $data['is_adult']=1;
        }
        if (!$request->has("is_child"))
        {

            $data['is_child']=0;

        }
        else
        {
            $data['is_child']=1;
        }
        if (!$request->has("is_toddler"))
        {

            $data['is_toddler']=0;

        }
        else
        {
            $data['is_toddler']=1;
        }
        if (!$request->has("is_infant"))
        {

            $data['is_infant']=0;

        }
        else
        {
            $data['is_infant']=1;
        }
        if (!$request->has("is_senior"))
        {

            $data['is_senior']=0;

        }
        else
        {
            $data['is_senior']=1;
        }

        hotelRoomType::where('id',$id)->update($data);

        return redirect(route('admin.hotel.editOrCreate',hotelRoomType::find($id)->hotel_id).'?tab=RoomType')->with('doneMessage', __('backend.updateDone'));
    }
    public function create(Request $request)
    {
        ///asdasd

        $this->validate($request, [
            'effective_end_date' => 'after_or_equal:effective_start_date',
            'max_guest' => 'required|gt:default_guest'
        ]);
        $data=$request->except(['file','_token','myImage']);

        if (!$request->has("early_bird"))
        {

            $data['early_bird']=0;

        }
        else
        {
            $data['early_bird']=1;
        }
        if (!$request->has("is_adult"))
        {

            $data['is_adult']=0;

        }
        else
        {
            $data['is_adult']=1;
        }
        if (!$request->has("is_child"))
        {

            $data['is_child']=0;

        }
        else
        {
            $data['is_child']=1;
        }
        if (!$request->has("is_toddler"))
        {

            $data['is_toddler']=0;

        }
        else
        {
            $data['is_toddler']=1;
        }
        if (!$request->has("is_infant"))
        {

            $data['is_infant']=0;

        }
        else
        {
            $data['is_infant']=1;
        }
        if (!$request->has("is_senior"))
        {

            $data['is_senior']=0;

        }
        else
        {
            $data['is_senior']=1;
        }

        $city= hotelRoomType::create($data);
        myfile::where('type','roomType')->where('item_id','temp')->update([
            'item_id'=>$city->id
        ]);
        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            Storage::disk('public')->delete($city->image);
            $path = $request->file('file')->storeAs($this->uploadPath,$city->id.'.'.$extension);

            $city->image= $path;

            $city->save();
        }

        return redirect(route('admin.hotel.editOrCreate',$request->hotel_id).'?tab=RoomType')->with('doneMessage', __('backend.updateDone'));

    }
    public function createLink(Request $request,$id,$table_id)
    {

        hotelRoomType::where('id',$id)->update(['hotel_rate_table_id'=>$table_id]);
        return redirect(route('admin.hotelRoom.rateTable',$id));
    }
    public function rateTable(Request $request,$id)
    {
        $list=hotelRoomRate::where("deleted_at",null);
        $roomType=hotelRoomType::find($id);
        $hotel=hotel::find($roomType->hotel_id);
        $rateTable=hotelRateTable::find($roomType->hotel_rate_table_id);
        if ($request->has("month"))
        {

            $date=Carbon::parse($request->month);
            $list=$list->whereMonth('created_at',$date->month)->whereYear('created_at',$date->year);

        }
        $list=$list->where('hotel_room_type_id',$id);
        if($request->has("status"))
        {
            $list=$list->where('status',$request->status);
        }
        $list2=$list;

//        $days=$list->select('day')->get()->unique('day');
        $list=$list->orderBy('date')->get();
        foreach ($list as $l)
        {
            $l->day_name=Carbon::parse($l->date)->dayName;
       }

        $list=$list->chunk(7);

       $data=null;

       $data['hotel']=$hotel;
       $data['roomType']=$roomType;
       $data['rateTable']=$rateTable;
       $data['list']=$list;
        $days=$list2->select('day')->get()->unique('day');
       $data['days']=$days;


       $data['sdate']=$request->month;

        return view('dashboard.hotel.room-rate',$data);
    }
    public function createRateTable(Request $request)
    {

        if (!$request->has('sun') &&
        !$request->has('mon') &&
            !$request->has('tue') &&
            !$request->has('wed') &&
            !$request->has('thu') &&
            !$request->has('fri') &&
            !$request->has('sat')
        )
        {
            return redirect()->back()->with('errorMessage',"Please Select At least One Day")->withInput();
        }
        else
        {
            $data=$request->except('file','_token','start','end','sun','mon','tue','wed','thu','fri','sat');

            if (!$request->has("is_disabled"))
            {

                $data['is_disabled']=0;

            }
            else
            {
                $data['is_disabled']=1;
            }

            if ($request->has('sun'))
            {
                $list= self::getDateForSpecificDayBetweenDates($request->start,$request->end,$request->sun);
                foreach ($list as $l)
                {
                    $data['date']=$l;
                    self::createRateTableEntry($data);
                }
            }
            if ($request->has('mon'))
            {
                $list= self::getDateForSpecificDayBetweenDates($request->start,$request->end,$request->mon);
                foreach ($list as $l)
                {
                    $data['date']=$l;
                    self::createRateTableEntry($data);
                }
            }
            if ($request->has('tue'))
            {
                $list= self::getDateForSpecificDayBetweenDates($request->start,$request->end,$request->tue);
                foreach ($list as $l)
                {
                    $data['date']=$l;
                    self::createRateTableEntry($data);
                }
            }
            if ($request->has('wed'))
            {
                $list= self::getDateForSpecificDayBetweenDates($request->start,$request->end,$request->wed);
                foreach ($list as $l)
                {
                    $data['date']=$l;
                    self::createRateTableEntry($data);
                }
            }
            if ($request->has('thu'))
            {
                $list= self::getDateForSpecificDayBetweenDates($request->start,$request->end,$request->thu);
                foreach ($list as $l)
                {
                    $data['date']=$l;
                    self::createRateTableEntry($data);
                }
            }
            if ($request->has('fri'))
            {
                $list= self::getDateForSpecificDayBetweenDates($request->start,$request->end,$request->fri);
                foreach ($list as $l)
                {
                    $data['date']=$l;
                    self::createRateTableEntry($data);
                }
            }
            if ($request->has('sat'))
            {
                $list= self::getDateForSpecificDayBetweenDates($request->start,$request->end,$request->sat);
                foreach ($list as $l)
                {
                    $data['date']=$l;
                    self::createRateTableEntry($data);
                }
            }
        }
//        if (hotelRoomRate::where("hotel_room_type_id",$request->hotel_room_type_id)->where("date",$request->date)->exists())
//        {
//            return redirect()->back()->with('errorMessage',"Date already Selected")->withInput();
//
//        }









        return redirect()->back()->with('doneMessage', __('backend.addDone'));
    }
    public function getDateForSpecificDayBetweenDates($startDate,$endDate,$day_number){
//        dd($day_number);
        $endDate = strtotime($endDate);
        $days=array('1'=>'Monday','2' => 'Tuesday','3' => 'Wednesday','4'=>'Thursday','5' =>'Friday','6' => 'Saturday','7'=>'Sunday');
        for($i = strtotime($days[$day_number], strtotime($startDate)); $i <= $endDate; $i = strtotime('+1 week', $i))
            $date_array[]=date('Y-m-d',$i);

        return $date_array;
    }
    public function deleteBulk(Request $request)
    {
        hotelRoomType::whereIn('id', $request->data)->update(['deleted_at'=>Carbon::now()]);

        if(Request::capture()->expectsJson())
        {
            return response()->json(['message'=>"Operation Successful"]);
        }
    }
    public function createRateTableEntry($data)
    {

        $data['day']=Carbon::parse($data['date'])->dayName;
        if (hotelRoomRate::where('hotel_room_type_id',$data['hotel_room_type_id'])->where('date',$data['date'])->exists())
        {
            hotelRoomRate::where('hotel_room_type_id',$data['hotel_room_type_id'])->where('date',$data['date'])->update($data);

        }
        else
        {
            hotelRoomRate::create($data);
        }

    }
}
