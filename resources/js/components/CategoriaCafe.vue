<template>
    <div class="container my-5">
        <h2>Cafés</h2>
        <div class="row">
            <div class="col-md-4 mt-4" v-for="cafe in this.cafes" v-bind:key="cafe.id">
                <div class="card">
                    <div class="card-body">
                        <img :src="`storage/${cafe.imagen_principal}`" alt="card del restaurant" class="card-img-top">
                        <h3 class="card-title text-primary font-weight-bold">
                            {{ cafe.nombre }}
                        </h3>
                        <p class="card-text"> {{cafe.direccion }} </p>
                        <p class="card-text">
                            <span class="font-weight-bold"> Horario: </span>
                            {{ cafe.apertura }} - {{ cafe.cierre }}
                        </p>

                        <router-link :to="{name: 'establecimiento', params: {id: cafe.id}}" >
                            <a class="btn btn-primary d-block"> Ver Lugar </a>
                        </router-link>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            axios.get('/api/categorias/cafe')
                .then( response => {
                   this.$store.commit("AGREGAR_CAFES", response.data)
                })
        },
        computed: {
            cafes() {
                return this.$store.state.cafes
            }
        }
    }
</script>
