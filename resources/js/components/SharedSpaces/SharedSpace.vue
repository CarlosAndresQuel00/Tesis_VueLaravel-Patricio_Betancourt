<template>
    <div>
        <h1 class="text-center">Listado de espacios compartidos</h1>
        <hr>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Detalle</th>
                        <th scope="col">Estado</th>
                        <th scope="col" colspan="2" class="text-center">Operaciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="sharedSpace in sharedSpaces" :key="sharedSpace.id">
                        <td>{{sharedSpace.nombre_ec}}</td>
                        <td>{{sharedSpace.detalle_ec}}</td>
                        <td>{{sharedSpace.estado_ec}}</td>
                        <td><button @click="update=true; openModal(sharedSpace);" class="btn btn-warning">Editar</button></td>
                        <td><button @click="eliminar(sharedSpace.id)" class="btn btn-danger">Eliminar</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Button trigger modal -->
        <button @click="update=false; openModal();" class="btn btn-primary mt-4" >
        Agregar Espacio Compartido
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
                                <input v-model="sharedSpace.nombre_ec" type="text" class="form-control" id="Nombre" placeholder="Nombre Espacio Compartido" name="">
                                <label for="Detalle"></label>
                                <textarea cols="30" rows="10" v-model="sharedSpace.detalle_ec" class="form-control" id="Detalle" placeholder="Detalle Espacio Compartido" name=""></textarea>
                                <label for="estadoEC"></label>
                                <input v-model="sharedSpace.estado_ec" type="text" class="form-control" id="estadoEC" placeholder="Estado Espacio Compartido" name="">
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
                sharedSpace:{
                    nombre_ec:'',
                    detalle_ec:'',
                    estado_ec:''
                },
                id:0,
                update:true,
                modal:0,
                titleModal:' ',
                sharedSpaces:[],
            }
        },
    methods:{
        async list(){
            const res=await axios.get('/api/shared_spaces');
            this.sharedSpaces=res.data;
        },
        async eliminar(id){
            const res=await axios.delete('/api/shared_spaces/'+id);
            this.list();
        },
        async save(){
            if (this.update) {
                const res=await axios.put('/api/shared_spaces/'+this.id, this.sharedSpace)
            } else {
                const res=await axios.post('/api/shared_spaces', this.sharedSpace);
            }
            this.closeModal();
            this.list();
        },
        openModal(data={}){
            this.modal=1;
            if(this.update){
                this.id=data.id;
                this.titleModal="Modificar Espacio Compartido";
                this.sharedSpace.nombre_ec=data.nombre_ec;
                this.sharedSpace.detalle_ec=data.detalle_ec;
                this.sharedSpace.estado_ec=data.estado_ec;
            }else{
                this.id=0;
                this.titleModal="Crear Espacio Compartido";
                this.sharedSpace.nombre_ec='';
                this.sharedSpace.detalle_ec='';
                this.sharedSpace.estado_ec='';
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
