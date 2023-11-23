<template>
<form @submit.prevent="LoginData">
  <div class="mb-3">
    <h1 class="text-center">Login Form</h1>
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" name="email" id="email" v-model="users.email" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" name="password" id="password" v-model="users.password">
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
</form>
</template>

<script>
export default {
  data() {
    return {
      users: {
        email: '',
        password: ''
      }
    }
  },
  created() {
    },
    mounted() {
             console.log("mounted() called.......");
         },
  methods: {
    LoginData() {
      axios.post('/api/login', this.users).then(({data}) => {
        console.log(data);

       try{
          if(data.status === true){
            alert("Login Successfully");
            this.$router.push({ name: 'home' })
          }
          else{
            alert("Login Failed");
          }
       }
       catch(err){
            alert("Error, please try again");
       }



      })
    }
  }

}
</script>
