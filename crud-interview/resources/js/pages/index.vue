<template>
    <div class="row justify-content-center">
        <div class="col-sm-4 mt-5">
            <div class="card">
                <div class="card-header">Login</div>
                <div class="card-body">
                    
                    <form v-on:submit.prevent="login()">


<div class="form-group">
<label for="inputPassword5" class="form-label">Email</label>
<input type="email" v-model="message.email" id="inputPassword5" class="form-control" >
</div>

<div class="form-group">
<label for="inputPassword5" class="form-label">Password</label>
<input type="password" v-model="message.password" id="inputPassword5" class="form-control" >
</div>


<div class="mt-3 d-grid gap-2">
<button type="submit" class="btn btn-outline-success btn-block btn-lg">Sign In</button>
</div>
<router-link to="/signup" class="mt-3 text-center">Create Account</router-link>


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
        login(){
          this.$loading(true)
            let uri =`/api/auth/login`;
            this.axios.post(uri, this.message).then((response) => {
               this.$loading(false)
                if(response.data.status){
                    localStorage.setItem('token', response.data.access_token);
                    localStorage.setItem('name', response.data.user.name);
                    localStorage.setItem('email', response.data.user.email);
                    localStorage.setItem('auth', 'yes');
                    this.$router.push({name: 'home'});
                     this.$toast.open({message: 'Login successfully', type: 'success', position: 'top'});
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
