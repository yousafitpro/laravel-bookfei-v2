<?php

namespace App\Http\Controllers;

use App\Models\airline;
use App\Models\Country;
use App\Models\currency;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CurrencyController extends Controller
{
    private $uploadPath = "uploads/currencies";
    private $title = "Currencies";
    public function __construct()
    {
        view()->share('title',$this->title);
    }
    public function list(Request $request)
    {
        $list=currency::where("deleted_at",null);
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
        return view('dashboard.currency.list')->with(['list'=>$list]);
    }
    public function delete($id)
    {
        $city=currency::find($id);
        $city->deleted_at=Carbon::now();
        if($city->save())
        {
            return redirect()->back()->with('doneMessage', __('backend.deleteDone'));
        }
    }
    public function update(Request $request,$id)
    {


        $city=currency::find($id);

        $city->name=$request->name;
        $city->exchange_rate=$request->exchange_rate;
        $city->status=$request->status;
        $city->base=$request->base;
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
        $city= currency::create($data);

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
        currency::whereIn('id', $request->data)->update(['deleted_at'=>Carbon::now()]);

        if(Request::capture()->expectsJson())
        {
            return response()->json(['message'=>"Operation Successful"]);
        }
    }
    public function addView(Request $request)
    {
        return view('dashboard.currency.add');
    }
    public function updateView(Request $request,$id)
    {
        $data['Banner']=currency::find($id);
        return view('dashboard.currency.edit',$data);
    }
}
