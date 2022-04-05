<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class TagController extends Controller
{
    private $uploadPath = "uploads/currencies";
    private $title = "Tags";
    public function __construct()
    {
        view()->share('title',$this->title);
    }
    public function list(Request $request)
    {
        $list=Tag::where("deleted_at",null);
        if($request->has("status"))
        {
            $list=$list->where('status',$request->status);
        }

        foreach ($list as $l)
        {
            $l->image=asset("core/public/".$l->image);
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
        $list=$list->get();
        return view('dashboard.Tag.list')->with(['list'=>$list]);
    }
    public function delete($id)
    {
//        if (hotelRateTable::where('Tag_id',$id)->exists())
//        {
//            return redirect()->back()->with('errorMessage','You cannot Delete this Record It has Related Data');
//        }
        $city=Tag::find($id);
        $city->deleted_at=Carbon::now();
        if($city->save())
        {
            return redirect()->back()->with('doneMessage', __('backend.deleteDone'));
        }
    }
    public function update(Request $request,$id)
    {

        $data=$request->except(['_token']);
        $city=Tag::where('id',$id)->update($data);
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
        $city= Tag::create($data);

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


        foreach ($request->data as $id)
        {
//            if (!hotelRateTable::where('Tag_id',$id)->exists())
//            {
            Tag::where('id', $id)->update(['deleted_at'=>Carbon::now()]);
//            }
        }


        if(Request::capture()->expectsJson())
        {
            return response()->json(['message'=>"Operation Successful"]);
        }
    }
    public function addView(Request $request)
    {
        return view('dashboard.Tag.add');
    }
    public function updateView(Request $request,$id)
    {
        $data['Banner']=Tag::find($id);
        return view('dashboard.Tag.edit',$data);
    }
}
