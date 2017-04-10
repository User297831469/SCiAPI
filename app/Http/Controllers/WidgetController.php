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

        $widgets = Widgets::all(); // get all widgets

        return view('welcome')->with('widgets', $widgets); // return main view
    }

    public function store(Request $request){

        $rules = array( // validation rules
            'name' => 'required',
            'description' => 'required',
            'formula' => 'required|mimes:jpg,jpeg,png',
            'code' => 'required',
            'image' => 'mimes:jpg,jpeg,png'

        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('welcome')->withErrors($validator); // return main view with erros
        }

        $widget = new Widgets(); // other wise, create new widget
        $widget->name = $request->input('name'); // store widget name
        $widget->description = $request->input('description'); // store widget description
        $widget->code = $request->input('code'); // store widget code
        $widget->created_at = date('Y-m-d H:i:s'); // log creation date
        $widget->updated_at = date('Y-m-d H:i:s'); // and update date

        $widget->save(); // save to db

        $formula = $request->file('formula'); // get formula image
        $mime = '.'.$formula->getClientOriginalExtension(); // get image extension
        $formulaName = 'widget-'.$widget->id.'-formula'.$mime; // create new name, for recall later

        SSH::into('Blue')->put($formula->getRealPath(), '/home/SCiAPI/'.$formulaName); // store image on file server

        $widget->formula = $formulaName; // store image name in db

        if(!is_null($request->input('wolfram'))) { // a wolfram script was provided

            $widget->wolfram = $request->input('wolfram'); // store widget wolfram script
        }

        if(!is_null($request->file('image'))) { // a photo was provided

            $image = $request->file('image'); // get photo image
            $mime = '.' . $image->getClientOriginalExtension(); // get image extension
            $imageName = 'widget-' . $widget->id . '-image' . $mime; // create new name, for recall later

            SSH::into('Blue')->put($image->getRealPath(), '/home/SCiAPI/' . $imageName); // store image on file server

            $widget->image = $imageName; // store image name in db
        }

        $widget->save(); // save widget

        return Redirect::route('welcome'); // return main view

    }

    public function reply($function_name, Request $request){

        $name = implode(' ',explode('_',$function_name)); // get name in space delimited format
        $widget = Widgets::where('name', '=', $name)->first(); // get the widget by name

        if(!is_null($widget)) { // if it is found

            $code = $widget->code; // get its code
            $lines = explode("\n", $code); // split it by its lines
            $firstLine = $lines[0]; // get the first line, including the function name and parameters
            $body = implode("\n",array_slice($lines, 1, count($lines) - 1)); // get the body of the function

            if(count($request->all()) > 1) { // parameters were supplied

                foreach ($request->all() as $input => $val) { // for each parameter passed with the request

                    $parameter_pos = strpos($firstLine, $input); // find the parameter in the function

                    if (!$parameter_pos == false) { // the input is a parameter

                        if ($firstLine[$parameter_pos + strlen($input)] == ',') { // the parameter is followed by a comma

                            $left = substr($firstLine, 0, $parameter_pos + strlen($input) - 1); // remove the comma
                            $right = substr($firstLine, $parameter_pos + strlen($input) + 1);
                            $firstLine = $left . $right;
                        }

                        str_replace($input, "", $firstLine); // remove the parameter from the function footprint
                        str_replace($input, $val, $body); // replace instances of the variable in the function body with the provided value
                    } else { // a parameter could not be found

                        return response()->json([
                            'code' => 'parameter error',
                            'widget' => 'parameter error',
                            'status' => 'fail',
                            'message' => 'an incorrect parameter was passed: '.$input
                        ]);
                    }
                }

                $code = implode("\n", array_unshift($body, $firstLine)); // merge the code segments back together
            }

            $partial = view('_partials.widget', ['widget' => $widget]); // the widget partial blade template
            $rendered = $partial->render(); // render the widget

            return response()->json([
                'code' => $code,
                'widget' => $rendered,
                'status' => 'success',
                'message' => 'successfully requested function '.$widget->name
            ]);
        }

        else { // could not find a widget by the provided name

            return response()->json([
                'code' => 'not found',
                'widget' => 'not found',
                'status' => 'fail',
                'message' => 'could not find a function with the name '.$name
            ]);
        }
    }

}