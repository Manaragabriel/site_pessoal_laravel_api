<template>
    <aside class="bg-aside aside w-200 px-4 d-none d-lg-block">
        <h4 class="color-white font-weight-bold">Painel Admin</h4>
        <ul class="nav flex-column">
            <li class="nav-item color-white">
                <a class="nav-link"  href="categorias">Categorias</a>
            </li>
            <li class="nav-item">
                <a class="nav-link color-white" href="posts">Posts</a>
            </li>
      
        </ul>
    </aside>
</template>

<script>
export default {
    
}
</script>

<style>
.aside{
    position:fixed;
    left: 0;
    min-height: 100vh;
}
.menu-icon{
    width:40px;
    height:40px
}
.bg-aside{
    background-color: #444;
}
.color-white{
    color: white
}

@media(min-width:1200px){
    .w-200{
        width: 200px;
    }
}


</style>