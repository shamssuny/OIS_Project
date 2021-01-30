<template>
    <div>
        <Navigation/>
        <form class="form-group" v-on:submit="createAccount" method="POST">
            <label for="">Account Name</label>
            <input class="form-control" type="text" name="account_name" v-model="account_name" placeholder="Account Name"><br>

            <label for="">Bank</label>
            <select class="form-control" name="bank_id"  v-model="bank_id" id="">
                <option v-for="bank in banksData" v-bind:value="bank.id" :selected="bank_id===bank.id?true:false">{{bank.name}}</option>
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
    import Navigation from './Navigation'
    export default {
        name: "Form",
        components:{
            Navigation
        },
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
                    if(this.$route.params.id){
                        //update data
                        axios.post('/api/updateAccount/'+this.$route.params.id, {
                            'account_name': this.account_name,
                            'bank_id' : this.bank_id,
                            'account_no' : this.account_no,
                            'branch' : this.branch,
                            'account_type' : this.account_type,
                            'swift_code' : this.sift_code,
                            'route_no' : this.route_no,
                        }).then(function (response) {
                            alert('Update Success');
                            vm.$router.replace({path:'/show'});
                        }).catch(function (error) {
                            alert('Something wrong'+error)
                        });

                    }else{
                        axios.post('/api/saveAccount', {
                            'account_name': this.account_name,
                            'bank_id' : this.bank_id,
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

            resetData(){
                let vm = this;
                vm.account_name = '';
                vm.account_no = '';
                vm.branch = '';
                vm.account_type = '';
                vm.sift_code = '';
                vm.route_no = '';
                vm.bank_id = '';
            },

            setFormData(){
                //get bank info
                let vm =this;
                axios.get('/api/getBank')
                    .then(function (response) {
                        // console.log(response.data.banks);
                        vm.banksData = response.data.banks;
                    });

                if(this.$route.params.id){
                    let vm = this;
                    axios.get('/api/getData/'+this.$route.params.id)
                        .then(function (response) {
                            vm.eachBankId = vm.$route.params.id;
                            vm.eachBankData = response.data.data[0];

                            //set the input values
                            console.log(vm.eachBankData[0]);
                            vm.account_name = vm.eachBankData.account_name;
                            vm.account_no = vm.eachBankData.account_no;
                            vm.branch = vm.eachBankData.branch;
                            vm.account_type = vm.eachBankData.account_type;
                            vm.sift_code = vm.eachBankData.swift_code;
                            vm.route_no = vm.eachBankData.route_no;
                            vm.bank_id = vm.eachBankData.bank_id;
                            //set selected bank option

                        })
                }else{
                    this.resetData()
                }
            }
        },

        mounted() {
            this.setFormData()
        },

        watch: {
            // call again the method if the route changes
            '$route': 'setFormData'
        },
    }
</script>

<style scoped>

</style>