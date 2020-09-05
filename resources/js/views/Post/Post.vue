<template>
    <div>
        <TopNav></TopNav>
        <Aside></Aside>
          <router-view></router-view>
         
            <div class="ml-200 p-3 mt-5 bg-white br-20">
                <div class="d-flex justify-content-between">
                    <h4>Lista de Post's</h4>
                    <a class="btn btn-primary" href="/contacts/create">Add new</a>
                </div>

               <div class="alert alert-success mt-2" v-if="success">
                   <span>Contact inserted with successful!</span>
               </div>

                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="contact in contacts" v-bind:key="contact.id">
                            <th scope="row">{{contact.id}}</th>
                            <td>{{contact.name}}</td>
                            <td>{{contact.email}}</td>
                            <td>
                                
                                <b-icon-phone class="hover"  v-on:click="goPhonesList(contact.id)" ></b-icon-phone>
                                <b-icon-pencil-square class="hover" v-on:click="goEdit(contact.id)" ></b-icon-pencil-square>
                                <b-icon-trash v-on:click="deleteContact(contact.id)" class="hover"></b-icon-trash>
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
export default {
   
    created(){
        this.getContacts();
    },

    data() {
        return {
            contacts: [{name:"gabriel", email: "teste"}],
            contact: { name:"", email: "", address: "" },
            validationsErrors : {name:[], email: []},
            currentPage: null,
            prevPage: null,
            nextPage: null,
            pageAction: null,
        }
    },
    methods: {

         

            goEdit(id){
                this.$router.push('contacts/edit/'+id)
            },
            async getContacts(){
                const endpoint = this.pageAction != null ? 'contact/'+this.pageAction : 'contact/'
                const requisicao = await Request.send({method: 'get', endpoint , data:{}})
                this.contacts = requisicao.data.data
                this.currentPage = requisicao.data.current_page
                this.prevPage = requisicao.data.prev_page_url != null ? requisicao.data.prev_page_url.slice(-1) : null;
                this.nextPage = requisicao.data.next_page_url != null ? requisicao.data.next_page_url.slice(-1) : null;
            },


           async deleteContact(id){
               try{
                   await Request.send({method: 'DELETE', endpoint: 'contact/'+id,data:{}});
                   this.getContacts();
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
               this.getContacts()
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