<template>
    <div>
        <h2 class="mt-4"> Galería de Imágenes</h2>
        <ul class="row list-unstyled mt-4">
                <li class="col-md-4 mb-4" v-for="imagen in imagenes" v-bind:key="imagen.id">
                    <a :href='`/storage/${imagen.ruta_imagen}`' data-lightbox="imagenes" data-title="Imagen Establecimiento">
                        <img class="img-fluid" :src='`/storage/${imagen.ruta_imagen}`'>
                    </a>
                </li>
        </ul>
    </div>
</template>

<script>

import Lightbox from 'lightbox2'

export default {
    computed: {
        imagenes() {
            return this.$store.getters.obtenerImagenes
        }
    }
}
</script>

<style scoped>
    @import 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css';
</style>
