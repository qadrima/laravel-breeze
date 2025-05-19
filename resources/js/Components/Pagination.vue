<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    links: Array,
});

const replaceLabel = (label) => {
    if (label === 'Next &raquo;') {
        return '>';
    }
    if (label === '&laquo; Previous') {
        return '<';
    }
    return label;
}
</script>

<template>
    <!-- <pre>{{ links }}</pre> -->
    <div>
        <div class="flex justify-center space-x-2">
            <template v-for="(link, key) in links" :key="key">

                <div v-if="link.url === null || link.active" 
                    class="py-1 px-1 sm:px-2 text-sm text-gray-500 border rounded"
                    :class="{
                        'bg-gray-600 text-white hover:bg-gray-500': link.active,
                    }"
                    v-html="replaceLabel(link.label)" 
                />

                <Link v-else
                    class="py-1 px-1 sm:px-2 text-sm border rounded hover:bg-gray-100"
                    :href="link.url"
                    v-html="replaceLabel(link.label)"
                />
                
            </template>
        </div>
    </div>
</template> 