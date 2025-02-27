<script setup>
import { switchTheme } from '../theme';
import navlink from '../Components/navlink.vue';

</script>

<template>
    <header class="bg-slate-800 text-white">
        <nav class="p-6 mx-auto max-w-screen-lg flex items-center justify-between">
            
            <navlink routeName="home" componentName="Home">Home</navlink>

            <div class="flex items-center space-x-6">
                <p>Cart</p>
                <p>Products</p>
                <navlink routeName="login" componentName="Auth/Login" icon="user">Login</navlink>
                <navlink routeName="register" componentName="Auth/Register" icon="">Signup</navlink>

                <button 
                    @click="switchTheme"
                    class="hover:bg-slate-700 w-6 h-6 grid-place-item-center rounded-full hover:outline outline-1 outline-white">
                    <i class="fa-solid fa-circle-half-stroke"></i>
                </button>
            </div>


        </nav>
    </header>

    <main class="p-6 mx-auto max-w-screen-lg">
        <slot />
    </main>
</template>
