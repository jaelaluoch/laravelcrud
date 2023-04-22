<template>
    <div class="row justify-content-center mt-5">
        <div class="col-sm-8">
         <div class="card">
            <div class="card-header text-center">Manager Status 
                <button class="btn btn-outline-success float-right ml-5" v-on:click="showAddModal()">Add Status</button>
            </div>
            <div class="card-body">
             <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Status Name</th>
      <th scope="col">Created at</th>
      <th scope="col">Updated at</th>
       <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="(data,index) in status" :key="data.id">
      <th scope="row">{{index+1}}</th>
      <td>{{data.name}}</td>
      <td>{{filerDate(data.created_at)}}</td>
      <td>{{filerDate(data.updated_at)}}</td>
      <td>
        <a class="btn btn-primary" v-on:click="showUpdateModal(data.id,data.name)">Edit</a>
         <a class="btn btn-danger" v-on:click="deleteStatus(data.id)">Delete</a>
      </td>
    </tr>
  </tbody>
</table>
            </div>
         </div>
        </div>



<!-- Modal -->
 <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
     
      <div class="modal-body">
         <h6 class="text-center">Add New Status</h6>
         <div class="form-group mt-3">
                    <label class="form-label">Status Name</label>
                    <input type="text" v-model="message.name" class="form-control" required>
                  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" v-on:click="createStatus()">Submit</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
 <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
     
      <div class="modal-body">
         <h6 class="text-center">Edit Statys</h6>
         <div class="form-group mt-3">
                    <label class="form-label">Status Name</label>
                    <input type="text" v-model="message.name" class="form-control" required>
                  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" v-on:click="updateStatus()">Update</button>
      </div>
    </div>
  </div>
</div>
    </div>
</template>
<script>
    import moment from 'moment'
    export default {
        name: 'App',
        components: {
          
        },
        data(){
            return {
            status:[],
            message:{id:'',name:''},
            }
        },
        created(){
              this.getStatus();
        },
        methods: {
            showAddModal(){
            $('#addModal').modal('show');
            },
          showUpdateModal(id,name){
            this.message.name=name;
            this.message.id=id;
             $('#editModal').modal('show');
          },
          createStatus(){
             this.$loading(true)
               let uri =`/api/auth/createStatus`;
                this.axios.post(uri,this.message, { headers: { Authorization: 'Bearer '+localStorage.getItem('token')}}).then((response) => {
                    this.$loading(false)
                   if(response.data.status){
                    this.message.name='';
                   this.$toast.open({message: response.data.message, type: 'success', position: 'top'});
                   this.getStatus();
                   }else{
                   this.$toast.open({message: response.data.message, type: 'error', position: 'top'});
                   }
                }).catch(error => {
                   this.$loading(false)
                    if (error.response.status === 401) {
                    this.$router.push({name: 'index'});
                    this.$toast.open({message: 'Please sign in!', type: 'error', position: 'top'});
                   
                }else{
                    this.$toast.open({message: 'Something went wrong!.', type: 'error', position: 'top'});
                }
                   
                });
          },
          deleteStatus(id){
              this.$loading(true)
               let uri =`/api/auth/deleteStatus/${id}`;
                this.axios.get(uri, { headers: { Authorization: 'Bearer '+localStorage.getItem('token')}}).then((response) => {
                    this.$loading(false)
                   if(response.data.status){
                     $('#editModal').modal('hide');
                   this.$toast.open({message: response.data.message, type: 'success', position: 'top'});
                   this.getStatus();
                   }else{
                   this.$toast.open({message: response.data.message, type: 'error', position: 'top'});
                   }
                }).catch(error => {
                   this.$loading(false)
                    if (error.response.status === 401) {
                    this.$router.push({name: 'index'});
                    this.$toast.open({message: 'Please sign in!', type: 'error', position: 'top'});
                   
                }else{
                    this.$toast.open({message: 'Something went wrong!.', type: 'error', position: 'top'});
                }
                   
                });
          },
          updateStatus(){
             this.$loading(true)
               let uri =`/api/auth/updateStatus`;
                this.axios.post(uri,this.message, { headers: { Authorization: 'Bearer '+localStorage.getItem('token')}}).then((response) => {
                    this.$loading(false)
                   if(response.data.status){
                     $('#editModal').modal('hide');
                   this.$toast.open({message: response.data.message, type: 'success', position: 'top'});
                   this.getStatus();
                   this.message={name:'',id:''};
                   }else{
                   this.$toast.open({message: response.data.message, type: 'error', position: 'top'});
                   }
                }).catch(error => {
                   this.$loading(false)
                    if (error.response.status === 401) {
                    this.$router.push({name: 'index'});
                    this.$toast.open({message: 'Please sign in!', type: 'error', position: 'top'});
                   
                }else{
                    this.$toast.open({message: 'Something went wrong!.', type: 'error', position: 'top'});
                }
                   
                });
          },
            getStatus(){

                let uri =`/api/auth/getStatus`;
                this.axios.get(uri, { headers: { Authorization: 'Bearer '+localStorage.getItem('token')}}).then((response) => {
                   this.status=response.data;
                }).catch(error => {
                    if (error.response.status === 401) {
                    this.$router.push({name: 'index'});
                    this.$toast.open({message: 'Please sign in!', type: 'error', position: 'top'});
                    
                }else{
                    this.$toast.open({message: 'Something went wrong!.', type: 'error', position: 'top'});
                }
                   
                });
            },
            
            filerDate(date){
                return moment(String(date)).format('MM/DD/YYYY hh:mm')
            }

        },
    }

</script>