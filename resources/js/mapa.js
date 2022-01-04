import { OpenStreetMapProvider } from 'leaflet-geosearch';
const provider = new OpenStreetMapProvider();


if(document.querySelector('#mapa')){
    document.addEventListener('DOMContentLoaded', () => {

        const lat = document.querySelector('#lat').value === '' ? 20.588100543994297 : document.querySelector('#lat').value;
        const lng = document.querySelector('#lng').value === '' ? -100.38769729529736 : document.querySelector('#lng').value;

        const mapa = L.map('mapa').setView([lat, lng], 16);

        // Eliminar pines previos

        let markers = new L.featureGroup().addTo(mapa)

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapa);

        let marker;

        // agregar el pin
        marker = new L.marker([lat, lng], {
            draggable: true,
            autoPan: true
        }).addTo(mapa);

        //
        markers.addLayer(marker)

        // GeoCode Service
        const geocodeService = L.esri.Geocoding.geocodeService({
            apikey: 'AAPK4ec59c6faf364085ad803ead1bca4f35pRBqNS3g4_QiobSZkAneo2nBsHX7YuR3Nnn87ptr3BqReRT0LSMceZ_dDVJ1aPpE'
        })

        // Buscador de direcciones
        const buscador = document.querySelector('#formbuscador')
        buscador.addEventListener('blur', buscarDireccion)

        reubicarPin(marker)


        function reubicarPin(marker){
            marker.on('moveend', function(e){
                marker = e.target
                const posicion = marker.getLatLng();
                // Centrar automaticamente
                mapa.panTo( new L.LatLng(posicion.lat, posicion.lng))

                // Reverse Geocoding
                geocodeService.reverse().latlng(posicion, 16).run(function(error, resultado){
                    // console.log(error)
                    console.log(resultado.address)

                    marker.bindPopup(resultado.address.LongLabel)
                    marker.openPopup()


                    // Llenar camos
                    llenarInputs(resultado)
                })

            })
        }

        function buscarDireccion(e){


            if(e.target.value.length > 5){
               provider.search({query: e.target.value + ' Queretaro MX '})
                .then( resultado =>{
                    if(resultado[0]){
                        // Limpiar los pines previos

                        markers.clearLayers();

                         // Reverse Geocoding
                        geocodeService.reverse().latlng(resultado[0].bounds[0], 16).run(function(error, resultado){
                            // Llenar los inputs
                                llenarInputs(resultado)
                            // Centaras el mapa
                                mapa.setView(resultado.latlng)
                            //Agregar el pin

                                marker = new L.marker(resultado.latlng, {
                                            draggable: true,
                                            autoPan: true
                                        }).addTo(mapa);

                            // Asignar el contenedor de markers el nuevo pin

                                markers.addLayer(marker)
                            // Mover el pin

                            reubicarPin(marker)
                        })
                    }
                })
                .catch( error => {
                    console.log(error);
                })
            }
        }

        function llenarInputs(resultado){
            document.querySelector('#direccion').value = resultado.address.Address || ''
            document.querySelector('#colonia').value = resultado.address.Neighborhood || ''

            document.querySelector('#lat').value = resultado.latlng.lat || ''
            document.querySelector('#lng').value = resultado.latlng.lng || ''
        }

    });
}
