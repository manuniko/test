function cargarOpciones() {
    
    fetch('api/obras-sociales')
        .then(response => response.json())
        .then(data => {
            
            const obraSocialSelect = document.getElementById('obra_social');
            if (obraSocialSelect) {
                
                obraSocialSelect.innerHTML = '';

                const optionVacio = document.createElement('option');
                optionVacio.value = '';
                optionVacio.disabled = true;
                optionVacio.selected = true;
                optionVacio.textContent = 'Seleccione una obra social';
                obraSocialSelect.appendChild(optionVacio);

                data.forEach(obra => {
                    const option = document.createElement('option');
                    option.value = obra.id;
                    option.textContent = obra.nombre;
                    obraSocialSelect.appendChild(option);
                });
            }
        })
        .catch(error => console.error('Error al cargar obras sociales: ', error));

    
    fetch('api/especialidades')
        .then(response => {
            if (!response.ok) {
                throw new Error('Red no disponible');
            }
            return response.json();
        })
        .then(data => {
            const especialidadSelect = document.getElementById('especialidad');
            if (especialidadSelect) {
                
                especialidadSelect.innerHTML = '';
                const optionVacio = document.createElement('option');
                optionVacio.value = '';
                optionVacio.disabled = true;
                optionVacio.selected = true;
                optionVacio.textContent = 'Seleccione una especialidad';
                especialidadSelect.appendChild(optionVacio);

                data.forEach( especialidad => {
                    const option = document.createElement('option');
                    option.value = especialidad.id;
                    option.textContent = especialidad.nombre;
                    especialidadSelect.appendChild(option);
                });
            }
        })
        .catch(error => console.error('Error al cargar especialidades: ', error));
}

document.addEventListener("DOMContentLoaded", function() {
    const campos = ['nombre_completo', 'dni', 'obra_social', 'especialidad'];

    campos.forEach(campo => {
        const input = document.getElementById(campo);

        if (input) {
            input.addEventListener('input', function() {
                console.log(input.value);
                validarCampo(campo, input.value);
            });
        }
    });
});

function validarCampo(campo, valor) {
    fetch('./validar_campos.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ campo: campo, valor: valor })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        const errorElemento = document.getElementById(`error_${campo}`);
        const input = document.getElementById(campo);
        
        if (data.valido) {
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
            errorElemento.textContent = '';
        } else {
            input.classList.remove('is-valid');
            input.classList.add('is-invalid');
            errorElemento.textContent = data.mensaje;
        }
    })
    .catch(error => console.error('Error en la validación:', error));
}


function showToastError(message) {
    const toastElement = document.getElementById('errorToast');
    const toastMessageElement = document.getElementById('errorToastMessage');
    toastMessageElement.innerText = message;
    const toast = new bootstrap.Toast(toastElement);
    toast.show();
}

function showToastSuccess(message) {
    const toastElement = document.getElementById('successToast');
    const toastMessageElement = document.getElementById('successToastMessage');
    toastMessageElement.innerText = message;
    const toast = new bootstrap.Toast(toastElement);
    toast.show();
    setTimeout(() => {
        window.location.reload();
    }, 3000);
}

async function validarFormulario(e) {
    e.preventDefault();

    const formData = new FormData(document.getElementById('form_solicitud'));

    fetch("./procesar_form.php", {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            console.log(response.error);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            showToastSuccess(data.success);
        }
        if (data.error) {
            showToastError(data.error);
        }
    })
    .catch(error => console.error(error))

}

document.addEventListener('DOMContentLoaded', function () {
    const formSolicitud = document.getElementById('form_solicitud');
    if (formSolicitud) {
        formSolicitud.addEventListener('submit', validarFormulario);
    }
} );

window.onload = cargarOpciones;