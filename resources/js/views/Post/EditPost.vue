<template>
    <div>

        <TopNav></TopNav>
         <Aside></Aside>
         
            <div class="ml-200 p-3 mt-5 bg-white br-20">
                <div class="d-flex justify-content-between">
                    <h4>Editar o post</h4>
                </div>



               
                <div class="form-group">
                    <label>Titulo:</label>
                    <input type="text" v-model="post.title" class="form-control"/>
                    <p class="red-color" v-for="(titleErrors, index) in validationsErrors.title" v-bind:key="index">{{titleErrors}}</p>
                </div>

                <div class="form-group">
                    <label>Subtitulo:</label>
                    <input type="text" v-model="post.subtitle" class="form-control"/>
                    <p class="red-color" v-for="(subTitleErrors, index) in validationsErrors.subtitle" v-bind:key="index">{{subTitleErrors}}</p>
                </div>

                <div class="form-group">
                    <label>Conteúdo</label>
                    <textarea  v-model="post.content" class="form-control"/>
                     <p class="red-color" v-for="(contentErrors, index) in validationsErrors.content" v-bind:key="index">{{contentErrors}}</p>
                </div>

                
                <div class="form-group col-lg-4 p-0">
                    <label>Categoria</label>
                    <select v-model="post.category_id" class="form-control">
                        <option v-for="(category, index) in categories" v-bind:key="index" v-bind:value="category.id">{{category.category}}</option>
                    </select>
                </div>
    
                <div class="text-right">
                    <b-button size="lg" v-on:click="updatePost" variant="primary">Salvar</b-button>
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
            post: {id:"", title:"", subtitle: "", content: "", category_id: "" },
            categories: [],
            validationsErrors : {title: [], subtitle: [], content: []},
        }
    },

    created(){
        Auth.VerifyLogin();
        this.getPost();
        this.getCategories();
    },

    methods: {
        async getPost(){
            const id = this.$route.params.id
            const requisicao = await Request.send({method: 'get', endpoint: 'post/'+id,data:{}})
            this.post = requisicao.data
        },
        async getCategories(){
            const endpoint =  'category/'
            const requisicao = await Request.send({method: 'get', endpoint , data:{}})
            this.categories = requisicao.data.data;         
        },
         async updatePost(){
               try{
                   const data = this.post
                   await Request.send({method: 'put', endpoint: 'post/'+this.post.id ,data,})
                    alert("Informações salvas com sucesso")
                   this.$router.push('/posts')
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