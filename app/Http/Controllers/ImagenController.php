<?php

namespace App\Http\Controllers;

use App\Models\Establecimiento;
use App\Models\Imagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store (Request $request){

        // leer la imagen
        $ruta_imagen = $request->file('file')->store('establecimientos', 'public');

        //  Resize a la imagen

        $imagen = Image::make( public_path("storage/{$ruta_imagen}"))->fit(800, 450);
        $imagen->save();

        // Almacenar con modelo

        $imagenDB = new Imagen;
        $imagenDB->id_establecimiento = $request['uuid'];
        $imagenDB->ruta_imagen = $ruta_imagen;

        $imagenDB->save();


        // Restpuesta

        $response = [
            'archivo' => $ruta_imagen
        ];

        return response()->json($response);
    }

    // Eliminar imagen

    public function destroy(Request $request)
    {

        $uuid = $request->get('uuid');
        $establecimiento = Establecimiento::where('uuid', $uuid)->first();
        $this->authorize('delete', $establecimiento);

        $imagen = $request->get('imagen');

        if(File::exists('storage/'. $imagen)){
            //Elimina imagen del SERVIDOR
            File::delete('storage/'. $imagen);

            //Elimina Imagen de la BD
            Imagen::where('ruta_imagen', $imagen)->delete();

            $response = [
                'mensaje' => 'Imagen Eliminada',
                'imagen' => $imagen,
                'uuid' => $uuid
            ];
        }
        return response()->json($response);
    }
}
