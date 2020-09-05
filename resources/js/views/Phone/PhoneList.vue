<template>
    <div>

        <TopNav></TopNav>
         
         
            <div class="container p-3 mt-5 bg-white br-20">
                <div class="d-flex justify-content-between">
                    <h4>List of phones of {{contact.name}}</h4>
                    <b-button size="lg" v-on:click="modalShow = !modalShow" variant="primary">Add new</b-button>
            </div>


            <table class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col">Number</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="phoneLoop in phones" v-bind:key="phoneLoop.id">
                        <td>{{phoneLoop.number}}</td>
                        <td>
                            <b-icon-trash class="hover" v-on:click="deletePhone(phoneLoop.id)"></b-icon-trash>
                        </td>
                    </tr>
                    
                </tbody>
           </table>


            <b-modal size="lg" v-model="modalShow" title="Contact Form">
                <div class="form-group">
                    <label>Number:</label>
                        <input type="text" class="form-control" v-model="phone.number"/>
                    <p class="red-color" v-for="(numberErrors, index) in validationsErrors.number" v-bind:key="index">{{numberErrors}}</p>
                </div>

                
            
                <div slot="modal-footer">
                    <b-button size="lg" v-on:click="createPhone" variant="primary">Save</b-button>
                </div>
                
            </b-modal>


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
            phone: {number: ''},
            phones: [],
            modalShow: false,
            validationsErrors : {number: []},
        }
    },
    
    created(){
        this.getContact()
        this.getPhones()
    },
    methods: {

        async getContact(){
            const id = this.$route.params.contact_id
            const requisicao = await Request.send({method: 'get', endpoint: 'contact/'+id,data:{}})
            this.contact = requisicao.data[0]
        },

        async getPhones(){
            try{
                const id = this.$route.params.contact_id
                const requisicao = await Request.send({method: 'get', endpoint: 'phone/'+id,data:{}})
                this.phones = requisicao.data
            } catch (error){
                console.log(error)
            }
        },
    
         async createPhone(){
               try{
                   this.phone.contact_id = this.contact.id;
                   const data = querystring.stringify(this.phone)
                   await Request.send({method: 'post', endpoint: 'phone/' ,data,});
                   alert("Created with sucessful");
                   this.modalShow = false;
                   this.getPhones();
               } catch (error){
                   if(error.response.status == 422){
                       const keys = Object.keys(error.response.data)
                        keys.forEach((value) =>  {
                            this.validationsErrors[value] = error.response.data[value]
                        })
                   
                   }
                    
               }
           },

           
           async deletePhone(id){
               try{
                   await Request.send({method: 'DELETE', endpoint: 'phone/'+id,data:{}});
                   this.getPhones();
               } catch (error){
                    console.log(error)
               }
           },

    }
    
}
</script>