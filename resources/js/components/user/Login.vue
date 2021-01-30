<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <h2>Login</h2>
                <li class="alert alert-danger" v-for="error in formError">{{error}}</li>
                <span v-if="errors">{{errors}}</span>
                <form class="form-group" method="POST" @submit="login">
                    <input class="form-control" type="text" v-model="username" name="username"><br>
                    <input class="form-control" type="password" v-model="password" name="password"><br>

                    <input type="submit" name="submit" value="Login">
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "Login",
        data(){
            return {
                username : '',
                password : '',
                errors: '',
                formError:[]
            };
        },
        methods:{
            login(event){
                event.preventDefault();
                let vm = this;
                if(this.username !== '' && this.password !== ''){
                    axios.post('/api/login',{
                        'username' : this.username,
                        'password' : this.password,
                    }).then(function (response) {
                        if(response.data){
                            localStorage.setItem('logKey',response.data.token.token);
                            console.log(response.data.token.token);
                            alert('Login Success');
                            vm.$router.replace({path:'/dashboard'})
                        }else{

                        }
                    }).catch(function (error) {
                        vm.formError = error.response.data.errors;
                    });

                }else{
                    this.errors = 'Fields Cannot be empty';
                }
            }
        }
    }
</script>

<style scoped>

</style>