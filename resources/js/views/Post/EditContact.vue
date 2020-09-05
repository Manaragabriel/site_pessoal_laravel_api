<template>
    <div>

        <TopNav></TopNav>
         
         
            <div class="container p-3 mt-5 bg-white br-20">
                <div class="d-flex justify-content-between">
                    <h4>Edit new contact</h4>
                </div>



               
                <div class="form-group">
                    <label>Contact Name:</label>
                    <input type="text" v-model="contact.name" class="form-control"/>
                    <p class="red-color" v-for="(nameErrors, index) in validationsErrors.name" v-bind:key="index">{{nameErrors}}</p>
                </div>

                <div class="form-group">
                    <label>Contact Email:</label>
                    <input type="email" v-model="contact.email" class="form-control"/>
                    <p class="red-color" v-for="(emailErrors, index) in validationsErrors.email" v-bind:key="index">{{emailErrors}}</p>
                </div>

                <div class="form-group">
                    <label>Contact Address:</label>
                    <input type="text" v-model="contact.address" class="form-control"/>
                </div>
    
                <div class="text-right">
                    <b-button size="lg" v-on:click="updateContact" variant="primary">Update</b-button>
                </div>


                 
                
               

            </div>

    </div>
</template>


<script>
import Request from '../../libraries/Request';
import querystring from 'querystring';
export default {

    data(){
        return {
            contact: [{name:'', email: '',address: ''}],
            validationsErrors : {name:[], email: []},
        }
    },

    created(){
        this.getContact()
    },

    methods: {
        async getContact(){
            const id = this.$route.params.id
            const requisicao = await Request.send({method: 'get', endpoint: 'contact/'+id,data:{}})
            this.contact = requisicao.data[0]
        },

         async updateContact(){
               try{
                   const data = querystring.stringify(this.contact)
                   await Request.send({method: 'put', endpoint: 'contact/'+this.contact.id ,data,})
                    alert("Edited with successful")
                   this.$router.push('/contacts')
               } catch (error){
                   if(error.response.status == 422){
                       const keys = Object.keys(error.response.data)
                        keys.forEach((value) =>  {
                            this.validationsErrors[value] = error.response.data[value]
                        })
                   
                   }
                    
               }
           },

    }
    
}
</script>