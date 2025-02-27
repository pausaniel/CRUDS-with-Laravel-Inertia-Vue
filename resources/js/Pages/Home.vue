<script setup>
import Container from '../Components/Container.vue';
import { Inertia } from '@inertiajs/inertia';
import { usePage } from '@inertiajs/vue3';
import { switchTheme } from '../theme';
import { ref, computed } from 'vue';

const page = usePage();
const user = page.props.auth.user;
const products = page.props.products;

console.log('User:', user);
console.log('Products:', products);

const searchQuery = ref('');

const filteredProducts = computed(() => {
  if (!searchQuery.value) {
    return products;
  }
  return products.filter(product =>
    product.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
    product.description.toLowerCase().includes(searchQuery.value.toLowerCase())
  );
});

const addToCart = (productId) => {
  Inertia.post(route('cart.add'), { product_id: productId });
};
</script>

<template>
    <header>
        <Container>
        <div class="flex items-center space-x-3">
            <i class="fa-solid fa-store text-2xl"></i>
            <h1 class="text-3xl font-bold">Welcome to Products.ph</h1>
        </div>
        <p class="mt-2 text-lg">Discover a wide variety of products at unbeatable prices. Enjoy a seamless shopping experience with us! An open marketplace for everyone where they can buy and sell.</p>
        <div class="mt-4 flex items-center space-x-4">
            <div class="flex items-center space-x-2 text-blue-600">
                <i class="fa-brands fa-facebook text-2xl"></i>
                <span>facebook.com/products.ph</span>
            </div>
            <div class="flex items-center space-x-2 text-pink-500">
                <i class="fa-brands fa-instagram text-2xl"></i>
                <span>@products.ph</span>
            </div>
        </div>
        </Container>

        <!-- Search Input -->
        <div class="mb-4 mt-4 flex items-center">
            <input
                type="text"
                v-model="searchQuery"
                placeholder="Search products..."
                class="w-full rounded-l bg-white dark:bg-slate-800 text-black dark:text-white"
            />
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r transition duration-300 ease-in-out dark:bg-slate-800 dark:hover:bg-slate-600">
                <i class="fa-solid fa-search"></i>
            </button>
        </div>

        <div class="grid stretch grid-cols-4 gap-4 mt-8">
           
            <div v-for="product in filteredProducts" :key="product.id" class="p-4 rounded shadow hover:shadow-lg bg-white dark:bg-slate-800">
                <h2 class="text-xl font-semibold mb-2">{{ product.name }}</h2>
                <p class="text-gray-700 dark:text-gray-300 mb-2">{{ product.description }}</p>
                <p class="text-green-600 font-bold mb-2">Price: ${{ product.price }}</p>
                <p class="text-gray-500 dark:text-gray-400 mb-4">Seller: {{ product.user.name }}</p>
                <button 
                    v-if="user && product.user_id !== user.id" 
                    @click="addToCart(product.id)"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out"
                >
                    Add to Cart
                </button>
            </div>
        </div>

    </header>
</template>

