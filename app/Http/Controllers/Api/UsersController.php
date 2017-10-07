<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Models\User;
use Barryvdh\DomPDF\PDF as PDF;
use Illuminate\Http\Request;


class UsersController extends ApiController
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::with('comedor')->get();
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
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {

        return User::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * @param UsuarioUpdateRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsuarioUpdateRequest $request, $id)
    {
        $usuario = User::findOrFail($id);

        $usuario->update($request->all());

        return $usuario;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $usuario = User::findOrFail($id);
            $usuario->delete();
        }catch (\Exception $e){
            return $e->getMessage();
        }
        return response('true');
    }

    public function getData()
    {
        return User::searchPaginateAndOrder();
    }

    public function search(){
        $usuarios  = User::search()->get();

        $retorno = $usuarios->each(function ($item, $key) {
            return $item['text'] = $item->apellido . ' ' . $item->nombre . ' "' . $item->email .'""';
        });
        return response()->json($usuarios);
    }
}
