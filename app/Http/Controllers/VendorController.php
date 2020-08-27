<?php

namespace App\Http\Controllers;

use App\Http\Resources\VendorResource;
use App\Vendor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        //method show all vendors
        return VendorResource::collection(Vendor::paginate());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //method insert vendor
        //15 minutes
        try {
            if (is_null($request->name)) {
                $msg = [
                    'message' => 'null',
                    'status' => 205
                ];
                return $msg;
            }

            $request->validate([
                'name' => 'required|max:128',
            ]);

            $data = Vendor::create($request->all());
            if ($data) {
                $msg = [
                    'message' => 'insert succes',
                    'status' => 200
                ];
            } else {
                $msg = [
                    'message' => 'insert fail',
                    'status' => 205
                ];
            }
             
            return $msg;
        } catch (Throwable $e) {
            report($e);
    
            return false;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //method show vendor
        //5 minutes
        try {
            $data = Vendor::find($id);
            if ($data) {
                return $data;
            } else{
                $msg = [
                    'message' => 'data not found',
                    'status' => 205
                ];
                return $msg;
            }
        } catch (Throwable $e) {
            report($e);
    
            return false;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //method update vendor
        //10 minutes
        try {
            if (is_null($request->name)) {
                $msg = [
                    'message' => 'null',
                    'status' => 205
                ];
                return $msg;
            }

            $request->validate([
                'name' => 'required|max:128'
            ]);

            $find = Vendor::find($id);
            if ($find) {
                $data = Vendor::where('id',$id)->update(['name'=>$request->name]);
                if ($data) {
                    $msg = [
                        'message' => 'update succes',
                        'status' => 200
                    ];
                } else {
                    $msg = [
                        'message' => 'update fail',
                        'status' => 205
                    ];
                }
                return $msg;
            } else{
                $msg = [
                    'message' => 'data not found',
                    'status' => 205
                ];
                return $msg;
            }
            
        } catch (Throwable $e) {
            report($e);
    
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response    
     */
    public function destroy($id)
    {
        //method delete vendor
        //5 minutes
        try {
            $data = Vendor::destroy($id);
            if ($data > 0) {
                $msg = [
                    'message' => 'delete succes',
                    'status' => 204
                ];
            }else {
                $msg = [
                    'message' => 'delete fail',
                    'status' => 205
                ];
            }
            return $msg;
        } catch (Throwable $e) {
            report($e);
    
            return false;
        }
    }
}
