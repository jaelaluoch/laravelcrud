<template>
   <div>
    <div class="jumbotron container mt-5">
<div class="row w-100 justify-content-center">
        <div class="col-md-3">
            <div class="card border-info mx-sm-1 p-3">
                <div class="card border-info shadow text-info p-3 my-card" ><span class="fa fa-car" aria-hidden="true"></span></div>
                <div class="text-info text-center mt-3"><h4>Status</h4></div>
                <div class="text-info text-center mt-2"><h1></h1></div>
                <router-link to="/status" class="text-center">Manage status</router-link>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-success mx-sm-1 p-3">
                <div class="card border-success shadow text-success p-3 my-card"><span class="fa fa-eye" aria-hidden="true"></span></div>
                <div class="text-success text-center mt-3"><h4> Tasks</h4></div>
                <div class="text-success text-center mt-2"><h1></h1></div>
                 <router-link to="/tasks" class="text-center">Manage tasks</router-link>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-danger mx-sm-1 p-3">
                <div class="card border-danger shadow text-danger p-3 my-card" ><span class="fa fa-heart" aria-hidden="true"></span></div>
                <div class="text-danger text-center mt-3"><h4>User Tasks</h4></div>
                <div class="text-danger text-center mt-2"><h1></h1></div>
                <router-link to="/mytasks" class="text-center">Manage My Tasks</router-link>
            </div>
        </div>
     </div>
</div>
   </div>

</template>