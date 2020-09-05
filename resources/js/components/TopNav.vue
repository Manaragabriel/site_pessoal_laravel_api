<template>
  
        <b-navbar  toggleable="lg" type="dark" variant="primary" class="mb-0">
        
           
                <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

                   <b-collapse id="nav-collapse" is-nav>
          

            <!-- Right aligned nav items -->
                      <b-navbar-nav class="ml-auto">
                           <b-navbar-nav>
                              <b-nav-item href="configuracoes">Configurações</b-nav-item>
                              <b-nav-item href="#">Sair</b-nav-item>
                            
                          </b-navbar-nav>
                       
                      </b-navbar-nav>


            </b-collapse>

            
          
         </b-navbar>
  
</template>

<script>
export default {
  name: 'TopNav',
 
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->

