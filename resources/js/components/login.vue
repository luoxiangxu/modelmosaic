<template>
    <div class="modal" id="loginModal">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Login</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form>
              <ul class="list-group alert alert-danger mb-2" v-if="error != null">
                <li class="list-group-item ml-2">
                    {{error}}
                </li>
              </ul>
              <div class="mb-3 mt-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" placeholder="Enter email" v-model="email">
              </div>

              <div class="mb-3 mt-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" placeholder="Enter password" v-model="password">
              </div>

              <div class="mb-3 mt-3">
                <button class="btn btn-bold btn-block btn-primary" @click="attemptLogin()" :disabled="!isValidLoginForm" type="button">Login</button>
              </div>
            </form>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <p class="text-center text-muted fs-13 mt-20">Don't have an account? <a href="/register">Sign up</a></p>
          </div>

        </div>
      </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
  mounted() {
      console.log('Component mounted.')
  },
  data(){
    return {
      email:'',
      password:'',
      error:null,
    }
  },
  computed: {
    isValidLoginForm(){
      return this.emailisValid() && this.password
    }
  },
  methods:{
    emailisValid(){
      if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email))
        {
          return (true)
        }else{
          return false
        }
    },
    attemptLogin(){
      axios.post('/login',{
        email:this.email,password:this.password
      }).then(resp =>{
        location.replace('/')
      }).catch(error => {
        if(error.response.status == 422){
          this.error = null
          this.error = "User name or password wrong"
        }else{
          this.error = null
          this.error = "something went wrong please refresh"
        }
      })
    }
  }
}
</script>