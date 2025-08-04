<script setup>
import { ref } from 'vue';


const emits = defineEmits(['update:modelValue']);

const value = ref('');

defineProps({
    label: String,
    type: String,
    name: String,
    placeholder: String,
    length: {
        default: 6,
        type: Number,
        required: true
    },
    isTextArea: {
        type: Boolean,
        default: false
    }
});

</script>
<template>
    <div :class="`col-md-${length}`" v-if="!isTextArea">
        <div class="form-floating form-floating-outline">
            <input @input="emits('update:modelValue', $event.target.value)" :type="type" :name="name" class="form-control" :placeholder="placeholder" required>
            <label>{{ label }}</label>
        </div>
    </div>
    <div class="col-md-12" v-else>
        <div class="form-floating form-floating-outline">
            <textarea @input="emits('update:modelValue', $event.target.value)" :name="name" class="form-control" :placeholder="placeholder"></textarea>
            <label>{{ label }}</label>
        </div>
    </div>
</template>
