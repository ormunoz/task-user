<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <SectionTitle>
                    <template #title>
                        <slot name="title" />
                    </template>
                    <template #description>
                        <slot name="description" />
                    </template>
                </SectionTitle>
            </div>

            <div class="col-md-6">
                <form @submit.prevent="$emit('submitted')">
                    <div class="p-4 bg-white shadow-sm">
                        <slot name="form" />
                        <slot name="actions" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
  
<script setup>
import SectionTitle from './SectionTitle.vue';

defineEmits(['submitted']);

</script>
  