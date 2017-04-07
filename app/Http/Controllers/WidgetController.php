<?php
/**
 * Created by PhpStorm.
 * User: marcusedwards
 * Date: 2017-04-07
 * Time: 12:24 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use SSH;


class WidgetController
{
    public function index(){

        return view('welcome');
    }

    public function store(Request $request){

        $rules = array(
            'name' => 'required',
            'description' => 'required',
            'formula' => 'required|image',
            'code' => 'required',
            'wolfram' => 'required',

        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('welcome')->withErrors($validator);
        }

        $widget = new Widgets();
        $widget->name = $request->input('name');
        $widget->description = $request->input('description');
        $widget->code = $request->input('code');
        $widget->wolfram = $request->input('wolfram');
        $widget->created_at = date('Y-m-d H:i:s');
        $widget->updated_at = date('Y-m-d H:i:s');

        $formula = $request->file('formula');
        $mime = '.'.$formula->getClientOriginalExtension();
        $formulaName = 'widget-'.$widget->id.'-formula'.$mime;

        SSH::into('Blue')->put($formula->getRealPath(), '/home/SCiAPI/'.$formulaName);

        $widget->formula = $formulaName;

        $widget->save();

    }

}