<template>
    <main>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <!-- <router-link to="/" class="navbar-brand" href="#">Dashboard</router-link> -->
                <div class="collapse navbar-collapse">
                    <div class="navbar-nav">

                        <router-link to="/" class="nav-item nav-link">Home</router-link>
                        <router-link  to="/users" class="nav-item nav-link" >Add Users</router-link>
                        <router-link  to="/list" class="nav-item nav-link" >List Users</router-link>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container mt-5">

                <router-view></router-view>


        </div>
    </main>

</template>
<script setup>



</script>
