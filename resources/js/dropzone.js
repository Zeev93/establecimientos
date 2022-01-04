const { default: axios } = require("axios");

document.addEventListener('DOMContentLoaded', () => {
    Dropzone.autoDiscover = false;
    const dropzone = new Dropzone('div#dropzone', {
        url: '/imagenes/store',
        dirctDefaultMessage: 'Sube hasta 10 imagenes',
        maxFiles: 10,
        required: true,
        acceptedFiles: ".png, .jpg, .gif, .bmp, .jpeg",
        addRemoveLinks: true,
        dictRemoveFile: "Eliminar Imagen",
        headers: {
            'X-CSRF-TOKEN' : document.querySelector('meta[name=csrf-token]').content
        },
        init: function(){
            const galeria = document.querySelectorAll('.galeria');
            if (galeria.length > 0){
                galeria.forEach(imagen => {
                    const imagenPublicada = {}
                    imagenPublicada.size = 1;
                    imagenPublicada.name = imagen.value
                    imagenPublicada.nombreServidor = imagen.value

                    this.options.addedfile.call(this, imagenPublicada)
                    this.options.thumbnail.call(this, imagenPublicada, `/storage/${imagenPublicada.name}`)
                })
            }
        },
        success: function(file, response){
            console.log(response);
            file.nombreServidor = response.archivo;
        },
        sending: function(file, xhr, formData) {
            formData.append('uuid', document.querySelector('#uuid').value )

        },
        removedfile: function(file, response){

            const params = {
                imagen: file.nombreServidor,
                uuid: document.querySelector('#uuid').value
            }

            axios.post('/imagenes/destroy', params)
                .then( response => {
                    console.log(response);

                    // Eliminar del DOM

                    file.previewElement.parentNode.removeChild(file.previewElement)
                })
        }
    })
})
