<?php

namespace App\Http\Controllers;

use App\Models\hotel;
use App\Models\hotelRateTable;
use App\Models\hotelRoomRate;
use App\Models\hotelRoomType;
use App\Models\tour;
use App\Models\tourRate;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TourRateController extends Controller
{
    private $uploadPath = "uploads/toursRateTable";
    private $title = "Table";
    public function __construct()
    {
        view()->share('title',$this->title);
    }
    public function toggle(Request $request,$id)
    {
        $t=tourRate::find($id);
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
    public function oldlist(Request $request,$id)
    {
if ($id==0)
{
    return redirect()->back()->with('errorMessage',"Please Create Tour First");
}
        $list=tourRate::where("deleted_at",null);
        $tour=tour::find($id);
        if ($request->has("month"))
        {

            $date=Carbon::parse($request->month);
            $list=$list->whereMonth('created_at',$date->month)->whereYear('created_at',$date->year);

        }
        $list=$list->where('tour_id',$id);
        if($request->has("status"))
        {
            $list=$list->where('status',$request->status);
        }
        $list=$list->get();

        $list=$list->chunk(7);

        return view('dashboard.tourRate.list')->with(['list'=>$list,'tour'=>$tour,'sdate'=>$request->month]);
    }
    public function list(Request $request,$id)
    {

        $list=tourRate::where("deleted_at",null);
        $tour=tour::find($id);
        $rateTable=tourRate::find($id);
        $date=null;
        if ($request->has("month"))
        {
            $date=Carbon::parse($request->month);
        }
        else
        {
            $date=Carbon::now();
        }
//        hotelRoomRate::where("id",'22e')->delete();
        $mynMonth=$date->toDateString();
//        $date=$date->toDateString();

//        self::CreateDatesOfTheMonth(Carbon::parse($mynMonth)->subMonth(),$id);
        self::CreateDatesOfTheMonth($date->toDateString(),$id);


        $list=$list->where('tour_id',$id);




        $oStart=$date->startOfMonth('Y-m-d')->toDateString();
        $mstart=$date->startOfMonth('Y-m-d')->toDateString();

        $mend=$date->endOfMonth('Y-m-d')->toDateString();
        $mnewStart=Carbon::parse($mstart);

        while ($mnewStart->dayName!="Sunday")
        {
            $mstart=$mnewStart->addDay();
        }
        $mnewStart=$mnewStart->toDateString();


        $list=$list->whereBetween('date',[$mnewStart,$mend]);
        $list2=$list;
        $list3=tourRate::where("deleted_at",null)->where('tour_id',$id)->where('date','>=',$oStart)->where('date','<',$mnewStart)->orderBy('date')->get();


//        $list=$list->whereMonth('date',$date->month);
        $list=$list->orderBy('date')->get();


        $list=$list->chunk(7);

        $data=null;

        $data['tour']=$tour;
        $data['rateTable']=$rateTable;
        $data['list']=$list;

        $data['list3']=$list3->chunk($list3->count());
//        dd($data['list3']);
        $start=$date->startOfMonth('Y-m-d')->toDateString();

        $end=$date->endOfMonth('Y-m-d')->toDateString();
        $empties=tourRate::where("deleted_at",null)
            ->select('date')
            ->whereBetween('date',[$oStart,$mend])
            ->where(function ($q)
            {

                $q->orWhere('adult','!=','');
                $q->orWhere('adult','!=',null);
                $q->orWhere('child','!=','');
                $q->orWhere('child','!=',null);
                $q->orWhere('toddler','!=','');
                $q->orWhere('toddler','!=',null);
                $q->orWhere('infant','!=','');
                $q->orWhere('infant','!=',null);
                $q->orWhere('senior','!=','');
                $q->orWhere('senior','!=',null);
                $q->orWhere('tax_amount','!=','');
                $q->orWhere('tax_percentage','!=','');

            })


//
//                    ->where('senior','==',null)

            ->where('tour_id',$id)

            ->get();

        $data['days']=[];



        $data['empties']=$empties;
//       dd($data['empties']);
//dd($data['empties']);
        if ($request->has('month'))
        {
            $data['mdate']=$request->month;
        }
        else
        {
            $data['mdate']=$date->toDateString();

        }

        $data['sdate']=Carbon::parse($date)->format('M Y');
//dd($data);
        return view('dashboard.tourRate.list',$data);
    }
    public function create(Request $request)
    {
        $roomType=hotelRoomType::find($request->hotel_room_type_id);
        $hotel=hotel::find($roomType->hotel_id);
        $rateTable=hotelRateTable::find($roomType->hotel_rate_table_id);

        $this->validate($request, [
            'start'=>'required|after_or_equal:'.$rateTable->effective_start_date,
            'end'=>'required|before_or_equal:'.$rateTable->effective_end_date
        ]);
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
    public function delete($id)
    {
        $city=tour::find($id);
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

        $city= tour::where('id',$id)->update($data);

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
    public function oldcreate(Request $request)
    {

        $this->validate($request, [
            'day' => 'required',
            'date' => 'required|date|after_or_equal:start',
            'date' => 'required|date|before_or_equal:end',
        ],[
            'day.required'=>"Error! Please Select a Day"
        ]);

        $data=$request->except('file');

        if (!$request->has("is_disabled"))
        {

            $data['is_disabled']=0;

        }
        else
        {
            $data['is_disabled']=1;
        }


        $city= tourRate::create($data);

        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            Storage::disk('public')->delete($city->image);
            $path = $request->file('file')->storeAs($this->uploadPath,$city->id.'.'.$extension);

            $city->image= $path;

            $city->save();
        }
        return redirect()->back()->with('doneMessage', __('backend.addDone'));
    }
    public static function CreateDatesOfTheMonth($month,$room_type_id)
    {

//        hotelRoomRate::where("id",'!=','12s')->delete();
        $month=Carbon::parse($month);

        $start=$month->startOfMonth('Y-m-d')->toDateString();
        $end=$month->endOfMonth('Y-m-d')->toDateString();


        $i=0;
        while($start<=$end)
        {
            if (!tourRate::where('date',$start)->where('tour_id',$room_type_id)->exists())
            {
                $i++;
                $rr=new tourRate();
                $rr->date=$start;
                $rr->tour_id=$room_type_id;
                $rr->day=Carbon::parse($start)->dayName;
                $rr->is_disabled=false;

                $rr->save();
            }
            $start=Carbon::parse($start)->addDay();
            $start=$start->toDateString();

        }

    }
    //asas
    ///asas
    ///
    ///
}
