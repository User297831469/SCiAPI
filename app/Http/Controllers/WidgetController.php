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
use App\Models\Widgets;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use SSH;


class WidgetController
{
    public function index(){

        $widgets = Widgets::all();

        return view('welcome')->with('widgets', $widgets);
    }

    public function store(Request $request){

        $rules = array(
            'name' => 'required',
            'description' => 'required',
            'formula' => 'required|image',
            'code' => 'required',
            'wolfram' => 'required',
            'image' => 'required|image'

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

        $widget->image = $formulaName;

        $image = $request->file('image');
        $mime = '.'.$image->getClientOriginalExtension();
        $imageName = 'widget-'.$widget->id.'-image'.$mime;

        SSH::into('Blue')->put($image->getRealPath(), '/home/SCiAPI/'.$imageName);

        $widget->image = $imageName;

        $widget->save();

        return Redirect::route('welcome');

    }

    public function reply($f, Request $request){

        $widget = Widgets::where('name', '=', $f)->first();
        $code = $widget->code;

        foreach($request->all() as $input=>$val) {

            str_replace($input, $val, $code);
        }

        $partial = view('_partials.widget', ['widget' => $widget]);
        $rendered = $partial->render();

        return response()->json([
            'name' => $code,
            'widget' => $rendered
        ]);
    }

}