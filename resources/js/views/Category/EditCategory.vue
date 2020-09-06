<template>
    <div>

        <TopNav></TopNav>
         <Aside></Aside>
         
            <div class="ml-200 p-3 mt-5 bg-white br-20">
                <div class="d-flex justify-content-between">
                    <h4>Editar o post</h4>
                </div>



               
                <div class="form-group">
                    <label>Nome da categoria:</label>
                    <input type="text" v-model="category.category" class="form-control"/>
                    <p class="red-color" v-for="(categoryErrors, index) in validationsErrors.category" v-bind:key="index">{{categoryErrors}}</p>
                </div>

                <div class="form-group">
                    <label>Cor para o menu:</label>
                    <input type="text" v-model="category.color" class="form-control"/>
                    <p class="red-color" v-for="(colorErrors, index) in validationsErrors.color" v-bind:key="index">{{colorErrors}}</p>
                </div>
    
                <div class="text-right">
                    <b-button size="lg" v-on:click="updateCategory" variant="primary">Salvar</b-button>
                </div>


            </div>

    </div>
</template>


<script>
import Request from '../../libraries/Request';
import Auth from '../../libraries/Auth';
export default {

    data(){
        return {
            category: {category:'', color: ''},
            validationsErrors : {category: [], color: []},
        }
    },

    created(){
        Auth.VerifyLogin();
        this.getCategory()
    },

    methods: {
        async getCategory(){
            const id = this.$route.params.id
            const requisicao = await Request.send({method: 'get', endpoint: 'category/'+id,data:{}})
            this.category = requisicao.data
        },

         async updateCategory(){
               try{
                   const data = this.category
                   await Request.send({method: 'put', endpoint: 'category/'+this.category.id ,data,})
                    alert("Informações salvas com sucesso")
                   this.$router.push('/categorias')
               } catch (error){
                   if(error.response.status == 422){
                       const keys = Object.keys(error.response.data.errors)
                       
                        keys.forEach((value) =>  {
                            this.validationsErrors[value] = error.response.data.errors[value]
                        })
                   
                   }
                    
               }
           },

    }
    
}
</script>