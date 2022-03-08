<?php

namespace App\Http\Controllers;

use App\Models\city;
use App\Models\Country;
use App\Models\supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CountryController extends Controller
{
    private $uploadPath = "uploads/countries";
    private $title = "Countries";
    public function __construct()
    {
        view()->share('title',$this->title);
    }
    public function list(Request $request)
    {
        $list=Country::where("deleted_at",null);
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
        $list=$list->with('area')->get();
   foreach ($list as $l)
   {
       $l->image=asset("core/public/".$l->image);
   }
        return view('dashboard.country.list')->with(['list'=>$list]);
    }
    public function delete($id)
    {
        $city=Country::find($id);
        $city->deleted_at=Carbon::now();
        if($city->save())
        {
            return redirect()->back()->with('doneMessage', __('backend.deleteDone'));
        }
    }
    public function update(Request $request,$id)
    {


        $city=Country::find($id);

        $city->name=$request->name;
        $city->english_name=$request->english_name;
        $city->status=$request->status;
        $city->area_id=$request->area_id;
        $city->save();
        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            Storage::disk('public')->delete($city->image);
            $path = $request->file('file')->storeAs($this->uploadPath,$city->id.'.'.$extension);

            $city->image= $path;

            $city->save();
        }
        return redirect()->back()->with('doneMessage', __('backend.update'));
    }
    public function create(Request $request)
    {

         $data=$request->except('file');
        $city= Country::create($data);

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
    public function deleteBulk(Request $request)
    {
        Country::whereIn('id', $request->data)->update(['deleted_at'=>Carbon::now()]);

        if(Request::capture()->expectsJson())
        {
            return response()->json(['message'=>"Operation Successful"]);
        }
    }
    public function addView(Request $request)
    {
        return view('dashboard.country.add');
    }
    public function updateView(Request $request,$id)
    {
        $data['Banner']=Country::find($id);
        return view('dashboard.country.edit',$data);
    }
}
