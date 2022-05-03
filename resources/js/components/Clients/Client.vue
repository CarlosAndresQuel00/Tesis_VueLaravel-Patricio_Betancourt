<template>
    <div>
        <h1 class="text-center">Listado de clientes</h1>
        <hr>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Identificación</th>
                    <th scope="col">Nombres</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Empresa</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Email</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Estado</th>
                    <th scope="col" colspan="2" class="text-center">Operaciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="client in clients" :key="client.id">
                        <th scope="row">{{client.id}}</th>
                        <td>{{client.identificacion_cli}}</td>
                        <td>{{client.nombres_cli}}</td>
                        <td>{{client.apellidos_cli}}</td>
                        <td>{{client.empresa_cli}}</td>
                        <td>{{client.direccion_cli}}</td>
                        <td>{{client.email_cli}}</td>
                        <td>{{client.telf_cli}}</td>
                        <td>{{client.tipo_cli}}</td>
                        <td>{{client.estado_cli}}</td>
                        <td><button @click="update=true; openModal(client);" class="btn btn-warning">Editar</button></td>
                        <td><button @click="eliminar(client.id)" class="btn btn-danger">Eliminar</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Button trigger modal -->
        <button @click="update=false; openModal();" class="btn btn-primary mt-4" >
        Agregar Cliente
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
                                <label for="identificacion"></label>
                                <input v-model="client.identificacion_cli" type="text" class="form-control" id="identificacion" placeholder="Identificación Cliente" name="">
                                <label for="Nombres"></label>
                                <input v-model="client.nombres_cli" type="text" class="form-control" id="Nombres" placeholder="Nombres" name="">
                                <label for="Apellidos"></label>
                                <input v-model="client.apellidos_cli" type="text" class="form-control" id="Apellidos" placeholder="Apellidos" name="">
                                <label for="Empresa"></label>
                                <input v-model="client.empresa_cli" type="text" class="form-control" id="Empresa" placeholder="Empresa" name="">
                                <label for="Direccion"></label>
                                <input v-model="client.direccion_cli" type="text" class="form-control" id="Direccion" placeholder="Dirección" name="">
                                <label for="email"></label>
                                <input v-model="client.email_cli" type="email" class="form-control" id="email" placeholder="Correo Electrónico" name="">
                                <label for="telefono"></label>
                                <input v-model="client.telf_cli" type="text" class="form-control" id="telefono" placeholder="Teléfono" name="">
                                <label for="tipoCliente"></label>
                                <input v-model="client.tipo_cli" type="text" class="form-control" id="tipoCliente" placeholder="Tipo Cliente" name="">
                                <label for="estadoCliente"></label>
                                <input v-model="client.estado_cli" type="text" class="form-control" id="estadoCliente" placeholder="Estado Cliente" name="">
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
                client:{
                    identificacion_cli:'',
                    nombres_cli:'',
                    apellidos_cli:'',
                    empresa_cli:'',
                    direccion_cli:'',
                    email_cli:'',
                    telf_cli:'',
                    tipo_cli:'',
                    estado_cli:''
                },
                id:0,
                update:true,
                modal:0,
                titleModal:' ',
                clients:[],
            }
        },
    methods:{
        async list(){
            const res=await axios.get('/api/clients');
            this.clients=res.data;
        },
        async eliminar(id){
            const res=await axios.delete('/api/clients/'+id);
            this.list();
        },
        async save(){
            if (this.update) {
                const res=await axios.put('/api/clients/'+this.id, this.client)
            } else {
                const res=await axios.post('/api/clients', this.client);
            }
            this.closeModal();
            this.list();
        },
        openModal(data={}){
            this.modal=1;
            if(this.update){
                this.id=data.id;
                this.titleModal="Modificar Cliente";
                this.client.identificacion_cli=data.identificacion_cli;
                this.client.nombres_cli=data.nombres_cli;
                this.client.apellidos_cli=data.apellidos_cli;
                this.client.empresa_cli=data.empresa_cli;
                this.client.direccion_cli=data.direccion_cli;
                this.client.email_cli=data.email_cli;
                this.client.telf_cli=data.telf_cli;
                this.client.tipo_cli=data.tipo_cli;
                this.client.estado_cli=data.estado_cli;
            }else{
                this.id=0;
                this.titleModal="Crear Cliente";
                this.client.identificacion_cli='';
                this.client.nombres_cli='';
                this.client.apellidos_cli='';
                this.client.empresa_cli='';
                this.client.direccion_cli='';
                this.client.email_cli='';
                this.client.telf_cli='';
                this.client.tipo_cli='';
                this.client.estado_cli='';
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
