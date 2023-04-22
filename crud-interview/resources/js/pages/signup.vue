<template>
    <div class="row justify-content-center">
        <div class="col-sm-4 mt-5">
            <div class="card">
                <div class="card-header">Create Account</div>
                <div class="card-body">
                    
                    <form v-on:submit.prevent="signup()">
                        <div class="form-group">
<label for="inputPassword5" class="form-label">Name</label>
<input type="text" v-model="message.name" id="inputPassword5" class="form-control">
</div>

<div class="form-group">
<label for="inputPassword5" class="form-label">Email</label>
<input type="email" v-model="message.email" id="inputPassword5" class="form-control" >
</div>

<div class="form-group">
<label for="inputPassword5" class="form-label">Password</label>
<input type="password" v-model="message.password" id="inputPassword5" class="form-control" >
</div>

<div class="form-group">
<label for="inputPassword5" class="form-label">Confirm Password</label>
<input type="password" v-model="message.repass" id="inputPassword5" class="form-control" >
</div>

<div class="mt-3 d-grid gap-2">
<button type="submit" class="btn btn-outline-success btn-block btn-lg">Sign Up</button>
</div>
<router-link to="/login" class="mt-3 text-center">Login</router-link>


                    </form>
                </div>
            </div>

           
        </div>
    </div>
</template>
<script>
export default {
    name: 'App',
    components: {
    },
    data(){
        return {
            message:{},
        }
    },
    created() {


    },
    methods: {
        signup(){
          this.$loading(true)
            let uri =`/api/auth/signup`;
            this.axios.post(uri, this.message).then((response) => {
               this.$loading(false)
                if(response.data.status){
                    this.$router.push({name: 'index'});
                     this.$toast.open({message: response.data.message, type: 'success', position: 'top'});
                }else{
                    this.$toast.open({message: response.data.message, type: 'error', position: 'top'});
                }
            }).catch(error => {
                this.$loading(false)
                localStorage.removeItem('token');
                this.$toast.open({message: 'Something went wrong!', type: 'error', position: 'top'});
            });
        },

    }
}
</script>
