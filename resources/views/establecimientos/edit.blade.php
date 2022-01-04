@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder/dist/esri-leaflet-geocoder.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/6.0.0-beta.2/dropzone.min.css" integrity="sha512-qkeymXyips4Xo5rbFhX+IDuWMDEmSn7Qo7KpPMmZ1BmuIA95IPVYsVZNn8n4NH/N30EY7PUZS3gTeTPoAGo1mA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center mt-4">
            Editar Establecimientos
        </h1>

        <div class="mt-5 row justify-content-center">
            <form action="{{ route('establecimiento.update', ['establecimiento' => $establecimiento->id]) }}" method="POST" class="col-md-9 col-xs-12 card card-body" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <fieldset class="border p-4">
                    <legend class="text-primary">Nombre, Categoría e Imagen Principal</legend>
                        <div class="form-group">
                            <label for="nombre">Nombre Establecimiento</label>
                            <input value="{{$establecimiento->nombre}}" type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre establecimiento"/>
                        </div>
                        @error('nombre')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                        <div class="form-group">
                            <label for="categoria">Categoría</label>
                            <select name="categoria_id" id="categoria" class="form-control @error('categoria_id') is-invalid @enderror">
                                <option value="" disabled selected> -- Seleccione -- </option>
                                @foreach ($categorias as $categoria )
                                    <option
                                        {{ $establecimiento->categoria_id == $categoria->id ? 'selected' : ''}}
                                        value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="imagen_principal">Imagen Principal</label>
                            <input value="{{ $establecimiento->imagen_principal }}" type="file" name="imagen_principal" id="imagen_principal" class="form-control @error('imagen_principal') is-invalid @enderror" placeholder="Nombre establecimiento"/>
                        </div>
                        @error('nombre')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                </fieldset>

                <fieldset class="border p-4">
                    <legend class="text-primary">Ubicación</legend>
                        <div class="form-group">
                            <label for="formbuscador">Coloca la dirección del Establecimiento</label>
                            <input type="text"  id="formbuscador" placeholder="Calle del Negocio o Establecimiento" class="form-control"/>
                        </div>
                        <p class="text-secondary mt-5 mb-3 text-center">El asistente colocará una dirección estimada o mueve el pin hacia el lugar correcto</p>
                        <div class="form-group">
                            <div id="mapa" style="height: 400px"></div>
                        </div>
                        <p class="informacion">
                            Confirma los siguientes datos
                        </p>

                        <div class="form-group">
                            <label for="direccion">Direccion</label>
                            <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror " placeholder="Dirección" id="direccion" value="{{ $establecimiento->direccion }}" >
                        </div>
                        @error('direccion')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                        <div class="form-group">
                            <label for="colonia">Colonia</label>
                            <input type="text" name="colonia" class="form-control @error('colonia') is-invalid @enderror" placeholder="Colonia" id="colonia"  value="{{ $establecimiento->colonia }}">
                        </div>
                        @error('colonia')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                        <input type="hidden" id="lat" name="lat" value="{{ $establecimiento->lat }}">
                        <input type="hidden" id="lng" name="lng" value="{{ $establecimiento->lng }}">
                </fieldset>
                <fieldset class="border p-4 mt-5">
                    <legend  class="text-primary">Información Establecimiento: </legend>
                        <div class="form-group">
                            <label for="nombre">Teléfono</label>
                            <input
                                type="tel"
                                class="form-control @error('telefono')  is-invalid  @enderror"
                                id="telefono"
                                placeholder="Teléfono Establecimiento"
                                name="telefono"
                                value="{{ $establecimiento->telefono }}"
                            >

                                @error('telefono')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                        </div>



                        <div class="form-group">
                            <label for="nombre">Descripción</label>
                            <textarea
                                class="form-control  @error('descripcion')  is-invalid  @enderror"
                                name="descripcion"
                            >{{ $establecimiento->descripcion }}</textarea>

                                @error('descripcion')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="nombre">Hora Apertura:</label>
                            <input
                                type="time"
                                class="form-control @error('apertura')  is-invalid  @enderror"
                                id="apertura"
                                name="apertura"
                                value="{{ $establecimiento->apertura }}"
                            >
                            @error('apertura')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nombre">Hora Cierre:</label>
                            <input
                                type="time"
                                class="form-control @error('cierre')  is-invalid  @enderror"
                                id="cierre"
                                name="cierre"
                                value="{{ $establecimiento->cierre }}"
                            >
                            @error('cierre')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <input type="hidden" id="uuid" name="uuid" value="{{ $establecimiento->uuid }}">
                        <input type="submit" class="btn btn-primary mt-3 d-block" value="Guardar Cambios">
                </fieldset>

                <fieldset class="border p-4 mt-5">
                    <legend class="text-primary"> Imágenes Establecimiento </legend>
                    <div class="form-group">
                        <label for="imagenes">Imagenes</label>
                        <div id="dropzone" class="dropzone form-control"></div>
                    </div>

                    @if(count($imagenes)> 0)
                        @foreach ($imagenes as $imagen)
                            <input class="galeria" type="hidden" value="{{ $imagen->ruta_imagen}}"/>
                        @endforeach
                    @endif

                </fieldset>

            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet/dist/leaflet-src.js" defer></script>
<script src="https://unpkg.com/esri-leaflet" defer></script>
<script src="https://unpkg.com/esri-leaflet-geocoder" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/6.0.0-beta.2/dropzone-min.js" integrity="sha512-FFyHlfr2vLvm0wwfHTNluDFFhHaorucvwbpr0sZYmxciUj3NoW1lYpveAQcx2B+MnbXbSrRasqp43ldP9BKJcg==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
@endsection
