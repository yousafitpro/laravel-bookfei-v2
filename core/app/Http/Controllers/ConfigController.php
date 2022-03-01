<?php

namespace App\Http\Controllers;

use App\Models\config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    private $uploadPath = "uploads/config/uploads";
    private $title = "Settings:config";
    public function __construct()
    {
        view()->share('title',$this->title);
    }
    public function index()
    {

        if (config::all()->count()<1)
        {
            $config=new config();
            $config->user_id=auth()->user()->id;
            $config->save();
        }
        $config=config::first();
        return view('dashboard.setting.config',['config'=>$config]);
    }
    public function update(Request $request)
    {

      $data=$request->except(['_token']);
        $config=config::where('user_id',auth()->user()->id)->update($data);
        return redirect()->back();
    }
}
