<template>
    <h1>List Users</h1>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <button class="btn btn-primary"><router-link  to="/users" class="nav-item nav-link" style="color: white; font-weight: 600;">Add Users</router-link></button>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>List Users</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>FirstName</th>
                                    <th>LastName</th>
                                    <th>Email</th>
                                    <th>Dob</th>
                                    <th>Gender</th>
                                    <th>Contact Number</th>
                                    <th>Profile</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody v-if="users.length > 0">
                                <tr v-for="(user,key) in users" :key="key">
                                    <td>{{ user.id }}</td>
                                    <td>{{ user.first_name }}</td>
                                    <td>{{ user.last_name }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>{{ user.dob }}</td>
                                    <td>{{ user.gender }}</td>
                                    <td>{{ user.phone }}</td>

                                    <td>
                                        <img src="uploads/{{ user.profile_pic }}" style="width: 100px; height: 100px;">

                                    </td>
                                    <td>
                                        <router-link :to="{name: 'edit', params: { id: user.id }}" class="btn btn-success">Edit</router-link>

                                        <button type="button" @click="deleteUsers12(user.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            users: []
        }
    },
    mounted() {
        this.getUsers();
    },
    methods: {
        async getUsers() {
            await axios.get('/api/users').then(response => {
                this.users = response.data;
            }).catch(error => {
                console.log(error)
                this.categories = []
            })
        },

        deleteUsers12(id){
            if(confirm("Are you sure to delete this users ?")){
                axios.delete(`/api/users/${id}`).then(response=>{
                    this.getUsers()
                }).catch(error=>{
                    console.log(error)
                })
            }
        }

    }
}

</script>
