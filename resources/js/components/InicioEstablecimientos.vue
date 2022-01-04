<template>
   <div>
        <listado-categorias></listado-categorias>
        <mapa-establecimientos></mapa-establecimientos>
        <categoria-cafe></categoria-cafe>
        <categoria-restaurant></categoria-restaurant>
        <categoria-hotel></categoria-hotel>
   </div>
</template>


<script>
    import ListadoCategorias from './ListadoCategorias'
    import CategoriaCafe from './CategoriaCafe'
    import CategoriaRestaurant from './CategoriaRestaurant'
    import CategoriaHotel from './CategoriaHotel'
    import MapaEstablecimientos from './MapaEstablecimientos'



export default {
    components: {
        CategoriaCafe,
        CategoriaRestaurant,
        CategoriaHotel,
        MapaEstablecimientos,
        ListadoCategorias
    }
}
</script>
