<?php

namespace App\Http\Controllers\Encargado;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use App\Http\Requests;

use App\Campus;

use Illuminate\Support\Facades\Auth;

use Mail;


class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rol = $this->getRol();
            
        if($rol == 'Encargado')
        {
            $campus = Campus::where('rut_encargado',Auth::user()->rut)
                            ->select('nombre')
                            ->get();

            if($campus->isEmpty())
            {
               $campus = '';
            }
            else
            {
                $campus = $campus->first()->nombre;
            }
            return view('encargado/contacto',compact('rol','campus'));
        }
                  
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
       
        Mail::send('email.mensaje',$request->all(),function($msj)
        {
            $msj->subject('Contacto Administrador de Salas');
            $msj->to('nicolas.vera@ceinf.cl');
        });

        Session::flash('message', 'El mensaje ha sido enviado correctamente.');

        return redirect()->route('encargado.contacto.index');

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
