<!-- NavLink.vue -->
<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
    icon: {
        type: Object, // Ikon sebagai komponen
        default: null,
    },
});

const classes = computed(() =>
    props.active
        ? 'flex items-center gap-2 py-2 px-3 rounded hover:bg-gray-700 bg-gray-900 text-white'
        : 'flex items-center gap-2 py-2 px-3 rounded hover:bg-gray-700'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <component :is="icon" class="w-5 h-5" v-if="icon" />
        <slot />
    </Link>
</template>