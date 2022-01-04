<template>
    <div>
        <nav class="d-flex flex-column flex-md-row container justify-content-md-center">
            <a @click="seleccionarTodos()">Todos</a>
            <a v-for="categoria in categorias" v-bind:key="categoria.id" class="m-0" @click="seleccionarCategoria(categoria)">
                {{categoria.nombre}}
            </a>
        </nav>
    </div>
</template>


<script>
export default {
    created() {
        axios.get('/api/categorias')
        .then(response=>{
            this.$store.commit('AGREGAR_CATEGORIAS', response.data)
        })
    },
    computed: {
        categorias(){
            return this.$store.getters.obtenerCategorias
        }
    },
    methods: {
        seleccionarCategoria(categoria){
            this.$store.commit('SELECCIONAR_CATEGORIA', categoria.slug)
        },
        seleccionarTodos(){
            axios.get('/api/establecimientos/')
            .then( response => {
                this.$store.commit('AGREGAR_ESTABLECIMIENTOS', response.data)
            })
        }
    }
}
</script>



<style scoped>
div {
  background-color: #6272d4;
}
nav a {
  color: white !important;;
  font-weight: bold;
  text-transform: uppercase;
  padding: 0.5rem 2rem;
  text-align: center;
  flex: 1;

}
nav a:hover {
  color: white;
  cursor: pointer;
  text-decoration: none;
  opacity: .5;
}
nav a:nth-child(1) {
  background-color: #a8004b;
}
nav a:nth-child(2) {
  background-color: #a000b7;
}
nav a:nth-child(3) {
  background-color: #591d03;
}
nav a:nth-child(4) {
  background-color: #ea6a00;
}
nav a:nth-child(5) {
  background-color: #edb220;
}
nav a:nth-child(6) {
  background-color: #dd0e3f;
}
nav a:nth-child(7) {
  background-color: #0448b5;
}
nav a:nth-child(8) {
  background-color: #00a81c;
}
</style>
