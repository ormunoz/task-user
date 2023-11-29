<template>
    <div class="relative">
        <div @click="open = !open">
            <slot name="trigger" />
        </div>

        <!-- Full Screen Dropdown Overlay -->
        <div v-show="open" class="fixed inset-0 z-40" @click="open = false" />

        <transition enter-active-class="transition ease-out duration-200" enter-from-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75"
            leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
            <div v-show="open" class="position-absolute z-50 mt-2" :class="[widthClass, alignmentClasses, contentClasses]"
                style="display: none;" @click="open = false">
                <div class="rounded-md bg-light shadow-lg">
                    <slot name="content" />
                </div>
            </div>
        </transition>
    </div>
</template>
  
<script>
import { defineComponent, ref, onMounted, onUnmounted, computed } from 'vue';

export default defineComponent({
    props: {
        align: {
            type: String,
            default: 'right',
        },
        width: {
            type: String,
            default: '48',
        },
        contentClasses: {
            type: Array,
            default: () => ['py-1', 'bg-white'],
        },
    },
    setup(props, { emit }) {
        const open = ref(false);
        
        const widthClass = computed(() => {
            return {
                '48': 'w-48',
            }[props.width.toString()];
        });

        const alignmentClasses = computed(() => {
            if (props.align === 'left') {
                return 'start-0';
            }

            if (props.align === 'right') {
                return 'end-0';
            }

        });
        return {
            open,
            widthClass,
            alignmentClasses
        }
    }
})

</script>
