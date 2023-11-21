<template>
    <h1>Edit User</h1>
    <form @submit.prevent="update">

        <table>
            <tr>
                <td>First Name: </td>
                <td><input v-model="users.first_name"></td>
            </tr>
            <tr>
                <td>Last Name: </td>
                <td><input v-model="users.last_name"></td>
            </tr>
            <tr>
                <td>Email: </td>
                <td><input v-model="users.email"></td>
            </tr>

            <tr>
                <td>Dob: </td>
                <td><input type="date" v-model="users.dob"></td>
            </tr>
            <tr>
                <td>Gender: </td>
                <td>
                    <input type="radio" id="Male" value="Male" name="gender" v-model="users.gender"> Male
                    <input type="radio" id="Female" value="Female" name="gender" v-model="users.gender"> Female
                </td>
            </tr>
            <tr>
                <td>Phone Number: </td>
                <td><input v-model="users.phone"></td>
            </tr>
            <tr>
                <td>Profile Pic: </td>
                <td><input type="file" name="profile_pic" id="profile_pic" @change="Onchange"></td>
            </tr>

            <br/>
            <tr>
                <td></td>
                <td><button type="submit">Update User</button></td>
            </tr>
        </table>
    </form>


</template>

<script>
import axios from 'axios';
export default {
    name: "update_User",
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
                profile_pic: [],
                _method:"patch"
            }
        }
    },
    mounted() {
        this.showUser();
    },
    methods:{
        async showUser(){

            await
            axios.get(`/api/users/${this.$route.params.id}`).then(response=>{
                const { first_name, last_name, email, dob, gender, phone, profile_pic } = response.data
                this.users.first_name = first_name
                this.users.last_name = last_name
                this.users.email = email

                this.users.dob = dob
                this.users.gender = gender
                this.users.phone = phone
                this.users.profile_pic = profile_pic

            }).catch(error=>{
                console.log(error)
            })
        },
        async update(){

            await
            this.axios.post(`/api/users/${this.$route.params.id}`,this.category).then(response=>{
                this.$router.push({name:"list"})
            }).catch(error=>{
                console.log(error)
            })

        }
    },


}
</script>
