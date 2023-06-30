<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Type::with('type_of_post')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return $request->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type = new Type();
        $type->name = $request->name;
        $type->save();
        return Type::where('id', $type->id)->first();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Type::where('id', $id)->with('type_of_post')->first();
        if (empty($post)) {
            return response(['status' => false, 'message' => 'Failed'], 400);
        }
        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $type = Type::find($id);
        if (!empty($type)) {
            if (!empty($request->name)) {
                $type->name = $request->name;
                $type->save();
                return Type::where('id', $id)->first();
            }
        }
        return response(['status' => false, 'message' => 'Failed'], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = Type::where('id', $id)->with('type_of_post')->first();
        if (empty($type) || sizeof($type->type_of_post) > 0) {
            return response(['status' => false, 'message' => 'Failed'], 400);
        } else {
            $type->delete();
            return response(['status' => true, 'message' => 'Success'], 200);
        }
    }
}
