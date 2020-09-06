<template>
    <div class="bg-default h-100vh d-flex align-items-center justify-content-center">
        <div class="bg-white col-10 col-lg-3 p-4">
            <h4 class="m-0 text-center font-weight-bold">Faça login</h4>
             <div class="form-group">
                    <label class="font-weight-bold">Email:</label>
                    <input type="email" v-model="user.email" class="form-control"/>
                    
                </div>

                <div class="form-group">
                    <label class="font-weight-bold">Senha:</label>
                    <input type="password" v-model="user.password" class="form-control"/>
                    <p class="red-color" v-for="(subTitleErrors, index) in validationsErrors.subtitle" v-bind:key="index">{{subTitleErrors}}</p>
                </div>

    
                <div class="text-center">
                    <b-button size="lg" v-on:click="login" variant="primary">Fazer login</b-button>
                </div>
                <p class="font-weight-bold text-danger" v-if="this.unauthorized">Credenciais incorretas</p>
        </div>
    </div>
</template>


<script>
import Request from '../../libraries/Request';
export default {
    
    data(){
        return {
            user: {email: '', password: ''},
            validationsErrors: [],
            unauthorized: false,
        }
    },

    methods: {
        async login(){
            try{
                const data = this.user;
                const response = await Request.send({method: 'post' ,endpoint: 'auth/login', data,})
                localStorage.setItem('auth_token', response.data.access_token)
                this.$router.push('/')
            } catch (error){
                console.log(error)
                if(error.response.status == 401){
                   this.unauthorized = true;
                }
                
            }
        }
    }

}
</script>

<style scoped>
    .h-100vh{
        height: 100vh;
    }
</style>