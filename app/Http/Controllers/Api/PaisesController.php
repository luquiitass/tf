<?php

namespace App\Http\Controllers\Api;

use App\Helper\AjaxGetAttribute;
use App\Http\Controllers\Api\ApiController;
use App\Models\Pais;
use Illuminate\Http\Request;

use App\Http\Requests;

class PaisesController extends ApiController
{
    use AjaxGetAttribute;

    public function attribute(Pais $pais){
        return $this->ajaxGetAtribute($pais);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Pais::get());
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
    public function store(Requests\PaisStoreRequest $request)
    {
        return Pais::create($request->only('nombre'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
    public function update(Requests\PaisUpdateRequest $request, $id)
    {
        $pais = Pais::findOrFail($id);

        return $pais->update($request->get('nombre'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
