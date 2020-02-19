<template>
    <div>
        <div class="row">
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#moldalGuardar">Agregar empleado
            </button>
        </div>
        <br>
        <div class="row">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Salario en dólares</th>
                    <th scope="col">Salario en pesos</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Activo</th>
                    <th scope="col">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in empleados">
                    <th scope="row">{{item.codigo}}</th>
                    <td>{{item.nombre}}</td>
                    <td>{{item.salario_dolar}}</td>
                    <td>{{item.salario_pesos}}</td>
                    <td>{{item.correo}}</td>
                    <td>
                        <span v-if="item.activo == 1">Acivo</span>
                        <span v-if="item.activo == 0">Inacivo</span>
                    </td>
                    <td>
                        <div class="btn-group btn-group-sm" role="group" aria-label="...">
                            <button @click="detalle(item)" type="button" class="btn btn-info">
                                Ver
                            </button>
                            <button type="button" class="btn btn-warning" @click="modificar(item)">
                                Editar
                            </button>
                            <button v-if="item.activo === 1" type="button" class="btn btn-secondary"
                                    @click="activar(item)">
                                Desactivar
                            </button>
                            <button v-if="item.activo === 0" type="button" class="btn btn-secondary"
                                    @click="activar(item)">
                                Activar
                            </button>
                            <button type="button" class="btn btn-danger" @click="eliminar(item.id)">
                                Eliminar
                            </button>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="moldalGuardar" data-backdrop="static" tabindex="-1" role="dialog"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div v-if="btnAlert" class="alert alert-danger" role="alert">
                            <h5>{{mensaje}}</h5>
                            <ul v-if="errores">
                                <li v-for="(value, key) in errores">
                                    {{ value[0]}}
                                </li>
                            </ul>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label>Código*</label>
                                    <input class="form-control" type="text" v-model="empleado.codigo">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label>Nombre*</label>
                                    <input class="form-control" type="text" v-model="empleado.nombre">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label>Salario en dolares*</label>
                                    <input class="form-control" type="text" v-model="empleado.salario_dolar"
                                           @keyup="calcularPesos()">
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label>Salario en pesos*</label>
                                    <input class="form-control" type="text" v-model="empleado.salario_pesos">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label>Dirección*</label>
                                    <input class="form-control" type="text" v-model="empleado.direccion">
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label>Ciudad*</label>
                                    <input class="form-control" type="text" v-model="empleado.ciudad">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label>Telefono*</label>
                                    <input class="form-control" type="text" v-model="empleado.telefono">
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label>Correo*</label>
                                    <input class="form-control" type="text" v-model="empleado.correo">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" @click="guardar()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="moldalDetalle" data-backdrop="static" tabindex="-1" role="dialog"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackddropLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th scope="row">Código</th>
                                    <td>{{empleado.codigo}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nombre</th>
                                    <td>{{empleado.nombre}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Salario en dolares</th>
                                    <td>{{empleado.salario_dolar}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Salario en pesos</th>
                                    <td>{{empleado.salario_pesos}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Dirección</th>
                                    <td>{{empleado.direccion}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Ciudad</th>
                                    <td>{{empleado.ciudad}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Telefono</th>
                                    <td>{{empleado.telefono}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Correo</th>
                                    <td>{{empleado.correo}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Aumento estimado en 6 meses en pesos</th>
                                    <td>{{empleado.estimadoPesos}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Aumento estimado en 6 meses en dólares</th>
                                    <td>{{empleado.estimadoDolar}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secundary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "EmpleadosComponent",
        data() {
            return {
                empleados: [],
                empleado: {
                    codigo: undefined,
                    nombre: undefined,
                    salario_dolar: undefined,
                    salario_pesos: undefined,
                    direccion: undefined,
                    ciudad: undefined,
                    telefono: undefined,
                    correo: undefined,
                },
                valorDolar: undefined,
                mensaje:undefined,
                errores:[],
                btnAlert:false
            }
        },
        created() {
            this.buscar();
            axios.get(
                'http://www.banxico.org.mx/SieAPIRest/service/v1/series/SF43718/datos/2020-02-19/2020-02-19',
                {
                    method: 'GET',
                    mode: 'no-cors',
                    headers: {
                    'Access-Control-Allow-Origin': '*',
                        'Content-Type': 'application/json',
                        'Authorization': 'Bmx-Token 0fce7d85c76c9afa6f8ef05f95d50a11c62573c637d28706e28f2a81e84264e5',
                    },
                    withCredentials: true,
                    credentials: 'same-origin'
                })
                .then((res) => {
                    console.log(res);
                })
        },
        methods: {
            buscar() {
                axios.get('/api/empleados')
                    .then((res) => {
                        this.empleados = res.data
                    })
            },
            guardar() {
                axios.post('/api/empleados', this.empleado)
                    .then((res) => {
                        $('#moldalGuardar').modal('hide')
                        this.buscar();
                    })
                    .catch(error => {
                        this.btnAlert = true
                        this.mensaje = error.response.data.message || error.message
                        this.errores = error.response.data.errors
                        reject(error)
                    })
            },
            modificar(value) {
                const select = JSON.stringify(value)
                this.empleado = JSON.parse(select);
                $('#moldalGuardar').modal('show')
            },
            detalle(value) {
                const select = JSON.stringify(value)
                this.empleado = JSON.parse(select);
                this.empleado.estimadoPesos = ((this.empleado.salario_pesos*.05)*6).toFixed(2)
                this.empleado.estimadoDolar = ((this.empleado.salario_dolar*.05)*6).toFixed(2)
                $('#moldalDetalle').modal('show')
            },
            eliminar(id) {
                axios.delete('/api/empleados/' + id)
                    .then((res) => {
                        this.buscar();
                    })
            },
            activar(value) {
                axios.post('/api/empleados/activo', value)
                    .then((res) => {
                        this.buscar();
                    })
            }
        }

    }
</script>

<style scoped>

</style>
