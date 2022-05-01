<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\hotelRateTable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    private $uploadPath = "uploads/currencies";
    private $title = "Categories";
    public function __construct()
    {
        view()->share('title',$this->title);
    }
    public function list(Request $request)
    {
        $list=Category::where("deleted_at",null);
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
        return view('dashboard.Category.list')->with(['list'=>$list]);
    }
    public function delete($id)
    {
//        if (hotelRateTable::where('Category_id',$id)->exists())
//        {
//            return redirect()->back()->with('errorMessage','You cannot Delete this Record It has Related Data');
//        }
        $city=Category::find($id);
        $city->deleted_at=Carbon::now();
        if($city->save())
        {
            return redirect()->back()->with('doneMessage', __('backend.deleteDone'));
        }
    }
    public function update(Request $request,$id)
    {

         $data=$request->except(['_token']);
        $city=Category::where('id',$id)->update($data);
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
        $city= Category::create($data);

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
            return redirect()->back()->with('doneMessage', __('backend.addDone'));
        }
        return redirect($request->redirectUrl)->with('doneMessage', __('backend.addDone'));
    }
    public function deleteBulk(Request $request)
    {


        foreach ($request->data as $id)
        {
//            if (!hotelRateTable::where('Category_id',$id)->exists())
//            {
                Category::where('id', $id)->update(['deleted_at'=>Carbon::now()]);
//            }
        }


        if(Request::capture()->expectsJson())
        {
            return response()->json(['message'=>"Operation Successful"]);
        }
    }
    public function addView(Request $request)
    {
        return view('dashboard.Category.add');
    }
    public function updateView(Request $request,$id)
    {
        $data['Banner']=Category::find($id);
        return view('dashboard.Category.edit',$data);
    }
}
