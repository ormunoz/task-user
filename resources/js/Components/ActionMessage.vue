<template>
    <div>
        <transition leave-active-class="fade-transition" leave-from-class="opacity-100" leave-to-class="opacity-0">
            <div v-show="on" class="alert alert-secondary text-sm mb-0" role="alert">
                <slot />
            </div>
        </transition>
    </div>
</template>
  
<script setup>
import { defineProps } from 'vue';

defineProps({
    on: Boolean,
});
</script>
  
<style>
.fade-transition {
    transition: opacity 1s ease-in;
}
</style>
  
