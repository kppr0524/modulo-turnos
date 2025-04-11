<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Turnos Día y Noche</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<script src="{{ asset('js/turnos.js') }}"></script>

<body class="bg-light p-4">

    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="p-3 bg-white rounded shadow-sm">
                    <h2 class="mb-4">Crear Turnos</h2>

                    <div class="text-end">
                        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalNuevoTurno">
                            Crear un Turno
                        </button>
                    </div>


                    <table class="table table-bordered table-striped" id="tablaTurnos">
                        <thead class="table-dark">
                            <tr>
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width: 10%;">ID</th>
                                        <th style="width: 70%;">Nombre</th>
                                        <th style="width: 20%;">Acciones</th>
                                    </tr>
                                </thead>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($turnos as $turno)
                                <tr id="turno-{{ $turno->id }}">
                                    <td>{{ $turno->id }}</td>
                                    <td class="nombre">{{ $turno->nombre }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning"
                                            onclick="abrirEditar({{ $turno->id }})">Editar</button>
                                        <button class="btn btn-sm btn-danger"
                                            onclick="eliminarTurno({{ $turno->id }})">Eliminar</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="p-3 bg-white rounded shadow-sm">

                    <h2 class="mb-3">Crear registro de turnos</h2>

                    <form id="formRegistro" class="row g-3 mb-4">
                        <div class="col-md-3">
                            <label class="form-label">Fecha</label>
                            <input type="date" name="fecha" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Máquina</label>
                            <input type="text" name="maquina" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Proyecto</label>
                            <input type="text" name="proyecto" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Turno</label>
                            <select name="turno_id" class="form-select" required>
                                @foreach ($turnos as $turno)
                                    <option value="{{ $turno->id }}">{{ $turno->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-end">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary mb-3">Guardar Registro</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-12 mb-4">
                <div class="p-3 bg-white rounded shadow-sm">
                    <h3>Filtrar Turnos</h3>
                    <select id="filtroTurno" class="form-select w-auto mb-3">
                        <option value="">Todos</option>
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno->id }}">{{ $turno->nombre }}</option>
                        @endforeach
                    </select>

                    <table class="table table-bordered" id="tablaRegistros">
                        <thead class="table-secondary">
                            <tr>
                                <th style="width: 20%;">Fecha</th>
                                <th style="width: 20%;">Máquina</th>
                                <th style="width: 20%;">Proyecto</th>
                                <th style="width: 20%;">Turno</th>
                                <th style="width: 20%;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
    </div>
    </div>
    <!-- Modal Crear -->
    <div class="modal fade" id="modalNuevoTurno" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formCrearTurno">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Nuevo Turno</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label>Nombre del Turno</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">Guardar</button>
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal fade" id="modalEditarTurno" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formEditarTurno">
                <input type="hidden" name="id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Turno</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label>Nombre del Turno</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Actualizar</button>
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Editar Registros -->
    <div class="modal fade" id="modalEditarRegistro" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formEditarRegistro">
                <input type="hidden" name="id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Registro</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label class="form-label">Fecha</label>
                        <input type="date" name="fecha" class="form-control mb-2" required>

                        <label class="form-label">Máquina</label>
                        <input type="text" name="maquina" class="form-control mb-2" required>

                        <label class="form-label">Proyecto</label>
                        <input type="text" name="proyecto" class="form-control mb-2" required>

                        <label class="form-label">Turno</label>
                        <select name="turno_id" class="form-select" required>
                            @foreach ($turnos as $turno)
                                <option value="{{ $turno->id }}">{{ $turno->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Actualizar</button>
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
