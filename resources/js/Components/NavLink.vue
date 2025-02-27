<script setup>
defineProps({
    routeName: String, 
    componentName: String,
    icon: String,
});
</script>


<template>
    <Link 
        :href="route(routeName)" 
        class="px-3 py-2 rounded-lg hover:bg-blue-700"
        :class="{'bg-blue-700' : $page.component === componentName}"
    >
        <i v-if="icon" :class="`fa-solid fa-${icon} mr-2`"></i>
        <slot />
    </Link>
</template>