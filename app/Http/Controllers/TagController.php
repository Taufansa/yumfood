<?php

namespace App\Http\Controllers;

use App\Http\Resources\TagResource;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //method show all Tags
        return TagResource::collection(Tag::paginate());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //method insert tags
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
                'name' => 'required',
            ]);

            $data = Tag::create($request->all());
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
        //method show Tag
        //5 minutes
        try {
            $data = Tag::find($id);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //method update tag
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
                'name' => 'required'
            ]);

            $find = Tag::find($id);
            if ($find) {
                $data = Tag::where('id',$id)->update(['name'=>$request->name]);
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
        //method delete tag
        //5 minutes
        try {
            $data = Tag::destroy($id);
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
