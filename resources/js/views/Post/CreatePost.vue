<template>
    <div>

        <TopNav></TopNav>
         <Aside></Aside>
         
            <div class="ml-200 p-3 mt-5 bg-white br-20">
                <div class="d-flex justify-content-between">
                    <h4>Criar novo Post</h4>
                </div>



               
                <div class="form-group">
                    <label>Titulo:</label>
                    <input type="text" v-model="post.title" class="form-control"/>
                    <p class="red-color" v-for="(titleErrors, index) in validationsErrors.title" v-bind:key="index">{{titleErrors}}</p>
                </div>

                <div class="form-group">
                    <label>Subtitulo:</label>
                    <input type="text" v-model="post.subtitle" class="form-control"/>
                    <p class="red-color" v-for="(subTitleErrors, index) in validationsErrors.subtitle" v-bind:key="index">{{subtitleErrors}}</p>
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

                <div class="p-0">
                    <label>Selecionar imagem de capa</label>
                    <br>
                     <input type="file" ref="image" v-on:change="selectFile"/>
                    
                </div>

                <div class="text-right">
                    <b-button size="lg" v-on:click="createPost" variant="primary">Salvar</b-button>
                </div>


            </div>

    </div>
</template>


<script>
import Request from '../../libraries/Request';
import Auth from '../../libraries/Auth';
export default {

    created(){
        Auth.VerifyLogin();
        this.getCategories();
    },
    data(){
        return {
            post: {title:'', subtitle: '',content: '',category_id: '', image: null},
            categories: [],
            validationsErrors : {title: [], subtitle: [], content: []},
        
        }
    },

    methods: {
    
         async createPost(){
            try{
                const data = new FormData();
                data.append('title', this.post.title);
                data.append('subtitle', this.post.subtitle);
                data.append('content', this.post.content);
                data.append('category_id', this.post.category_id);
                data.append('image', this.post.image);
                await Request.send({method: 'post' ,endpoint: 'post', data,})
                alert("Criado com sucesso")
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
        async selectFile(file){
            this.post.image = this.$refs.image.files[0];
            console.log(this.post)
        },

        async getCategories(){
            const endpoint =  'category/'
            const requisicao = await Request.send({method: 'get', endpoint , data:{}})
            this.categories = requisicao.data.data;         
        },


    }
    
}
</script>

<style scoped>
textarea{
    border: 1px solid #e3e3e3;
}
</style>