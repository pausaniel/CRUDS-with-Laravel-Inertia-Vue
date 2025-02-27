<script>
import { Inertia } from '@inertiajs/inertia';

export default {
  props: {
    product: Object,
  },
  data() {
    return {
      form: {
        name: this.product ? this.product.name : '',
        description: this.product ? this.product.description : '',
        price: this.product ? this.product.price : '',
      },
    };
  },
  computed: {
    isEdit() {
      return !!this.product;
    },
  },
  methods: {
    submitForm() {
      if (this.isEdit) {
        Inertia.put(route('products.update', this.product.id), this.form);
      } else {
        Inertia.post(route('products.store'), this.form);
      }
    },
  },
};
</script>

<template>
  <div class="max-w-lg mx-auto p-6 bg-white dark:bg-gray-800 rounded shadow-md">
    <h1 class="text-2xl font-bold mb-4 text-gray-900 dark:text-gray-100">{{ isEdit ? 'Edit Product' : 'Add New Product' }}</h1>
    <form @submit.prevent="submitForm" class="space-y-4">
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name:</label>
        <input type="text" v-model="form.name" required class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100" />
      </div>
      <div>
        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description:</label>
        <textarea v-model="form.description" class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"></textarea>
      </div>
      <div>
        <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price:</label>
        <input type="number" v-model="form.price" required class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100" />
      </div>
      <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">{{ isEdit ? 'Update' : 'Create' }}</button>
    </form>
  </div>
</template>
