<script>
import { Inertia } from '@inertiajs/inertia';

export default {
  props: {
    products: Array,
  },
  methods: {
    addProduct() {
      Inertia.visit(route('products.create'));
    },
    editProduct(productId) {
      Inertia.visit(route('products.edit', productId));
    },
    deleteProduct(productId) {
      if (confirm('Are you sure you want to delete this product?')) {
        Inertia.delete(route('products.destroy', productId), {
          onSuccess: () => {
            this.$emit('refresh');
          },
        });
      }
    },
  },
};
</script>

<template>
  <div>
    <div class="flex justify-between items-center mb-4">
      <h1 class="text-2xl font-bold dark:text-white">Your Products</h1>
      <button @click="addProduct" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">Add New Product</button>
    </div>
    <ul class="space-y-4">
      <li v-for="product in products" :key="product.id" class="p-4 rounded shadow hover:shadow-lg transition duration-300 ease-in-out bg-gray-100 dark:bg-slate-800">
        <h2 class="text-xl font-semibold dark:text-white">{{ product.name }}</h2>
        <p class="text-gray-700 dark:text-white">Description: {{ product.description }}</p>
        <p class="text-green-600 font-bold dark:text-green-400"> ₱{{ product.price }}</p>
        <div class="flex justify-end space-x-2">
          <button @click="editProduct(product.id)" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">Edit</button>
          <button @click="deleteProduct(product.id)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">Delete</button>
        </div>
      </li>
    </ul>
  </div>
</template>
