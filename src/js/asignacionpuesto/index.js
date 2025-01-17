const formAsignacion = document.querySelector('form');
const tablaAsignacionPuesto = document.getElementById('tablaAsignacionPuesto');

const getAsignaciones = async () => {
    const url = '/tarea3_carpio_guerra_is2/controllers/asignacion/index.php';
    const config = {
        method: 'GET'
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        tablaAsignacionPuesto.tBodies[0].innerHTML = '';
        const fragment = document.createDocumentFragment();
        let contador = 1;

        if (respuesta.status === 200) {
            Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                icon: "success",
                title: 'Asignaciones cargadas',
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            }).fire();

            if (data.length > 0) {
                data.forEach(asignacion => {
                    const tr = document.createElement('tr');
                    const celda1 = document.createElement('td');
                    const celda2 = document.createElement('td');
                    const celda3 = document.createElement('td');
                    const celda4 = document.createElement('td');
                    const buttonEliminar = document.createElement('button');

                    celda1.innerText = contador;
                    celda2.innerText = asignacion.empleado_nombre;
                    celda3.innerText = asignacion.puesto_nombre;

                    buttonEliminar.textContent = 'Eliminar';
                    buttonEliminar.classList.add('btn', 'btn-danger', 'w-100');
                    buttonEliminar.addEventListener('click', () => eliminarAsignacion(asignacion.asignacionpuesto_id));

                    celda4.appendChild(buttonEliminar);

                    tr.appendChild(celda1);
                    tr.appendChild(celda2);
                    tr.appendChild(celda3);
                    tr.appendChild(celda4);
                    fragment.appendChild(tr);

                    contador++;
                });
            } else {
                const tr = document.createElement('tr');
                const td = document.createElement('td');
                td.innerText = 'No hay asignaciones registradas';
                td.colSpan = 5;

                tr.appendChild(td);
                fragment.appendChild(tr);
            }
        }

        tablaAsignacionPuesto.tBodies[0].appendChild(fragment);
    } catch (error) {
        console.error('Error:', error);
    }
};

const guardarAsignacion = async (e) => {
    e.preventDefault();
    const url = '/tarea3_carpio_guerra_is2/controllers/asignacion/index.php';
    const formData = new FormData(formAsignacion);
    formData.append('tipo', '1');
    const config = {
        method: 'POST',
        body: formData
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        const { mensaje, codigo } = data;

        Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            icon: codigo === 1 ? 'success' : 'error',
            title: mensaje,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        }).fire();

        if (codigo === 1) {
            getAsignaciones();
            formAsignacion.reset();
        }
    } catch (error) {
        console.error('Error:', error);
    }
};


const eliminarAsignacion = async (id) => {
    const confirmacion = await Swal.fire({
        title: '¿Estás seguro de eliminar esta asignación?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar'
    });

    if (confirmacion.isConfirmed) {
        const url = '/tarea3_carpio_guerra_is2/controllers/asignacion/index.php';
        const formData = new FormData();
        formData.append('tipo', '3'); 
        formData.append('asignacionpuesto_id', id);
        const config = {
            method: 'POST',
            body: formData
        };

        try {
            const respuesta = await fetch(url, config);
            const data = await respuesta.json();
            const { mensaje, codigo } = data;

            Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                icon: codigo === 1 ? 'success' : 'error',
                title: mensaje,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            }).fire();

            if (codigo === 1) {
                getAsignaciones();
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }
};

formAsignacion.addEventListener('submit', guardarAsignacion);

getAsignaciones();
