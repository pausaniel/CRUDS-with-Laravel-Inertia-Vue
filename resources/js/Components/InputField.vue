<script setup>
const model = defineModel();
defineProps({
    label: String,
    icon: String,
    placeholder: {
        type: String,
        default: "",
    },
    type: {
        type: String,
        default: "text",
    },
});
</script>

<template>
    <div>
        <label 
            :for="label"
            class="block text-sm font-medium text-blue-700 dark:text-blue-300"
        >
            {{ label }}
        </label>
        
        <div class="relative mt-1 rounded-md">
            <div
                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"
            >
                <span class="grid place-content-center text-sm text-blue-400">
                    <i :class="`fa-solid fa-${icon}`"></i>
                </span>
            </div>
            <input
                :type="type"
                :name="label"
                :placeholder="placeholder"
                v-model="model"
                class="block w-full rounded-md pr-3 pl-9 text-sm dark:text-blue-900 border-blue-300 outline-0 focus:ring-1 focus:ring-inset focus:ring-indigo-400 focus:border-indigo-400 placeholder:text-blue-400"
            />
        </div>
    </div>
</template>