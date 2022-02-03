<?php

namespace App\Http\Controllers;

use App\Models\city;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CityController extends Controller
{
    private $uploadPath = "uploads/cities";
    private $title = "Cities";
    public function __construct()
    {
        view()->share('title',$this->title);
    }
    public function list(Request $request)
    {
        $list=city::where("deleted_at",null);
        if($request->has("status"))
        {
            $list=$list->where('status',$request->status);
        }
        $list=$list->with('country')->get();
   foreach ($list as $l)
   {
       $l->image=asset("core/public/".$l->image);
   }
        return view('dashboard.city.list')->with(['list'=>$list]);
    }
    public function delete($id)
    {
        $city=city::find($id);
        $city->deleted_at=Carbon::now();
        if($city->save())
        {
            return redirect()->back()->with('doneMessage', __('backend.deleteDone'));
        }
    }
    public function update(Request $request,$id)
    {


        $city=city::find($id);

        $city->name=$request->name;
        $city->english_name=$request->english_name;
        $city->status=$request->status;
        $city->country_id=$request->country_id;
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
        $city= city::create($data);

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
}