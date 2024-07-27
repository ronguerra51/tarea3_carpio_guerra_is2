const tablaOrganizacion = document.getElementById('tablaOrganizacion');

const getOrganizacion = async () => {
    const url = '/tarea3_carpio_guerra_is2/controllers/organizacion/index.php';
    const config = {
        method: 'GET'
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        tablaOrganizacion.tBodies[0].innerHTML = '';
        const fragment = document.createDocumentFragment();
        let contador = 1;

        if (respuesta.ok) {
            Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                icon: "success",
                title: 'Organización cargada',
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            }).fire();

            if (data.length > 0) {
                data.forEach(organizacion => {
                    const tr = document.createElement('tr');
                    const celda1 = document.createElement('td');
                    const celda2 = document.createElement('td');
                    const celda3 = document.createElement('td');
                    const celda4 = document.createElement('td');
                    const celda5 = document.createElement('td');
                    const celda6 = document.createElement('td');
                    const celda7 = document.createElement('td');

                    celda1.innerText = contador;
                    celda2.innerText = organizacion.empleado_nombre;
                    celda3.innerText = organizacion.puesto_nombre;
                    celda4.innerText = organizacion.puesto_sueldo;
                    celda5.innerText = organizacion.empleado_edad;
                    celda6.innerText = organizacion.empleado_sexo;
                    celda7.innerText = organizacion.area_nombre;

                    tr.appendChild(celda1);
                    tr.appendChild(celda2);
                    tr.appendChild(celda3);
                    tr.appendChild(celda4);
                    tr.appendChild(celda5);
                    tr.appendChild(celda6);
                    tr.appendChild(celda7);

                    fragment.appendChild(tr);
                    contador++;
                });
            } else {
                const tr = document.createElement('tr');
                const td = document.createElement('td');
                td.innerText = 'NO EXISTE ORGANIZACION';
                td.colSpan = 7;

                tr.appendChild(td);
                fragment.appendChild(tr);
            }
        } else {
            console.error('Error en la respuesta:', respuesta.statusText);
        }

        tablaOrganizacion.tBodies[0].appendChild(fragment);
    } catch (error) {
        console.error('Error:', error);
    }
};

getOrganizacion();
