<template>
    <div>
        <form class="form-group" v-on:submit="createAccount" method="POST">
            <label for="">Account Name</label>
            <input class="form-control" type="text" name="account_name" v-model="account_name" placeholder="Account Name"><br>

            <label for="">Bank</label>
            <select class="form-control" name="bank_id"  v-model="bank_id" id="">
                <option v-for="bank in banksData" v-bind:value="{id: bank.id, text: bank.name}">{{bank.name}}</option>
            </select>
            <label for="">Account No</label>
            <input class="form-control" type="number" name="account_no" v-model="account_no" placeholder="Account No"><br>

            <label for="">Branch</label>
            <input class="form-control" type="text" name="branch" v-model="branch" placeholder="Branch"><br>

            <label for="">Account Type</label>
            <input class="form-control" type="number" name="account_type" v-model="account_type" placeholder="Account Type"><br>

            <label for="">Swift Code</label>
            <input class="form-control" type="text" name="sift_code" v-model="sift_code" placeholder="Swift Code"><br>

            <label for="">Route No</label>
            <input class="form-control" type="text" name="route_no" v-model="route_no" placeholder="Route No"><br>

            <input type="submit" name="submit" value="Save / Update">
        </form>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "Form",
        data(){
            return {
                account_name : '',
                bank_id : '',
                account_no : '',
                branch : '',
                account_type : '',
                sift_code : '',
                route_no : '',
                banksData:'',
                eachBankData: '',
                eachBankId: ''
            }
        },
        methods:{
            createAccount(event)
            {
                event.preventDefault();
                let vm = this;
                if(!this.account_name && !this.account_no && !this.branch && !this.account_type && !this.sift_code && !this.route_no && !this.bank_id.id){
                    alert('Fields are empty');
                }else{
                    axios.post('/api/saveAccount', {
                        'account_name': this.account_name,
                        'bank_id' : this.bank_id.id,
                        'account_no' : this.account_no,
                        'branch' : this.branch,
                        'account_type' : this.account_type,
                        'swift_code' : this.sift_code,
                        'route_no' : this.route_no,
                    }).then(function (response) {
                        alert('Save Success');
                        vm.$router.replace({path:'/show'});
                    }).catch(function (error) {
                        alert('Something wrong'+error)
                    });
                }
            }
        },

        mounted() {
            if(this.$route.params.id){
                let vm = this;
                axios.get('/api/getData/'+this.$route.params.id)
                    .then(function (response) {
                        vm.eachBankId = vm.$route.params.id;
                        vm.eachBankData = response.data.data;
                    })
            }else{

            }
            //get bank info
            let vm =this;
            let banks = axios.get('/api/getBank')
                .then(function (response) {
                    // console.log(response.data.banks);
                    vm.banksData = response.data.banks;
                });

        }
    }
</script>

<style scoped>

</style>