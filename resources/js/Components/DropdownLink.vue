<template>
    <div>
        <button v-if="as === 'button'" type="submit" class="btn btn-link text-dark" @click="$emit('click')">
            <slot />
        </button>

        <a v-else-if="as === 'a'" :href="href" class="btn btn-link text-dark" role="button">
            <slot />
        </a>

        <Link v-else :href="href" class="btn btn-link text-dark">
        <slot />
        </Link>
    </div>
</template>
  
<script setup>
import { defineProps } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    href: String,
    as: String,
});

</script>
  