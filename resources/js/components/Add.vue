<template>
    <h1> {{ editing ? 'Edit' : 'Add' }} User Register</h1>
    <form @submit.prevent="createUser" enctype="multipart/form-data" novalidate="novalidate">

        <table>
            <tr>
                <td>First Name: </td>
                <td><input class="form-control {view: !isEditing}" v-model="users.first_name"></td>
            </tr>
            <tr>
                <td></td>
                <td><div v-if="hasErrors('first_name')" class="text-danger" style="font-weight: 600;">{{ errors.first_name[0] }}</div></td>
            </tr>
            <br/>

            <tr>
                <td>Last Name: </td>
                <td><input class="form-control" v-model="users.last_name"></td>
            </tr>
            <tr>
                <td></td>
                <td><div v-if="hasErrors('last_name')" class="text-danger" style="font-weight: 600;">{{ errors.last_name[0] }}</div></td>
            </tr>
            <br/>

            <tr>
                <td>Email: </td>
                <td><input class="form-control" v-model="users.email"></td>
            </tr>
            <tr>
                <td></td>
                <td><div v-if="hasErrors('email')" class="text-danger" style="font-weight: 600;">{{ errors.email[0] }}</div></td>
            </tr><br/>

            <tr>
                <td>Password: </td>
                <td><input class="form-control" type="password" v-model="users.password"></td>
            </tr>
            <tr>
                <td></td>
                <td><div v-if="hasErrors('password')" class="text-danger" style="font-weight: 600;">{{ errors.password[0] }}</div></td>
            </tr><br/>



            <tr>
                <td>Confirm Password: </td>
                <td><input class="form-control" type="password" v-model="users.confirm_password"></td>
            </tr>
            <tr>
                <td></td>
                <td><div v-if="hasErrors('confirm_password')" class="text-danger" style="font-weight: 600;">{{ errors.confirm_password[0] }}</div></td>
            </tr><br/>

            <tr>
                <td>Dob: </td>
                <td><input  type="date" v-model="users.dob"></td>
            </tr>
            <tr>
                <td></td>
                <td><div v-if="hasErrors('dob')" class="text-danger" style="font-weight: 600;">{{ errors.dob[0] }}</div></td>
            </tr><br/>

            <tr>
                <td>Gender: </td>
                <td>
                    <input class="form-check-input" type="radio" id="Male" value="Male" name="gender" v-model="users.gender"> Male
                    <input class="form-check-input" type="radio" id="Female" value="Female" name="gender" v-model="users.gender"> Female
                </td>

            </tr>
            <tr>
                <td></td>
                <td><div v-if="hasErrors('gender')" class="text-danger" style="font-weight: 600;">{{ errors.gender[0] }}</div></td>
            </tr><br/>

            <tr>
                <td>Phone Number: </td>
                <td><input class="form-control" v-model="users.phone"></td>
            </tr>
            <tr>
                <td></td>
                <td> <div v-if="hasErrors('phone')" class="text-danger" style="font-weight: 600;">{{ errors.phone[0] }}</div></td>
            </tr><br/>

            <tr>
                <td>Profile Pic: </td>
                <td><input type="file" name="profile_pic" id="profile_pic"  @change="onChange"></td>
            </tr>
            <tr>
                <td></td>
                <td> <div v-if="hasErrors('profile_pic')" class="text-danger" style="font-weight: 600;">{{ errors.profile_pic[0] }}</div></td>
            </tr>
            <div id="preview">
                        <img v-if="url" :src="url" />
            </div>
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
url:null,
errors:{},

            users:{
                first_name: '',
                last_name: '',
                email: '',
                password: '',
                confirm_password: '',
                dob: '',
                gender: '',
                phone: '',
                profile_pic: [],

            },

        }
    },
    methods:{
        async createUser() {
            const formData = new FormData();
            formData.append('profile_pic', this.users.profile_pic);
            formData.append('first_name', this.users.first_name);
            formData.append('last_name', this.users.last_name);
            formData.append('email', this.users.email);
            formData.append('password', this.users.password);
            formData.append('confirm_password', this.users.confirm_password);
            formData.append('dob', this.users.dob);
            formData.append('gender', this.users.gender);
            formData.append('phone', this.users.phone);


            await
            axios.post('/api/users', formData).then(response => {
                this.onSuccess(response.message)
                this.$router.push({
                    name: "list"
                })
            }).catch(error => {
                if(error.response.status === 422) {
                    this.setErrors(error.response.data.errors)
                }
                else{
                    this.onFailures(error.response.data.message)
                }

                console.log(error)
            })

        },


        onChange(e) {
            // const profile = e.target.files[0].name;


            const profile = e.target.files[0];
            this.url = URL.createObjectURL(profile);

            this.users.profile_pic = e.target.files[0]

        },



        onSuccess(){
            this.success = true;
        },
        onFailures(){
            this.error = true;
        },
        setErrors(error){
            this.errors = error
        },
        hasErrors(fieldName){
            return (fieldName in this.errors)
        },

    }

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


