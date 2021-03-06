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
use App\User;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use SSH;
use DB;


class WidgetController
{

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
            return Redirect::route('home')->withErrors($validator); // return main view with errors
        }

        $user = Auth::user(); // get current user

        $widget = new Widgets(); // create new widget
        $widget->name = $request->input('name'); // store widget name
        $widget->description = $request->input('description'); // store widget description
        $widget->code = $request->input('code'); // store widget code
        $widget->created_at = date('Y-m-d H:i:s'); // log creation date
        $widget->updated_at = date('Y-m-d H:i:s'); // and update date
        $widget->user_id = $user->id; // associate with owner

        $widget->save(); // save to db

        $formula = $request->file('formula'); // get formula image
        $mime = '.'.$formula->getClientOriginalExtension(); // get image extension
        $formulaName = 'widget-'.$widget->id.'-formula'.$mime; // create new name, for recall later

        SSH::into('Blue')->put($formula->getRealPath(), '/home/nginx/html/SCiAPI/'.$formulaName); // store image on file server

        $widget->formula = $formulaName; // store image name in db

        if(!is_null($request->input('wolfram'))) { // a wolfram script was provided

            $widget->wolfram = $request->input('wolfram'); // store widget wolfram script
        }

        if(!is_null($request->file('image'))) { // a photo was provided

            $image = $request->file('image'); // get photo image
            $mime = '.' . $image->getClientOriginalExtension(); // get image extension
            $imageName = 'widget-' . $widget->id . '-image' . $mime; // create new name, for recall later

            SSH::into('Blue')->put($image->getRealPath(), '/home/nginx/html/SCiAPI/' . $imageName); // store image on file server

            $widget->image = $imageName; // store image name in db
        }

        $widget->save(); // save widget

        return Redirect::route('home'); // return main view

    }

    public function update($id, Request $request){

        $rules = array( // validation rules
            'name' => 'required',
            'description' => 'required',
            'formula' => 'mimes:jpg,jpeg,png',
            'code' => 'required',
            'image' => 'mimes:jpg,jpeg,png',

        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('home')->withErrors($validator); // return main view with errors
        }

        $user = Auth::user(); // get user

        $widget = Widgets::where('id', '=', $id)->first(); // get widget to update
        $widget->name = $request->input('name'); // store widget name
        $widget->description = $request->input('description'); // store widget description
        $widget->code = $request->input('code'); // store widget code
        $widget->updated_at = date('Y-m-d H:i:s'); // log update date

        $widget->save(); // save to db

        if(!is_null($request->file('formula'))) { // a formula image was provided

            $formula = $request->file('formula'); // get formula image
            $mime = '.' . $formula->getClientOriginalExtension(); // get image extension
            $formulaName = 'widget-' . $widget->id . '-formula' . $mime; // create new name, for recall later

            SSH::into('Blue')->put($formula->getRealPath(), '/home/nginx/html/SCiAPI/' . $formulaName); // store image on file server

            $widget->formula = $formulaName; // store image name in db
        }

        if(!is_null($request->input('wolfram'))) { // a wolfram script was provided

            $widget->wolfram = $request->input('wolfram'); // store widget wolfram script
        }

        if(!is_null($request->file('image'))) { // a photo was provided

            $image = $request->file('image'); // get photo image
            $mime = '.' . $image->getClientOriginalExtension(); // get image extension
            $imageName = 'widget-' . $widget->id . '-image' . $mime; // create new name, for recall later

            SSH::into('Blue')->put($image->getRealPath(), '/home/nginx/html/SCiAPI/' . $imageName); // store image on file server

            $widget->image = $imageName; // store image name in db
        }

        $widget->save(); // save widget

        return Redirect::route('home'); // return main view

    }

    public function reply($function_name, Request $request){

        if(!is_null($request->input('_api_key'))) { // an API key was supplied

            $user = User::where('key', '=', $request->input('_api_key'))->first(); // get the corresponding user

            if(is_null($user)){ // no user was found

                return response()->json([
                    'code' => 'API key error',
                    'widget' => 'API key error',
                    'status' => 'fail',
                    'message' => 'the supplied API key was not valid.'
                ],400);
            }

            $name = implode(' ', explode('_', $function_name)); // get name in space delimited format
            $widget = DB::table('widgets')->whereRaw( 'LOWER(name) like ?', array( strtolower($name) ))->first(); // get the widget by name, case insensitive

            if (!is_null($widget)) { // if it is found

                $code = $widget->code; // get its code
                $lines = explode("\n", $code); // split it by its lines
                $firstLine = $lines[0]; // get the first line, including the function name and parameters
                $body = implode("\n", array_slice($lines, 1, count($lines) - 1)); // get the body of the function

                if (count($request->all()) > 1) { // parameters were supplied

                    foreach ($request->all() as $input => $val) { // for each parameter passed with the request

                        $parameter_pos = strpos($firstLine, $input); // find the parameter in the function

                        if (!$parameter_pos == false) { // the input is a parameter

                            $count = $parameter_pos + strlen($input); // start at the end of the parameter
                            $char = $firstLine[$count];

                            while(($char != ',') && ($char != ')')) { // look for the next important character after the parameter

                                $count++;
                                $char = $firstLine[$count];
                            }

                            if ($char == ',') { // the parameter is followed by a comma

                                $left = substr($firstLine, 0, $count); // remove the comma
                                $right = substr($firstLine, $count + 1);
                                $firstLine = $left . $right;
                            }

                            else if($char == ')'){ // the parameter is followed by a bracket... it is the last one

                                $count = $parameter_pos; // start at the beginning of the parameter
                                $char = $firstLine[$count];

                                while(($char != ',') && ($char != '(')) { // look for the nearest important character before the parameter

                                    $count--;
                                    $char = $firstLine[$count];
                                }

                                if ($char == ',') { // the parameter is preceeded by a comma

                                    $left = substr($firstLine, 0, $count); // remove the comma
                                    $right = substr($firstLine, $count + 1);
                                    $firstLine = $left . $right;
                                }
                            }
                            $pattern = "/(?<!(\w))".$input."(?!(\w))/"; // find instances of the variable that are not parts of other words
                            $firstLine = str_replace($input, "", $firstLine); // remove the parameter from the function footprint
                            $body = preg_replace($pattern, $val, $body); // replace instances of the variable in the function body with the provided value

                        } else { // a parameter could not be found

                            if (!($input == 'Content-Type') && !($input == '_api_key') && !($input == 'type')) { // exclude validation on content-type and _api_key post parameters

                                return response()->json([
                                    'code' => 'parameter error',
                                    'widget' => 'parameter error',
                                    'status' => 'fail',
                                    'message' => 'an incorrect parameter was passed: ' . $input
                                ],400);
                            }
                        }
                    }

                    $function_lines = explode("\n", $body); // get lines of body
                    array_unshift($function_lines, $firstLine); // prepend first line to body
                    $code = implode("\n", $function_lines); // merge the code segments back together
                }

                $lite = false;
                if(!is_null($request->input('type')) && ($request->input('type') == 'lite')){ // check if the lite widget version was requested
                    $lite = true;
                }

                $partial = view('_partials.widget', ['widget' => $widget, 'lite' => $lite]); // the widget partial blade template
                $rendered = $partial->render(); // render the widget

                return response()->json([
                    'code' => $code,
                    'widget' => $rendered,
                    'status' => 'success',
                    'message' => 'successfully requested function ' . $widget->name
                ],200);
            } else { // could not find a widget by the provided name

                return response()->json([
                    'code' => 'not found',
                    'widget' => 'not found',
                    'status' => 'fail',
                    'message' => 'could not find a function with the name ' . $name
                ],404);
            }
        }

        else { // no API key supplied

            return response()->json([
                'code' => 'API key error',
                'widget' => 'API key error',
                'status' => 'fail',
                'message' => 'No API key was supplied. Please sign up for a key.'
            ],400);
        }
    }

    public function listAll(Request $request){

        if(!is_null($request->input('_api_key'))) { // an API key was supplied

            $user = User::where('key', '=', $request->input('_api_key'))->first(); // get the corresponding user

            if (is_null($user)) { // no user was found

                return response()->json([
                    'code' => 'API key error',
                    'status' => 'fail',
                    'message' => 'the supplied API key was not valid.'
                ], 400);
            }

            $widgets = Widgets::all(); // get all widgets
            $widgetInfo = []; // code building data structure

            foreach ($widgets as $widget) {
                $widgetInfo[$widget->name] = $widget->code; // function code indexed by function names
            }

            return response()->json([
                'code' => json_encode($widgetInfo),
                'status' => 'success',
                'message' => 'successfully requested list of all functions.'
            ], 200);
        }
        else { // no API key supplied

            return response()->json([
                'code' => 'API key error',
                'status' => 'fail',
                'message' => 'No API key was supplied. Please sign up for a key.'
            ],400);
        }
    }
}