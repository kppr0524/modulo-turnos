
document.addEventListener('DOMContentLoaded', () => {
    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    // Crear turno
    document.getElementById('formCrearTurno').addEventListener('submit', async function(e) {
        e.preventDefault();
        const form = e.target;
        const nombre = form.nombre.value;

        const res = await fetch('/turnos', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf
            },
            body: JSON.stringify({ nombre })
        });

        const data = await res.json();
        if (res.ok) {
            const row = `
                <tr id="turno-${data.turno.id}">
                    <td>${data.turno.id}</td>
                    <td class="nombre">${data.turno.nombre}</td>
                    <td>
                        <button class="btn btn-sm btn-warning" onclick="abrirEditar(${data.turno.id})">Editar</button>
                        <button class="btn btn-sm btn-danger" onclick="eliminarTurno(${data.turno.id})">Eliminar</button>
                    </td>
                </tr>
            `;
            document.querySelector('#tablaTurnos tbody').insertAdjacentHTML('beforeend', row);
            form.reset();
            bootstrap.Modal.getInstance(document.getElementById('modalNuevoTurno')).hide();
        }
    });

    // Editar turno
    document.getElementById('formEditarTurno').addEventListener('submit', async function(e) {
        e.preventDefault();
        const form = e.target;
        const id = form.id.value;
        const nombre = form.nombre.value;

        const res = await fetch(`/turnos/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf
            },
            body: JSON.stringify({ nombre })
        });

        const data = await res.json();
        if (res.ok) {
            const row = document.getElementById(`turno-${id}`);
            row.querySelector('.nombre').textContent = data.turno.nombre;
            bootstrap.Modal.getInstance(document.getElementById('modalEditarTurno')).hide();
        }
    });

    // Eliminar turno
    window.eliminarTurno = async function(id) {
        if (!confirm('¿Eliminar este turno?')) return;

        const res = await fetch(`/turnos/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrf
            }
        });

        if (res.ok) {
            document.getElementById(`turno-${id}`).remove();
        }
    };

    // Abrir modal de edición
    window.abrirEditar = async function(id) {
        const res = await fetch(`/turnos/${id}`);
        const turno = await res.json();
        const form = document.getElementById('formEditarTurno');
        form.id.value = turno.id;
        form.nombre.value = turno.nombre;
        const modal = new bootstrap.Modal(document.getElementById('modalEditarTurno'));
        modal.show();
    };
});

document.addEventListener('DOMContentLoaded', () => {
    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    // Formulario de producción
    const formRegistro = document.getElementById('formRegistro');
    formRegistro?.addEventListener('submit', async function (e) {
        e.preventDefault();

        const data = {
            fecha: this.fecha.value,
            maquina: this.maquina.value,
            proyecto: this.proyecto.value,
            turno_id: this.turno_id.value
        };

        const res = await fetch('/registro', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf
            },
            body: JSON.stringify(data)
        });

        if (res.ok) {
            cargarRegistros();
            this.reset();
        } else {
            const error = await res.json();
            alert('Error al guardar: ' + JSON.stringify(error.errors));
        }
    });

    // Filtro por turno
    const filtro = document.getElementById('filtroTurno');
    filtro?.addEventListener('change', () => {
        cargarRegistros(filtro.value);
    });

    async function cargarRegistros(turnoId = '') {
        const res = await fetch(`/registros${turnoId ? '?turno_id=' + turnoId : ''}`);
        const registros = await res.json();

        const tbody = document.querySelector('#tablaRegistros tbody');
        tbody.innerHTML = '';

        registros.forEach(r => {
            tbody.innerHTML += `
                <tr>
                    <td>${r.fecha}</td>
                    <td>${r.maquina}</td>
                    <td>${r.proyecto}</td>
                    <td>${r.turno.nombre}</td>
                </tr>
            `;
        });
    }

    async function cargarRegistros(turnoId = '') {
        const res = await fetch(`/registros${turnoId ? '?turno_id=' + turnoId : ''}`);
        const registros = await res.json();

        const tbody = document.querySelector('#tablaRegistros tbody');
        tbody.innerHTML = '';

        registros.forEach(r => {
            tbody.innerHTML += `
                <tr>
                    <td>${r.fecha}</td>
                    <td>${r.maquina}</td>
                    <td>${r.proyecto}</td>
                    <td>${r.turno.nombre}</td>
                    <td>
                        <button class="btn btn-sm btn-warning" onclick="editarRegistro(${r.id})">Editar</button>
                        <button class="btn btn-sm btn-danger" onclick="eliminarRegistro(${r.id})">Eliminar</button>
                    </td>
                </tr>
            `;
        });
    }

    // Editar registro
    document.getElementById('formEditarRegistro').addEventListener('submit', async function(e) {
        e.preventDefault();
        const form = e.target;

        const data = {
            fecha: form.fecha.value,
            maquina: form.maquina.value,
            proyecto: form.proyecto.value,
            turno_id: form.turno_id.value
        };

        const res = await fetch(`/registros/${form.id.value}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf
            },
            body: JSON.stringify(data)
        });

        if (res.ok) {
            bootstrap.Modal.getInstance(document.getElementById('modalEditarRegistro')).hide();
            cargarRegistros(); // Refresca la tabla
        } else {
            const error = await res.json();
            alert('Error al actualizar: ' + JSON.stringify(error.errors));
        }
    });

    // Abrir modal de edición
    window.editarRegistro = async function(id) {
        const res = await fetch(`/registros/${id}`);
        const data = await res.json();

        const form = document.getElementById('formEditarRegistro');
        form.id.value = data.id;
        form.fecha.value = data.fecha;
        form.maquina.value = data.maquina;
        form.proyecto.value = data.proyecto;
        form.turno_id.value = data.turno_id;

        const modal = new bootstrap.Modal(document.getElementById('modalEditarRegistro'));
        modal.show();
    };

    // Eliminar registro
    window.eliminarRegistro = async function(id) {
        if (!confirm('¿Eliminar este registro?')) return;

        const res = await fetch(`/registros/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrf
            }
        });

        if (res.ok) {
            cargarRegistros(); // recarga tabla
        }
    };

    // Cargar registros al inicio
    cargarRegistros();
});
