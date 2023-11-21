<template>
    <h1> {{ editing ? 'Edit' : 'Add' }} User Register</h1>
    <form @submit.prevent="createUser" enctype="multipart/form-data">

        <table>
            <tr>
                <td>First Name: </td>
                <td><input class="form-control" v-model="users.first_name"></td>
            </tr><br/>
            <tr>
                <td>Last Name: </td>
                <td><input class="form-control" v-model="users.last_name"></td>
            </tr><br/>
            <tr>
                <td>Email: </td>
                <td><input class="form-control" v-model="users.email"></td>
            </tr><br/>
            <tr>
                <td>Password: </td>
                <td><input class="form-control" type="password" v-model="users.password"></td>
            </tr><br/>
            <tr>
                <td>Dob: </td>
                <td><input  type="date" v-model="users.dob"></td>
            </tr><br/>
            <tr>
                <td>Gender: </td>
                <td>
                    <input class="form-check-input" type="radio" id="Male" value="Male" name="gender" v-model="users.gender"> Male
                    <input class="form-check-input" type="radio" id="Female" value="Female" name="gender" v-model="users.gender"> Female
                </td>
            </tr><br/>
            <tr>
                <td>Phone Number: </td>
                <td><input class="form-control" v-model="users.phone"></td>
            </tr><br/>
            <tr>
                <td>Profile Pic: </td>
                <td><input type="file" name="profile_pic" id="profile_pic" @change="Onchange"></td>
            </tr><br/>

            <br/>
            <tr>
                <td></td>
                <td><button class="btn btn-primary" type="submit">Register</button></td>
            </tr>
        </table>
    </form>


</template>

<script>
import axios from 'axios';


export default {

    name: "add-users",
    data() {
        return {
            users:{
                first_name: '',
                last_name: '',
                email: '',
                password: '',
                dob: '',
                gender: '',
                phone: '',
                profile_pic: []
            }

        }
    },
    methods:{
        async createUser() {
            const formData = new FormData();
            formData.append('file', this.users.profile_pic);
            formData.append('first_name', this.users.first_name);
            formData.append('last_name', this.users.last_name);
            formData.append('email', this.users.email);
            formData.append('password', this.users.password);
            formData.append('dob', this.users.dob);
            formData.append('gender', this.users.gender);
            formData.append('phone', this.users.phone);


            await
            axios.post('/api/users', formData).then(response => {
                this.$router.push({
                    name: "list"
                })
            }).catch(error => {
                console.log(error)
            })
        },
        Onchange(e) {
            // const profile = e.target.files[0].name;
            this.users.profile_pic = e.target.files[0]

        }


    },

}
</script>


