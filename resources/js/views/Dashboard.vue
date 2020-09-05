<template>
  
    <div>
        <TopNav></TopNav>
        <Aside></Aside>
        <div class="ml-200 p-3 mt-5 bg-white br-20">
            <h4>Welcome to the Dashboard</h4>
            <p>Click in the person icon on aside menu or in Contacts on top menu  to go to Contacts page</p>
        </div>
    </div> 


</template>

<script>

export default {
    

}
</script>

<style scoped>
    @font-face {
    font-family: 'Roboto';
    src: url(../../sass/fonts/Roboto-Regular.ttf) format('ttf');
    }

    body{
        min-height: 100vh;
        background-color: #dbdee2!important;
        font-family: 'Roboto' !important
    }
    @media(min-width:1200px){
        .ml-200{
            margin-left: 200px;
        }
    }
</style>