<template>
    <div>
        <h2>Dashboard</h2>
        <button @click="logout">logout</button>
    </div>
</template>

<script>
    export default {
        name: "Dashboard",
        data(){
            return {

            };
        },
        methods:{
            logout()
            {
                localStorage.removeItem('logKey');
                this.$router.replace({path:'/login'});

            }
        },

        mounted() {
            // console.log(localStorage.getItem('logKey'));
            if(localStorage.getItem('logKey') == null){
                this.$router.replace({path:'/login'});
            }
        }
    }
</script>

<style scoped>

</style>