<template>
    <div>
        <TopNav></TopNav>
        <Aside></Aside>
          <router-view></router-view>
         
            <div class="ml-200 p-3 mt-5 bg-white br-20">
                <div class="d-flex justify-content-between">
                    <h4 class="mt-0">Lista de Post's</h4>
                    <a class="btn btn-primary" href="/posts/criar">Adicionar novo</a>
                </div>

                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Subtitulo</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="post in posts" v-bind:key="post.id">
                            <th scope="row">{{post.id}}</th>
                            <td>{{post.title}}</td>
                            <td>{{post.subtitle}}</td>
                            <td>
                                
                                <b-icon-pencil-square class="hover" v-on:click="goEdit(post.id)" ></b-icon-pencil-square>
                                <BIconTrash v-on:click="deletePost(post.id)" class="hover"></BIconTrash>
                            </td>
                        </tr>
                       
                    </tbody>
                </table>

                <div class="text-right">
                    <a class="blue-color px-1" href="#" v-on:click="changePage('prev')">{{prevPage}}</a>
                    <a class="black-color px-1">{{currentPage}}</a>
                    <a class="blue-color px-1" href="#" v-on:click="changePage('next')">{{nextPage}}</a>
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
        this.getPosts();
    },

    data() {
        return {
            posts: [],
            post: {id:"", title:"", subtitle: "", content: "" },
            currentPage: null,
            prevPage: null,
            nextPage: null,
            pageAction: null,
        }
    },
    methods: {

            goEdit(id){
                this.$router.push('posts/editar/'+id)
            },
            async getPosts(){
                const endpoint = this.pageAction != null ? 'post/'+this.pageAction : 'post/'
                const requisicao = await Request.send({method: 'get', endpoint , data:{}})
                this.posts = requisicao.data.data;
                this.currentPage = requisicao.data.current_page
                this.prevPage = requisicao.data.prev_page_url != null ? requisicao.data.prev_page_url.slice(-1) : null;
                this.nextPage = requisicao.data.next_page_url != null ? requisicao.data.next_page_url.slice(-1) : null; 
            },


           async deletePost(id){
               try{
                   await Request.send({method: 'DELETE', endpoint: 'post/'+id,data:{}});
                   this.getPosts();
               } catch (error){
                    console.log(error)
               }
           },
           changePage(action){
               if(action === 'prev'){
                   this.pageAction = '?page='+this.prevPage
               }else{
                   this.pageAction = '?page='+this.nextPage
               }
               this.getPosts()
           }
          
    }
    
}
</script>

<style>
.hover:hover{
    cursor: pointer;
}
@media(min-width:1200px){
    .ml-200{
        margin-left: 200px;
    }
}
</style>