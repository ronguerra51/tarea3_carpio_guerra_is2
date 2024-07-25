const btnGuardar = document.getElementById('btnGuardar')
const btnModificar = document.getElementById('btnModificar')
const btnBuscar = document.getElementById('btnBuscar')
const btnCancelar = document.getElementById('btnCancelar')
const btnLimpiar = document.getElementById('btnLimpiar')
const tablaAreas = document.getElementById('tablaAreas')
const formulario = document.querySelector('form')

btnModificar.parentElement.style.display = 'none'
btnCancelar.parentElement.style.display = 'none'

const getAreas = async () => {
    const nombre = formulario.area_nombre.value
     const url = `/tarea3_carpio_guerra_is2/controllers/areas/index.php?area_nombre=${nombre}`
    const config = {
        method: 'GET'
    }

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        tablaAreas.tBodies[0].innerHTML = ''
        const fragment = document.createDocumentFragment()
        let contador = 1;
        console.log(data);
        if (respuesta.status == 200) {
            Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                icon: "success",
                title: 'Areas encontradas',
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            }).fire();

            if (data.length > 0) {
                data.forEach(area => {
                    const tr = document.createElement('tr')
                    const celda1 = document.createElement('td')
                    const celda2 = document.createElement('td')
                    const celda3 = document.createElement('td')
                    const celda4 = document.createElement('td')

                    const buttonModificar = document.createElement('button')
                    const buttonEliminar = document.createElement('button')

                    celda1.innerText = contador;
                    celda2.innerText = area.area_nombre;

                    buttonModificar.textContent = 'Modificar'
                    buttonModificar.classList.add('btn', 'btn-warning', 'w-100')
                    buttonModificar.addEventListener('click', () => llenardatos(area))

                    buttonEliminar.textContent = 'Eliminar';
                    buttonEliminar.classList.add('btn', 'btn-danger', 'w-100');
                    buttonEliminar.addEventListener('click', () => eliminarArea(area.area_id));

                    celda3.appendChild(buttonModificar)
                    celda4.appendChild(buttonEliminar)

                    tr.appendChild(celda1)
                    tr.appendChild(celda2)
                    tr.appendChild(celda3)
                    tr.appendChild(celda4)
                    fragment.appendChild(tr);

                    contador++
                });

            } else {
                const tr = document.createElement('tr')
                const td = document.createElement('td')
                td.innerText = 'No hay Areas registrados'
                td.colSpan = 5;

                tr.appendChild(td)
                fragment.appendChild(tr)
            }
        } else {
            console.log('hola');
        }

        tablaAreas.tBodies[0].appendChild(fragment)
    } catch (error) {
        console.log(error);
    }
}

getAreas();


const guardarArea = async (e) => {
    e.preventDefault();
    btnGuardar.disabled = true;

    const url = '/tarea3_carpio_guerra_is2/controllers/areas/index.php'
    const formData = new FormData(formulario)
    formData.append('tipo', 1)
    formData.delete('area_id')
    const config = {
        method: 'POST',
        body: formData
    }

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        const { mensaje, codigo, detalle } = data
        Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            icon: "success",
            title: mensaje,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        }).fire();
        // alert(mensaje)
        // console.log(data);
        if (codigo == 1 && respuesta.status == 200) {
            getAreas();
            formulario.reset();
        } else {
            console.log(detalle);
        }

    } catch (error) {
        console.log(error);
    }
    btnGuardar.disabled = false;
};

const llenardatos = (area) => {

    formulario.area_id.value = area.area_id
    formulario.area_nombre.value = area.area_nombre
    btnBuscar.parentElement.style.display = 'none'
    btnGuardar.parentElement.style.display = 'none'
    btnLimpiar.parentElement.style.display = 'none'
    btnModificar.parentElement.style.display = ''
    btnCancelar.parentElement.style.display = ''

};

const modificar = async (e) => {
    e.preventDefault();
    btnModificar.disabled = true;

    const url = '/tarea3_carpio_guerra_is2/controllers/areas/index.php';
    const formData = new FormData(formulario);
    formData.append('tipo', 2);
    formData.append('area_id', formulario.area_id.value);
    const config = {
        method: 'POST',
        body: formData
    };

    try {
        console.log('Enviando datos:', ...formData.entries());
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log('Respuesta recibida:', data);
        const { mensaje, codigo, detalle } = data;
        if (respuesta.ok && codigo === 1) {
            Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                icon: "success",
                title: mensaje,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            }).fire();
            formulario.reset()
            getAreas();
            btnBuscar.parentElement.style.display = ''
            btnGuardar.parentElement.style.display = ''
            btnLimpiar.parentElement.style.display = ''
            btnModificar.parentElement.style.display = 'none'
            btnCancelar.parentElement.style.display = 'none'

        } else {
            console.log('Error:', detalle);
            Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                icon: "error",
                title: 'Error al guardar',
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            }).fire();
        }
    } catch (error) {
        console.log('Error de conexión:', error);
        Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            icon: "error",
            title: 'Error de conexión',
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        }).fire();
    }
    btnModificar.disabled = false;
    btnCancelar.disabled = false;
};

const eliminarArea = async (area_id) => {
    const confirmacion = await Swal.fire({
        title: '¿Estás seguro de eliminar a este area?',
        text: '',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo'
    });

    // Verificar si el usuario confirmó la eliminación
    if (confirmacion.isConfirmed) {
        const url = '/tarea3_carpio_guerra_is2/controllers/areas/index.php';
        const formData = new FormData();
        formData.append('area_id', area_id);
        formData.append('tipo', 3);
        const config = {
            method: 'POST',
            body: formData
        };

        try {
            const respuesta = await fetch(url, config);
            const data = await respuesta.json();
            console.log('Respuesta recibida:', data);
            const { mensaje, codigo } = data;
            if (respuesta.ok && codigo === 1) {
                getAreas();
                Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    icon: "success",
                    title: mensaje,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                }).fire();
                // getclientes();
            } else {
                Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    icon: "error",
                    title: 'Error al eliminar',
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                }).fire();
            }
        } catch (error) {
            console.log('Error de conexión:', error);
            Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                icon: "error",
                title: 'Error de conexión',
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            }).fire();
        }
    }
}

const cancelar = (area) => {

    formulario.area_id.value = ''
    formulario.area_nombre.value = ''
    btnBuscar.parentElement.style.display = ''
    btnGuardar.parentElement.style.display = ''
    btnLimpiar.parentElement.style.display = ''
    btnModificar.parentElement.style.display = 'none'
    btnCancelar.parentElement.style.display = 'none'

};

formulario.addEventListener('submit', guardarArea)
btnBuscar.addEventListener('click', getAreas)
btnModificar.addEventListener('click', modificar)
btnCancelar.addEventListener('click', cancelar)