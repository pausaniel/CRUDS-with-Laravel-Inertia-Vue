<script>
export default {
  props: {
    cartItems: Array,
  },
  methods: {
    removeFromCart(cartItemId) {
    },
  },
};
</script>

<template>
  <h1 class="text-2xl font-bold mb-4">Your Cart</h1>
  
  <div class="p-6 bg-white rounded-lg shadow-lg dark:bg-slate-800">
      <div class="flex justify-between items-start">
        <ul class="w-3/4">
          <li v-for="item in cartItems" :key="item.id" class="mb-4 p-4 border-b border-gray-200 dark:border-slate-700">
            <h2 class="text-xl font-semibold">{{ item.product.name }}</h2>
            <p class="text-gray-700 dark:text-gray-300">Quantity: {{ item.quantity }}</p>
            <p class="text-gray-700 dark:text-gray-300">Price: ${{ item.product.price }}</p>
          </li>
        </ul>
        <button 
              @click="removeFromCart(item.id)" 
              class="mt-2 px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600"
            >
              Remove
        </button>
      </div>
  </div>
</template>
