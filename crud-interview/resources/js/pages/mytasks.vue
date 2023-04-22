<template>
    <div class="row justify-content-center mt-5">
        <div class="col-sm-8">
         <div class="card">
            <div class="card-header text-center">My Tasks 
                <button class="btn btn-outline-success float-right ml-5" v-on:click="showAddModal()">Assign Task</button>
            </div>
            <div class="card-body">
             <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Task</th>
      <th scope="col">Remarks</th>
      <th scope="col">Due date</th>
       <th scope="col">Status</th>
       <th scope="col">User</th>
      <th scope="col">Start time</th>
      <th scope="col">End time</th>
       <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="(data,index) in usertask" :key="data.id">
      <th scope="row">{{index+1}}</th>
      <td>{{data.task}}</td>
      <td>{{data.remarks}}</td>
      <td>{{data.due_date}}</td>
      <td>{{data.status}}</td>
      <td>{{data.user}}</td>
      <td>{{filerDate(data.start_time)}}</td>
      <td>{{filerDate(data.end_time)}}</td>
      <td>
        <a class="btn btn-primary" v-on:click="showUpdateModal(data.id,data.task_id,data.status_id,data.due_date,data.start_time,data.end_time,data.remarks)">Edit</a>
         <a class="btn btn-danger" v-on:click="deleteUserTask(data.id)">Delete</a>
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
         <h6 class="text-center">Assign myself Task</h6>
         <div class="form-group mt-3">
                    <label class="form-label">Task</label>
                    <select class="form-control" v-model="message.task_id" id="exampleFormControlSelect1">
      <option v-for="data in task" :key="data.id" v-bind:value="data.id">{{data.name}}</option>
    </select>
        </div>
        <div class="form-group mt-3">
                    <label class="form-label">Remarks</label>
                    <input type="text" v-model="message.remarks" class="form-control" required>
        </div>
        <div class="form-group mt-3">
                    <label class="form-label">Due Date</label>
                    <input type="date" v-model="message.due_date" class="form-control" required>
        </div>
        <div class="form-group mt-3">
                    <label class="form-label">Start Time</label>
                    <input type="date" v-model="message.start_time" class="form-control" required>
        </div>
        <div class="form-group mt-3">
                    <label class="form-label">End Time</label>
                    <input type="date" v-model="message.end_time" class="form-control" required>
        </div>
        <div class="form-group mt-3">
                    <label class="form-label">Status</label>
                    <select class="form-control" v-model="message.status_id" id="exampleFormControlSelect1">
      <option v-for="data in status" :key="data.id" v-bind:value="data.id">{{data.name}}</option>
    </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" v-on:click="createUserTask()">Submit</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
 <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
     
      <div class="modal-body">
         <h6 class="text-center">Update My tasks</h6>
         <div class="form-group mt-3">
                    <label class="form-label">Task</label>
                    <select class="form-control" v-model="message.task_id" id="exampleFormControlSelect1">
      <option v-for="data in task" :key="data.id" v-bind:value="data.id">{{data.name}}</option>
    </select>
        </div>
        <div class="form-group mt-3">
                    <label class="form-label">Remarks</label>
                    <input type="text" v-model="message.remarks" class="form-control" required>
        </div>
        <div class="form-group mt-3">
                    <label class="form-label">Due Date</label>
                    <input type="date" v-model="message.due_date" class="form-control" required>
        </div>
        <div class="form-group mt-3">
                    <label class="form-label">Start Time</label>
                    <input type="date" v-model="message.start_time" class="form-control" required>
        </div>
        <div class="form-group mt-3">
                    <label class="form-label">End Time</label>
                    <input type="date" v-model="message.end_time" class="form-control" required>
        </div>
        <div class="form-group mt-3">
                    <label class="form-label">Status</label>
                    <select class="form-control" v-model="message.status_id" id="exampleFormControlSelect1">
      <option v-for="data in status" :key="data.id" v-bind:value="data.id">{{data.name}}</option>
    </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" v-on:click="updateUserTask()">Update</button>
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
             usertask:[],
            message:{id:'',start_time:'',remarks:'',status_id:'',due_date:'',end_time:'',task_id:''},
            }
        },
        created(){
              this.getStatus();
              this.getTask();
              this.getUserTask();
        },
        methods: {
            showAddModal(){
            $('#addModal').modal('show');
            },
          showUpdateModal(id,task_id,status_id,due_date,start_time,end_time,remarks){
            this.message.task_id=task_id;
            this.message.id=id;
            this.message.start_time=start_time;
            this.message.status_id=status_id;
            this.message.due_date=due_date;
            this.message.end_time=end_time;
            this.message.remarks=remarks;
             $('#editModal').modal('show');
          },
          createUserTask(){
             this.$loading(true)
               let uri =`/api/auth/createUserTask`;
                this.axios.post(uri,this.message, { headers: { Authorization: 'Bearer '+localStorage.getItem('token')}}).then((response) => {
                    this.$loading(false)
                   if(response.data.status){
                    this.message={id:'',start_time:'',remarks:'',status_id:'',due_date:'',end_time:'',task_id:''};
                   this.$toast.open({message: response.data.message, type: 'success', position: 'top'});
                   this.getUserTask();
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
          deleteUserTask(id){
              this.$loading(true)
               let uri =`/api/auth/deleteUserTask/${id}`;
                this.axios.get(uri, { headers: { Authorization: 'Bearer '+localStorage.getItem('token')}}).then((response) => {
                    this.$loading(false)
                   if(response.data.status){
                   this.$toast.open({message: response.data.message, type: 'success', position: 'top'});
                   this.getUserTask();
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
          updateUserTask(){
             this.$loading(true)
               let uri =`/api/auth/updateUserTask`;
                this.axios.post(uri,this.message, { headers: { Authorization: 'Bearer '+localStorage.getItem('token')}}).then((response) => {
                    this.$loading(false)
                   if(response.data.status){
                     $('#editModal').modal('hide');
                   this.$toast.open({message: response.data.message, type: 'success', position: 'top'});
                   this.getUserTask();
                   this.message={id:'',start_time:'',remarks:'',status_id:'',due_date:'',end_time:'',task_id:''};
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
            getUserTask(){

                let uri =`/api/auth/getUserTask`;
                this.axios.get(uri, { headers: { Authorization: 'Bearer '+localStorage.getItem('token')}}).then((response) => {
                   this.usertask=response.data;
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