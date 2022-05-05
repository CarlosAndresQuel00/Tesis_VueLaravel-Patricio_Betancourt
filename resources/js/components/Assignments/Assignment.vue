<template>
    <div>
        <h1 class="text-center">Listado de asignaciones</h1>
        <hr>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Membresía</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Detalle</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Estado</th>
                        <th scope="col" colspan="2" class="text-center">Operaciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="assignment in assignments" :key="assignment.id">
                        <td><button @click="link(assignment.membership)" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModalToggle2">Ver Info</button></td>
                        <td><button @click="link2(assignment.client)" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModalToggle3">Ver Info</button></td>
                        <td>{{assignment.detalle}}</td>
                        <td>{{assignment.fecha}}</td>
                        <td>{{assignment.estado}}</td>
                        <td><button @click="update=true; openModal(assignment);" class="btn btn-warning">Editar</button></td>
                        <td><button @click="eliminar(assignment.id)" class="btn btn-danger">Eliminar</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Button trigger modal -->
        <button @click="update=false; openModal();" class="btn btn-primary mt-4" >
        Agregar Assignación
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
                                <label for="Membresía"></label>
                                <input v-model="assignment.mem_id" type="text" class="form-control" id="Membresía" placeholder="Membresía" name="">
                                <label for="Cliente"></label>
                                <input v-model="assignment.cli_id" type="text" class="form-control" id="Cliente" placeholder="Cliente" name="">
                                <label for="Detalle"></label>
                                <input v-model="assignment.detalle_assig" type="text" class="form-control" id="Detalle" placeholder="Detalle Asignación" name="">
                                <label for="Fecha"></label>
                                <input v-model="assignment.fecha_assig" type="text" class="form-control" id="Fecha" placeholder="Fecha Asignación" name="">
                                <label for="estadoAssign"></label>
                                <input v-model="assignment.estado_assig" type="text" class="form-control" id="estadoAssign" placeholder="Estado Asignación" name="">
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
                        <h5 class="modal-title" id="exampleModalToggleLabel2">Membresía</h5>
                        <button type="button" @click="modal2=0" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div>
                                <label>Nombre Membresía: </label>
                                {{memberships.nombre_mem}}
                            </div>
                            <div>
                                <label>Detalle Membresía: </label>
                                {{memberships.detalle_mem}}
                            </div>
                            <div>
                                <label>Estado Membresía: </label>
                                {{memberships.estado_mem}}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button @click="modal2=0" class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Atrás</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal3 -->
        <div class="modal fade" :class="{show:modal3}" id="exampleModalToggle3" aria-hidden="true" aria-labelledby="exampleModalToggleLabel3" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel3">Cliente</h5>
                        <button type="button" @click="modal3=0" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div>
                                <label>Identificación Cliente: </label>
                                {{clients.identificacion_cli}}
                            </div>
                            <div>
                                <label>Dirección Cliente: </label>
                                {{clients.direccion_cli}}
                            </div>
                            <div>
                                <label>Correo Electrónico Cliente: </label>
                                {{clients.email_cli}}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button @click="modal3=0" class="btn btn-primary" data-bs-target="#exampleModalToggle3" data-bs-toggle="modal">Atrás</button>
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
                assignment:{
                    mem_id:'',
                    cli_id:'',
                    detalle_assig:'',
                    fecha_assig:'',
                    estado_assig:''
                },
                id:0,
                mem:' ',
                memId:' ',
                cli:' ',
                cliId:' ',
                update:true,
                modal:0,
                modal2:0,
                modal3:0,
                titleModal:' ',
                assignments:[],
                memberships:[],
                clients:[],
            }
        },
    methods:{
        async list(){
            const res=await axios.get('/api/assignments');
            this.assignments=res.data;
        },
        async eliminar(id){
            const res=await axios.delete('/api/assignments/'+id);
            this.list();
        },
        async link(url){
            const res=await axios.get(url);
            this.memberships=res.data;
            this.modal2=1;
        },
        async link2(url){
            const res=await axios.get(url);
            this.clients=res.data;
            this.modal3=1;
        },
        async save(){
            if (this.update) {
                const res=await axios.put('/api/assignments/'+this.id, this.assignment)
            } else {
                const res=await axios.post('/api/assignments', this.assignment);
            }
            this.closeModal();
            this.list();
        },
        openModal(data={}){
            this.modal=1;
            if(this.update){
                this.mem = data.membership.split("memberships");
                this.memId = this.mem[1].split("/");
                this.cli = data.client.split("clients");
                this.cliId = this.cli[1].split("/");
                this.id=data.id;
                this.titleModal="Modificar Assignación";
                this.assignment.mem_id=this.memId[1];
                this.assignment.cli_id=this.cliId[1];
                this.assignment.detalle_assig=data.detalle;
                this.assignment.fecha_assig=data.fecha;
                this.assignment.estado_assig=data.estado;
            }else{
                this.id=0;
                this.titleModal="Crear Assignación";
                this.assignment.mem_id='';
                this.assignment.cli_id='';
                this.assignment.detalle_assig='';
                this.assignment.fecha_assig='';
                this.assignment.estado_assig='';
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
