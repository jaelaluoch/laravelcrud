<template>
    <div >
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/home">Home</a>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-success" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{email}}
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" v-on:click="logout()" href="#">Logout</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
         
            <router-view></router-view>
            </div>

</template>
<script>
export default {
    data() {
        return {
            name:'',
            auth:'',
            email:'',
        }
    },
    created(){
        this.name=localStorage.getItem('name');
        this.auth=localStorage.getItem('auth');
         this.email=localStorage.getItem('email');
    },
    watch:{
        '$route' (to, from) {
            this.name=localStorage.getItem('name');
        this.auth=localStorage.getItem('auth');
         this.email=localStorage.getItem('email');
        }
    },
    methods: {
      routerToOtherPage(val){
        this.$router.push({name: val});
      },
        logout() {
            localStorage.removeItem('token');
            localStorage.removeItem('auth');
            this.$router.push({name: 'index'});

        },
    }
}
</script>