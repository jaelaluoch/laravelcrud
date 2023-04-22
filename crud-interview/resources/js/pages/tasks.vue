<template>
    <div class="row justify-content-center mt-5">
        <div class="col-sm-8">
         <div class="card">
            <div class="card-header text-center">Manager Tasks 
                <button class="btn btn-outline-success float-right ml-5" v-on:click="showAddModal()">Add Task</button>
            </div>
            <div class="card-body">
             <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Status Name</th>
      <th scope="col">Description</th>
      <th scope="col">Due date</th>
       <th scope="col">Status</th>
      <th scope="col">Created at</th>
      <th scope="col">Updated at</th>
       <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="(data,index) in task" :key="data.id">
      <th scope="row">{{index+1}}</th>
      <td>{{data.name}}</td>
      <td>{{data.description}}</td>
      <td>{{data.due_date}}</td>
      <td>{{data.status}}</td>
      <td>{{filerDate(data.created_at)}}</td>
      <td>{{filerDate(data.updated_at)}}</td>
      <td>
        <a class="btn btn-primary" v-on:click="showUpdateModal(data.id,data.name,data.description,data.status_id,data.due_date)">Edit</a>
         <a class="btn btn-danger" v-on:click="deleteTask(data.id)">Delete</a>
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
         <h6 class="text-center">Add New Task</h6>
         <div class="form-group mt-3">
                    <label class="form-label">Task Name</label>
                    <input type="text" v-model="message.name" class="form-control" required>
        </div>
        <div class="form-group mt-3">
                    <label class="form-label">Task Description</label>
                    <input type="text" v-model="message.description" class="form-control" required>
        </div>
        <div class="form-group mt-3">
                    <label class="form-label">Due Date</label>
                    <input type="date" v-model="message.due_date" class="form-control" required>
        </div>
        <div class="form-group mt-3">
                    <label class="form-label">Status</label>
                    <select class="form-control" v-model="message.status_id" id="exampleFormControlSelect1">
      <option v-for="data in status" :key="data.id" v-bind:value="data.id">{{data.name}}</option>
    </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" v-on:click="createTask()">Submit</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
 <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
     
      <div class="modal-body">
         <h6 class="text-center">Edit Task</h6>
         <div class="form-group mt-3">
                    <label class="form-label">Task Name</label>
                    <input type="text" v-model="message.name" class="form-control" required>
        </div>
        <div class="form-group mt-3">
                    <label class="form-label">Task Description</label>
                    <input type="text" v-model="message.description" class="form-control" required>
        </div>
        <div class="form-group mt-3">
                    <label class="form-label">Due Date</label>
                    <input type="date" v-model="message.due_date" class="form-control" required>
        </div>
        <div class="form-group mt-3">
                    <label class="form-label">Status</label>
                    <select class="form-control" v-model="message.status_id" id="exampleFormControlSelect1">
      <option v-for="data in status" :key="data.id" v-bind:value="data.id">{{data.name}}</option>
    </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" v-on:click="updateTask()">Update</button>
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
             task:[],
            message:{id:'',name:'',description:'',status_id:'',due_date:''},
            }
        },
        created(){
              this.getStatus();
              this.getTask();
        },
        methods: {
            showAddModal(){
            $('#addModal').modal('show');
            },
          showUpdateModal(id,name,description,status_id,due_date){
            this.message.name=name;
            this.message.id=id;
            this.message.description=description;
            this.message.status_id=status_id;
            this.message.due_date=due_date;
             $('#editModal').modal('show');
          },
          createTask(){
             this.$loading(true)
               let uri =`/api/auth/createTask`;
                this.axios.post(uri,this.message, { headers: { Authorization: 'Bearer '+localStorage.getItem('token')}}).then((response) => {
                    this.$loading(false)
                   if(response.data.status){
                    this.message={id:'',name:'',description:'',status_id:'',due_date:''};
                   this.$toast.open({message: response.data.message, type: 'success', position: 'top'});
                   this.getTask();
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
          deleteTask(id){
              this.$loading(true)
               let uri =`/api/auth/deleteTask/${id}`;
                this.axios.get(uri, { headers: { Authorization: 'Bearer '+localStorage.getItem('token')}}).then((response) => {
                    this.$loading(false)
                   if(response.data.status){
                   this.$toast.open({message: response.data.message, type: 'success', position: 'top'});
                   this.getTask();
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
          updateTask(){
             this.$loading(true)
               let uri =`/api/auth/updateTask`;
                this.axios.post(uri,this.message, { headers: { Authorization: 'Bearer '+localStorage.getItem('token')}}).then((response) => {
                    this.$loading(false)
                   if(response.data.status){
                     $('#editModal').modal('hide');
                   this.$toast.open({message: response.data.message, type: 'success', position: 'top'});
                   this.getTask();
                   this.message={id:'',name:'',description:'',status_id:'',due_date:''};
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
          getTask(){

                let uri =`/api/auth/getTask`;
                this.axios.get(uri, { headers: { Authorization: 'Bearer '+localStorage.getItem('token')}}).then((response) => {
                   this.task=response.data;
                }).catch(error => {
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