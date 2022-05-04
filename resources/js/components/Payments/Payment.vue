<template>
    <div>
        <h1 class="text-center">Listado de pagos</h1>
        <hr>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Id Asignación</th>
                    <th scope="col">Contrapartida</th>
                    <th scope="col">Entidad</th>
                    <th scope="col">Evidencia</th>
                    <th scope="col">Fecha Pago</th>
                    <th scope="col">Fecha Regpago</th>
                    <th scope="col">Estado</th>
                    <th scope="col" colspan="2" class="text-center">Operaciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="payment in payments" :key="payment.id">
                        <th scope="row">{{payment.id}}</th>
                        <td><button @click="link(payment.assignment)" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModalToggle2">Ver</button></td>
                        <td>{{payment.contrapartida}}</td>
                        <td>{{payment.entidad}}</td>
                        <td>{{payment.evidencia}}</td>
                        <td>{{payment.fechapago}}</td>
                        <td>{{payment.fecharegpago}}</td>
                        <td>{{payment.estado}}</td>
                        <td><button @click="update=true; openModal(payment);" class="btn btn-warning">Editar</button></td>
                        <td><button @click="eliminar(payment.id)" class="btn btn-danger">Eliminar</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Button trigger modal -->
        <button @click="update=false; openModal();" class="btn btn-primary mt-4" >
        Agregar Pago
        </button>

        <!-- Modal -->
        <div class="modal" :class="{show:modal}">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{titleModal}}</h5>
                        <button @click="closeModal();" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="save">
                            <div class="form-group">
                                <label for="Asignacion"></label>
                                <input v-model="payment.assignment" type="text" class="form-control" id="Asignacion" placeholder="Asignación Cliente" name="">
                                <label for="Contrapartida"></label>
                                <input v-model="payment.contrapartida" type="text" class="form-control" id="Contrapartida" placeholder="Contrapartida Pago" name="">
                                <label for="Entidad"></label>
                                <input v-model="payment.entidad" type="text" class="form-control" id="Entidad" placeholder="Entidad Pago" name="">
                                <label for="Evidencia"></label>
                                <input v-model="payment.evidencia" type="text" class="form-control" id="Evidencia" placeholder="Evidencia Pago" name="">
                                <label for="FechaPago"></label>
                                <input v-model="payment.fechapago" type="text" class="form-control" id="FechaPago" placeholder="Fecha Pago" name="">
                                <label for="FechaRegpago"></label>
                                <input v-model="payment.fecharegpago" type="email" class="form-control" id="FechaRegpago" placeholder="Fecha Regpago" name="">
                                <label for="estadoPago"></label>
                                <input v-model="payment.estado" type="text" class="form-control" id="estadoPago" placeholder="Estado Pago" name="">
                            </div>
                            <div class="row g-3 justify-content-center mt-auto">
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-success">Guardar</button>
                                    <button type="button" @click="closeModal();" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal2 -->
        <div class="modal fade" :class="{show:modal2}" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel2">Asignación</h5>
                        <button type="button" @click="modal2=0" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div>
                                <label>Detalle Asignación: </label>
                                {{assignments.detalle}}
                            </div>
                            <div>
                                <label>Fecha Asignación: </label>
                                {{assignments.fecha}}
                            </div>
                            <div>
                                <label>Estado Asignación: </label>
                                {{assignments.estado}}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button @click="modal2=0" class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Atrás</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        data(){
            return{
                payment:{
                    assignment:'',
                    contrapartida:'',
                    entidad:'',
                    evidencia:'',
                    fechapago:'',
                    fecharegpago:'',
                    estado:''
                },
                id:0,
                update:true,
                modal:0,
                modal2:0,
                titleModal:' ',
                payments:[],
                assignments:[],
            }
        },
    methods:{
        async list(){
            const res=await axios.get('/api/assignments/1/payments');
            this.payments=res.data;
        },
        async eliminar(id){
            const res=await axios.delete('/api/assignments/1/payments/'+id);
            this.list();
        },
        async link(url){
            const res=await axios.get(url);
            this.assignments=res.data;
            this.modal2=1;
        },
        async save(){
            if (this.update) {
                const res=await axios.put('/api/assignments/1/payments/'+this.id, this.payment)
            } else {
                const res=await axios.post('/api/assignments/1/payments', this.payment);
            }
            this.closeModal();
            this.list();
        },
        openModal(data={}){
            this.modal=1;
            if(this.update){
                this.id=data.id;
                this.titleModal="Modificar Pago";
                this.payment.assignment=data.assignment;
                this.payment.contrapartida=data.contrapartida;
                this.payment.entidad=data.entidad;
                this.payment.evidencia=data.evidencia;
                this.payment.fechapago=data.fechapago;
                this.payment.fecharegpago=data.fecharegpago;
                this.payment.estado=data.estado;
            }else{
                this.id=0;
                this.titleModal="Crear Pago";
                this.payment.assignment='';
                this.payment.contrapartida='';
                this.payment.entidad='';
                this.payment.evidencia='';
                this.payment.fechapago='';
                this.payment.fecharegpago='';
                this.payment.estado='';
            }
        },
        closeModal(){
            this.modal=0;
        }
    },
    created(){
        this.list();
    }

    }
</script>

<style>
.show{
    display:list-item;
    opacity:1;
    background:rgba (44,38,75,0.849)
}
</style>
