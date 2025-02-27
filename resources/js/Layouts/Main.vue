<script setup>
import { switchTheme } from '../theme';
import navlink from '../Components/navlink.vue';
import { usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const page = usePage();
const user = computed(() => page.props.auth.user);

const show = ref(false);
</script>

<template>
    <div v-show="show" @click="show = false" class="fixed inset-0 z-40">

    </div>

    <header class="bg-blue-600 text-white dark:bg-slate-900">
        <nav class="p-6 mx-auto max-w-screen-lg flex items-center justify-between">
            
            <navlink routeName="home" componentName="Home">Home</navlink>
            
            <div class="flex place-items-center space-x-3">
                <i class="fa-solid fa-shirt"/>
                <h1 class="font-bold text-xl">Products</h1>
            </div>
            

            <div class="flex items-center space-x-6">

                <!-- Auth -->
                <div v-if="user" class="relative">
                    
                    <div 
                        @click="show =!show" 
                        class="flex items-center gap-2 px-3 py-1 rounded-lg hover:bg-blue-700 cursor-pointer" :class="{'bg-blue-700': show}" >
                        <p>{{ user.name }}</p>
                        <i class="fa-solid fa-angle-down"/>
                    </div>

                    <!-- User dropdown -->
                    <div 
                        v-show="show"
                        @click="show = false" 
                        class="absolute z-50 top-10 right-2 bg-blue-900 text-white rounded-lg border-blue-100 border overflow-hidden w-40">
                        
                        <Link 
                            :href="route('logout')"
                            method="post"
                            as="button"
                            class="block w-full px-6 py-3 hover:bg-blue-700 text-left"> Logout
                        </Link>
                    </div>
                </div>

                <div v-if="user">
                    <div  
                        class="hover:bg-blue-700 dark:hover:bg-slate-700 w-6 h-6 grid-place-item-center rounded-full cursor-pointer">
                        <i class="fa-solid fa-cart-shopping"/>
                    </div>
                </div>

                <!-- Guest -->
                <div v-else class="space-x-6">
                    <navlink routeName="login" componentName="Auth/Login" icon="user">Login</navlink>
                    <navlink routeName="register" componentName="Auth/Register" icon="">Signup</navlink>

                </div>

                <button 
                    @click="switchTheme"
                    class="hover:bg-blue-700 dark:hover:bg-slate-700 w-6 h-6 grid-place-item-center rounded-full hover:outline outline-1 outline-white">
                    <i class="fa-solid fa-circle-half-stroke"></i>
                </button>
            </div>


        </nav>
    </header>

    <main class="p-6 mx-auto max-w-screen-lg">
        <slot />
    </main>
</template>
