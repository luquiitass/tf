<?php

namespace App\Http\Controllers\Api;

use App\Helper\AjaxGetAttribute;
use App\Models\Menu;
use App\Models\RetornoAjax;
use Illuminate\Http\Request;

use App\Http\Requests;

class MenusController extends ApiController
{
    use AjaxGetAttribute,RetornoAjax;

    public function attribute($menu){

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        try{
            \DB::beginTransaction();

            $recetas = $request->get('recetas');

            $id_recetas = collect($recetas)->pluck('receta.id');

            $menu = Menu::create($request->only('instancia_id','cantidad'));

            $menu->recetas()->delete();

            //dd($recetas[0]);

            foreach ($recetas as $receta) {
                $menu->recetas()->attach($receta['receta']['id'], ['cantidad' => $receta['cantidad']]);
            }
            $menu->load('recetas.ingredientes');

            \DB::commit();
            return $this->jsonMensajeData('Menu guardado','','success',$menu);
        }catch (\Exception $e){
            \DB::rollBack();
            return $this->jsonMensajeError('Error',$e->getMessage());
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
