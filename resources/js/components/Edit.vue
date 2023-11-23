<template>
    <h1>Edit User</h1>
    <form @submit.prevent="update" enctype="multipart/form-data">
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
                <td>Dob: </td>
                <td><input class="form-control" type="date" v-model="users.dob"></td>
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
                <td><input type="file" name="profile_pic" id="profile_pic" @change="onChange"></td>
            </tr>
            <div id="preview">
                        <img v-if="url" :src="url" />
            </div>

            <br/>
            <tr>
                <td></td>
                <td><button class="btn btn-primary" type="submit">Update User</button></td>
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
            url:null,
            users:{
                first_name: '',
                last_name: '',
                email: '',
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
            const formData = new FormData();
            formData.append('file', this.users.profile_pic);
            formData.append('first_name', this.users.first_name);
            formData.append('last_name', this.users.last_name);
            formData.append('email', this.users.email);
            formData.append('dob', this.users.dob);
            formData.append('gender', this.users.gender);
            formData.append('phone', this.users.phone);
            formData.append('_method', 'PUT');

            await
            axios.post(`/api/users/${this.$route.params.id}`,formData).then(response=>{
                this.$router.push({name:"list"})
            }).catch(error=>{
                console.log(error)
            })

        },
        onChange(e) {
            // const profile = e.target.files[0].name;

            const profile = e.target.files[0];
            this.url = URL.createObjectURL(profile);
            this.users.profile_pic = e.target.files[0]

        },
    },


}
</script>
<style scoped>
#preview {
  display: flex;
  justify-content: center;
  align-items: center;
}

#preview img {
  max-width: 100%;
  max-height: 500px;
}
</style>
