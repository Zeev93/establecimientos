<template>
    <div class="container my-5">
        <h2> {{ establecimiento.nombre }} </h2>

        <div class="row align-items-start">
            <div class="col-md-8 order-2">
                <img class="img-fluid" :src="`../storage/${establecimiento.imagen_principal}`" alt="imagen establecimiento">
                <p class="mt-3">{{establecimiento.descripcion}} </p>
                <galeria-imagenes></galeria-imagenes>
            </div>
            <aside class="col-md-4 order-1">
                <div>
                    <mapa-ubicacion></mapa-ubicacion>
                </div>

                <div class="p-4  bg-primary">
                    <h2 class="text-center text-white mt-2 mb-4"> Más información </h2>
                    <p class="text-white mt-1">
                        <span class="font-weight-bold">
                            Ubicación:
                        </span>
                        {{establecimiento.direccion}}
                    </p>
                    <p class="text-white mt-1">
                        <span class="font-weight-bold">
                            Colonia:
                        </span>
                        {{establecimiento.colonia}}
                    </p>
                    <p class="text-white mt-1">
                        <span class="font-weight-bold">
                            Horario:
                        </span>
                        {{establecimiento.apertura}} - {{establecimiento.cierre}}
                    </p>
                    <p class="text-white mt-1">
                        <span class="font-weight-bold">
                            Teléfono:
                        </span>
                        {{establecimiento.telefono}}
                    </p>
                </div>
            </aside>
        </div>
    </div>
</template>


<script>

import MapaUbicacion from './MapaUbicacion';
import GaleriaImagenes from './GaleriaImagenes'

export default {

    components:{
        MapaUbicacion,
        GaleriaImagenes
    },
    mounted() {

            const { id } = this.$route.params;
            axios.get('/api/establecimiento/' + id)
                .then( response => {
                    this.$store.commit('AGREGAR_ESTABLECIMIENTO', response.data)
                })
        },

          computed: {
            establecimiento(){
                return this.$store.getters.obtenerEstablecimiento
            }
        }
}
</script>
