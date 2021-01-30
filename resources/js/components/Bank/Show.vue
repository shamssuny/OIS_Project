<template>
    <div class="row col-md-8">
        <table border="1px" width="100%">
            <tr>
                <th>Account Name</th>
                <th>Bank</th>
                <th>Account No</th>
                <th>Branch</th>
                <th>Account Type</th>
                <th>Actions</th>
            </tr>

            <tr v-for="account in accountData">
                <td>{{account.account_name}}</td>
                <td>{{account.bank.name}}</td>
                <td>{{account.account_no}}</td>
                <td>{{account.branch}}</td>
                <td>{{account.account_type===1?'Saving':account.account_type===2? 'Current':'Join'}}</td>
                <td> <button @click="editPage(account.id)">edit</button> <button @click="deleteAccount(account.id)">Delete</button></td>
            </tr>

        </table>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "Show",
        data(){
            return {
                accountData: ''
            }
        },
        methods:{
            deleteAccount(id){
                let vm = this;
                axios.get('/api/delete/'+id)
                    .then(function (response) {
                        alert('Deleted');
                        vm.getData();
                    }).catch(function (error) {
                        alert('Something wrong');
                    });
            },

            editPage(id){
                this.$router.replace({path:'/edit/'+id});
            },

            getData(){
                let vm = this;
                axios.get('/api/getAccounts')
                    .then(function(response){
                        vm.accountData = response.data.data;
                    });
            }
        },
        mounted() {
            let vm = this;
            axios.get('/api/getAccounts')
                .then(function(response){
                    vm.accountData = response.data.data;
                });
        }
    }
</script>

<style scoped>

</style>