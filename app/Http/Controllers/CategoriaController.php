<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::all();
        return view('abmCategoria', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('formAgregarCategoria');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $reglas = [
        "categoria" => "min:2|unique:categorias",
        "img"=>"nullable|image|mimes:jpeg,png,jpg|min:1|max:10000000",
      ];

      $msj = [
        "min" => "El campo debe tener un minimo de :min caracteres",
        "unique" => "No se puede agregar categorias que ya estan en la base de datos"
      ];

      $this->validate($request, $reglas, $msj);

      $imagenNombre="";
    if($request->file("img")){
      $file=$request->file("img");
      $imagenNombre="/img/categorias/";
      $imagenNombre.=$request->categoria."/";
      $imagenNombre.=$request->categoria;
      $imagenNombre.=".";
      $imagenNombre.=$file->getClientOriginalExtension();
      $request->img->move(public_path("img/categorias/$request->categoria/"),$imagenNombre);
    }else{
      $imagenNombre="/img/categorias/pc.png";
    }


      $Categoria = New Categoria;
      $Categoria->categoria = $request->categoria;

      $Categoria->img = $imagenNombre;
      
      $Categoria->save();

      return view("/agregarCategoria", compact('Categoria'));
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
      $Categoria = Categoria::find($id);

      return view("formModificarCategoria", compact('Categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $reglas = [
        "categoria" => "min:2|unique:categorias"
      ];

      $msj = [
        "min" => "El campo debe tener un minimo de :min caracteres",
        "unique" => "No se puede agregar categorias que ya estan en la base de datos"
      ];

      $this->validate($request, $reglas, $msj);

      $Categoria = Categoria::find($request->id_categoria);

      $Categoria->categoria = $request->categoria;

      $Categoria->save();

      return view("modificarCategoria", compact('Categoria'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $Categoria = Categoria::find($id);

      $Categoria->delete();

      return redirect('cuenta/admin/abmCategoria');
    }

    
}
