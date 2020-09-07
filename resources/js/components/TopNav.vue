<template>
  
        <b-navbar  toggleable="lg" type="dark" variant="primary" class="mb-0">
               <h4 class="color-white font-weight-bold m-0">Gabriel Manara</h4>
           
                <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

                   <b-collapse id="nav-collapse" is-nav>
          

            <!-- Right aligned nav items -->
                      <b-navbar-nav class="ml-auto">
                           <b-navbar-nav>
                              <b-nav-item v-on:click="logout" href="#">Sair</b-nav-item>
                            
                          </b-navbar-nav>
                       
                      </b-navbar-nav>


            </b-collapse>

            
          
         </b-navbar>
  
</template>

<script>
import Request from '../libraries/Request'
export default {
  name: 'TopNav',
 
 methods:{
   async  logout(){
      try{
            const response = await Request.send({method: 'post' ,endpoint: 'auth/logout', data:{}})
            localStorage.removeItem('auth_token')
            this.$router.push('/login')
      } catch (error){
            localStorage.removeItem('auth_token')
            this.$router.push('/login')
            console.log(error);
      }
    }
 }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->

