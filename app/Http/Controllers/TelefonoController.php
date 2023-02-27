<?php

namespace App\Http\Controllers;

use App\Models\Telefono;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Models\Persona;

class TelefonoController extends Controller
{
    /**
     * listado de todos los telefonos.
     * 
     * @return \Illuminate\Http\Response
     */
    public function Telefonos()
    {
        $telefonos = Telefono::all();

        return view ('telefono.telefonos')
                  ->with('telefonos',$telefonos);
    }
//------------------------------------------------------------------------
    /**
     * listado de telefono segun la persona.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function SusTelefonos($id)
    {
        $telefonos = Telefono::where('idPersona',$id)
                             ->get();

        return view ('telefono.susTelefonos')
                  ->with('telefonos',$telefonos);
    }
//------------------------------------------------------------------------
    /**
     * Crear nuevo telefono.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function CreateTelefono($id)
    {
        $persona = Persona::find($id);

        if($persona->isEmpty())
        {
            return redirect(url()->previous());
        }
        return view('telefono.create')
                  ->with('persona', $persona);
    }
//------------------------------------------------------------------------
    /**
     * Se guarda el telefono nuevo de la persona.
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function StoreTelefono(Request $request, $id)
    {
    //validacion de inputs
         $request->validate([
            'codigoArea' => 'required|numeric|max:9999|min:99',
            'numero'     => 'required|numeric|max:9999999|min:999999',
        ]);
    //busco y compruebo que exista la persona
        $persona = persona::find($id);

        if($persona->isEmpty())
        {
            return redirect(url()->previous());
        }
    //busco que el telefono a agregar no este en la base de datos y relacionado esta persona
        $resultado = Telefono::where('idpersona',$id)
                             ->where('codigoArea', $request->codigoArea)
                             ->where('numero', $request->numero)
                             ->get();

        if($resultado->isEmpty()){
    //creo un telefono nuevo
            $telefono             = new Telefono();
            $telefono->codigoArea = $request->codigoArea;
            $telefono->numero     = $request->numero;
            $telefono->whatsapp   = $request->whatsapp;
            $telfono->idpersona   = $id;
            
    //En caso de que el nuevo se lo ponga como principal de comunicacion de whatsapp, se los deshabilita los demas
            if($telefono->whatsapp == true){

                $telCambio = Telefono::where('idPersona',$id)
                                     ->get();

                foreach($telCambio as $unTelefono){
                    $unTelefono->whatsapp = false;
                    $unTelefono->save();
                }
            $telefono->save();
            }else{
    //En caso de encontrarlo y se alla puesto como whatsapp
                if($request->whatsapp == true){

                    $telCambio = Telefono::where('idPersona',$id)
                                         ->get();   

                    foreach($telCambio as $unTelefono){
                        $unTelefono->whatsapp = false;
                        $unTelefono->save();
                    }
                    $resultado->whatsapp = true;
                        $resultado->save();
                }
            }
        }
        return redirect('/Sus/Telefonos/{{$id}}');
    }
//------------------------------------------------------------------------
    /**
     * Editar un telefono.
     * @param  int  $id
     * @param  \App\Models\Telefono  $telefono
     * @return \Illuminate\Http\Response
     */
    public function EditTelefono(Telefono $telefono,$id)
    {
        $telefono = Telefono::find($id);

        if($telefono->isEmpty){
            return redirect(url()->previous());
        }

        return view('telefono.edit')
                  ->with('telefono', $telefono);
    }
//------------------------------------------------------------------------
    /**
     * Actualizar numero de telefono.
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Telefono  $telefono
     * @return \Illuminate\Http\Response
     */
    public function UpdateTelefono(Request $request, $id)
    {
        //validacion de inputs
        $request->validate([
            'codigoArea' => 'required|numeric|max:9999|min:99',
            'numero'     => 'required|numeric|max:9999999|min:999999',
        ]);

        $telefono = Telefono::where('id',$id)
                            ->get();

    //control de que no este vacio
        if($telefono->isempty()){
            return redirect(url()->previous());
        }

        $telefono->numeroArea = $request->numeroArea;
        $telefono->numero     = $request->numero;
        $telefono->whatsapp   = $request->whatsapp;

        if($telefono->whatsapp = true){
            $telCambio = Telefono::where('idPersona',$telefono->Persona->id)
                             ->get();   

            foreach($telCambio as $unTelefono){
                    $unTelefono->whatsapp = false;
                    $unTelefono->save();
            }
        }
        
        $telefono->save();
    }
//------------------------------------------------------------------------
    /**
     * Eliminacion de un telefono.
     * @param  int  $id
     * @param  \App\Models\Telefono  $telefono
     * @return \Illuminate\Http\Response
     */
    public function BajaTelefono(Telefono $telefono,$id)
    {
        $telefono = Telefono::find($id);
        $telefono->delete();
        
        return redirect($request->get('urlAnterior'));
        
    }
}
