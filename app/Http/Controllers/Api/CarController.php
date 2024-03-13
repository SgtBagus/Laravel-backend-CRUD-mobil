<?php

namespace App\Http\Controllers\Api;

use DB;

use App\Models\Car;
use App\Http\Controllers\Controller;
use App\Http\Requests\CarStoreRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class CarController extends Controller {
    public function index(Request $request){
        try {
            $car = Car::all();

            $merekFilter = null;
            if ($request->has('merek')) {
                $car = Car::where('merek','LIKE','%'.$request->merek.'%')->get();
            }

            return response()->json([
                'data' => $car,
                'message' => "Success get Data"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Something went wrong!"
            ], 500);
        }
    }

    public function create(CarStoreRequest $request){
        try {
            //set validation
            $validator = Validator::make($request->all(), [
                'merek'     => 'required',
                'jenis'     => 'required',
                'stok'      => 'required',
                'price'     => 'required',
            ]);
    
            //if validation fails
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $Car = Car::create([
                'merek'         => $request->merek,
                'jenis'         => $request->jenis,
                'stok'          => $request->stok,
                'price'         => $request->price,
                'keterangan'    => $request->keterangan,
            ]);

            return response()->json([
                'message'   => "Car successfully created",
                'success'   => true,
                'data'      => $Car,  
            ], 200);

        } catch (\Exception $e) {
            return $e->getMessage();
            // return response()->json([
            //     'message' => "Something went wrong!"
            // ], 500);
        }
    }

    public function update(CarStoreRequest $request, $id){
        try {
            $car = Car::find($id);
            if(!$car){
                return $car()->json([
                    'message' => 'Car not found!'
                ],404);
            }

            $car->merek         = $request->merek;
            $car->jenis         = $request->jenis;
            $car->stok          = $request->stok;
            $car->price         = $request->price;
            $car->keterangan    = $request->keterangan;
            
            $car->save();

            return response()->json([
                'message' => 'Car successfully updated'
            ],200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => "Something went wrong!"
            ],500);
        }
    } 
        
    public function delete($id){

        $Cars = Car::find($id);
        if(!$Cars){
            return $Cars()->json([
                'message' => 'Car not found!'
            ],404);
        }

        $Cars->delete();

        return response()->json([
            'message' => 'Car succesfully deleted'
        ],200);
    }
}
