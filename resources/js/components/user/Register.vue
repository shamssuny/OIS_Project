<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <h2>register</h2>
                <li class="alert alert-danger" v-for="error in formError">{{error}}</li>
                <span v-if="errors">{{errors}}</span>
                <form class="form-group" method="POST" @submit="register">
                    <input class="form-control" type="text" v-model="username" name="username"><br>
                    <input class="form-control" type="email" v-model="email" name="email"><br>
                    <input class="form-control" type="password" v-model="password" name="password"><br>
                    <input class="form-control" type="password" v-model="password_confirmation" v-on:keyup="passwordMatchHandler" name="password_confirmation"><br>
                    <span v-if="confirmed" class="alert-danger">Password Doesn't Match</span><br>
                    <input type="submit" name="submit" value="Register">
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "Register",
        data(){
            return {
                username: '',
                email: '',
                password: '',
                password_confirmation: '',
                confirmed : false,
                errors: '',
                formError:[]
            };
        },
        methods : {
            register(event){
                event.preventDefault();
                let vm = this;
                if(this.username !== '' && this.email !== '' && this.password !== '' && this.confirmed === false){
                    axios.post('/api/register',{
                        'username' : this.username,
                        'email' : this.email,
                        'password' : this.password,
                    }).then(function (response) {
                        alert('Registered');
                        vm.$router.replace({path:'/login'})
                    }).catch(function (error) {
                        vm.formError = error.response.data.errors;
                    });

                }else{
                    this.errors = 'Fields Cannot be empty';
                }
            },

            passwordMatchHandler(){
              if(this.password !== this.password_confirmation){
                    this.confirmed = true;
              }else{
                  this.confirmed = false;
              }
            }
        }
    }
</script>

<style scoped>

</style>