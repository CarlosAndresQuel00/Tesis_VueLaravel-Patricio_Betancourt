<template>
    <div>
        <h1 class="text-center">Listado de reservas</h1>
        <hr>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Id Asignación</th>
                    <th scope="col">Id Espacio Compartido</th>
                    <th scope="col">Detalle</th>
                    <th scope="col">Fecha Inicio</th>
                    <th scope="col">Fecha Final</th>
                    <th scope="col">Estado</th>
                    <th scope="col" colspan="2" class="text-center">Operaciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="reserve in reserves" :key="reserve.id">
                        <th scope="row">{{reserve.id}}</th>
                        <td>{{reserve.assig_id}}</td>
                        <td>{{reserve.ec_id}}</td>
                        <td>{{reserve.detalle_rsv}}</td>
                        <td>{{reserve.fechahi_rsv}}</td>
                        <td>{{reserve.fechahf_rsv}}</td>
                        <td>{{reserve.estado_rsv}}</td>
                        <td><button @click="update=true; openModal(reserve);" class="btn btn-warning">Editar</button></td>
                        <td><button @click="eliminar(reserve.id)" class="btn btn-danger">Eliminar</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Button trigger modal -->
        <button @click="update=false; openModal();" class="btn btn-primary mt-4" >
        Agregar Reserva
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
                                <input v-model="reserve.assig_id" type="text" class="form-control" id="Asignacion" placeholder="Asignación" name="">
                                <label for="EspacioCompartido"></label>
                                <input v-model="reserve.ec_id" type="text" class="form-control" id="EspacioCompartido" placeholder="Espacio Compartido" name="">
                                <label for="Detalle"></label>
                                <input v-model="reserve.detalle_rsv" type="text" class="form-control" id="Detalle" placeholder="Detalle Reserva" name="">
                                <label for="FechaInicio"></label>
                                <input v-model="reserve.fechahi_rsv" type="text" class="form-control" id="FechaInicio" placeholder="Fecha Inicio Reserva" name="">
                                <label for="FechaFinal"></label>
                                <input v-model="reserve.fechahf_rsv" type="text" class="form-control" id="FechaFinal" placeholder="Fecha Final" name="">
                                <label for="estadoRsv"></label>
                                <input v-model="reserve.estado_rsv" type="text" class="form-control" id="estadoRsv" placeholder="Estado Reserva" name="">
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
    </div>
</template>
<script>
    export default{
        data(){
            return{
                reserve:{
                    assig_id:'',
                    ec_id:'',
                    detalle_rsv:'',
                    fechahi_rsv:'',
                    fechahf_rsv:'',
                    estado_rsv:''
                },
                id:0,
                update:true,
                modal:0,
                titleModal:' ',
                reserves:[],
            }
        },
    methods:{
        async list(){
            const res=await axios.get('/api/reserves');
            this.reserves=res.data;
        },
        async eliminar(id){
            const res=await axios.delete('/api/reserves/'+id);
            this.list();
        },
        async save(){
            if (this.update) {
                const res=await axios.put('/api/reserves/'+this.id, this.reserve)
            } else {
                const res=await axios.post('/api/reserves', this.reserve);
            }
            this.closeModal();
            this.list();
        },
        openModal(data={}){
            this.modal=1;
            if(this.update){
                this.id=data.id;
                this.titleModal="Modificar Reserva";
                this.reserve.assig_id=data.assig_id;
                this.reserve.ec_id=data.ec_id;
                this.reserve.detalle_rsv=data.detalle_rsv;
                this.reserve.fechahi_rsv=data.fechahi_rsv;
                this.reserve.fechahf_rsv=data.fechahf_rsv;
                this.reserve.estado_rsv=data.estado_rsv;
            }else{
                this.id=0;
                this.titleModal="Crear Reserva";
                this.reserve.assig_id='';
                this.reserve.ec_id='';
                this.reserve.detalle_rsv='';
                this.reserve.fechahi_rsv='';
                this.reserve.fechahf_rsv='';
                this.reserve.estado_rsv='';
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
