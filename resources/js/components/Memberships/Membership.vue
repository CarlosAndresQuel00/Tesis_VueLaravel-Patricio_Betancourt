<template>
    <div>
        <h1 class="text-center">Listado de membresías</h1>
        <hr>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Detalle</th>
                        <th scope="col">Horas CO</th>
                        <th scope="col">Horas ES</th>
                        <th scope="col">Fecha-Corte</th>
                        <th scope="col">Estado</th>
                        <th scope="col" colspan="2" class="text-center">Operaciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="membership in memberships" :key="membership.id">
                        <td>{{membership.nombre_mem}}</td>
                        <td>{{membership.detalle_mem}}</td>
                        <td>{{membership.hcowork_mem}}</td>
                        <td>{{membership.hespacios_mem}}</td>
                        <td>{{membership.fechacorte_mem}}</td>
                        <td>{{membership.estado_mem}}</td>
                        <td><button @click="update=true; openModal(membership);" class="btn btn-warning">Editar</button></td>
                        <td><button @click="eliminar(membership.id)" class="btn btn-danger">Eliminar</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Button trigger modal -->
        <button @click="update=false; openModal();" class="btn btn-primary mt-4" >
        Agregar Membresía
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
                                <label for="Nombre"></label>
                                <input v-model="membership.nombre_mem" type="text" class="form-control" id="Nombre" placeholder="Nombre Membresía" name="">
                                <label for="Detalle"></label>
                                <input v-model="membership.detalle_mem" type="text" class="form-control" id="Detalle" placeholder="Detalle Membresía" name="">
                                <label for="HorasCO"></label>
                                <input v-model="membership.hcowork_mem" type="text" class="form-control" id="HorasCO" placeholder="Horas Cowork" name="">
                                <label for="HorasES"></label>
                                <input v-model="membership.hespacios_mem" type="text" class="form-control" id="HorasES" placeholder="Horas Espacios" name="">
                                <label for="FechaCorte"></label>
                                <input v-model="membership.fechacorte_mem" type="text" class="form-control" id="FechaCorte" placeholder="Fecha Corte" name="">
                                <label for="estadoMem"></label>
                                <input v-model="membership.estado_mem" type="text" class="form-control" id="estadoMem" placeholder="Estado Membresía" name="">
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
                membership:{
                    nombre_mem:'',
                    detalle_mem:'',
                    hcowork_mem:'',
                    hespacios_mem:'',
                    fechacorte_mem:'',
                    estado_mem:''
                },
                id:0,
                update:true,
                modal:0,
                titleModal:' ',
                memberships:[],
            }
        },
    methods:{
        async list(){
            const res=await axios.get('/api/memberships');
            this.memberships=res.data;
        },
        async eliminar(id){
            const res=await axios.delete('/api/memberships/'+id);
            this.list();
        },
        async save(){
            if (this.update) {
                const res=await axios.put('/api/memberships/'+this.id, this.membership)
            } else {
                const res=await axios.post('/api/memberships', this.membership);
            }
            this.closeModal();
            this.list();
        },
        openModal(data={}){
            this.modal=1;
            if(this.update){
                this.id=data.id;
                this.titleModal="Modificar Membresía";
                this.membership.nombre_mem=data.nombre_mem;
                this.membership.detalle_mem=data.detalle_mem;
                this.membership.hcowork_mem=data.hcowork_mem;
                this.membership.hespacios_mem=data.hespacios_mem;
                this.membership.fechacorte_mem=data.fechacorte_mem;
                this.membership.estado_mem=data.estado_mem;
            }else{
                this.id=0;
                this.titleModal="Crear Membresía";
                this.membership.nombre_mem='';
                this.membership.detalle_mem='';
                this.membership.hcowork_mem='';
                this.membership.hespacios_mem='';
                this.membership.fechacorte_mem='';
                this.membership.estado_mem='';
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
