<?php

namespace App\Http\Controllers;
use App\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tareas=Tarea::orderBy('id', 'DESC')->paginate(5);
        return [
            'pagination'=>[
                'total'=>$tareas->total(),
                'current_page'=>$tareas->currentPage(),
                'per_page'=>$tareas->perPage(),
                'last_page'=>$tareas->lastPage(),
                'from'=>$tareas->firstItem(),
                'to'=>$tareas->lastPage(),
            ],
           'tareas'=>$tareas
        ];

        /* $tareas=Tarea::orderBy('id', 'DESC')->get();
        return $tareas; *///sin paginación
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'titulo'=>'required'
        ]);
        Tarea::create($request->all());
        return;
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
        $this->validate($request,[
            'titulo'=>'required'
        ]);
        Tarea::find($id)->update($request->all());
        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tareas=Tarea::findOrFail($id);
        $tareas->delete();
    }
}
