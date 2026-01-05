<template>
    <v-input
      :error-messages="validationErrors"
      :disabled="disabled"
    >
      <template #default="{ attrs }">
        <input
            :placeholder="placeholder"
          type="text"
          v-bind="attrs"
          :value="modelValue"
          @input="onInput"
          @blur="handleBlur"
        >
      </template>
      <template #message>
      <div v-if="validationErrors.length > 0" class="error-messages">
        <span v-for="(error, index) in validationErrors" :key="index">{{ error }}</span>
      </div>
    </template>
    </v-input>
  </template>
  
  <script setup>
  import { ref, watch, computed } from 'vue';
  import { useField } from 'vee-validate';
  
  const props = defineProps({
    placeholder: String,
    modelValue: String,
    disabled: Boolean,
    name: {
      type: String,
      required: true
    },
    rules: Object // This is your Yup schema
  });
  
  const emit = defineEmits(['update:modelValue']);
  
  // Extract the validation logic from the passed Yup schema
  const { value: inputValue, errorMessage, handleBlur } = useField(
    props.name,
    props.rules
  );
  
  // Sync internal value with external v-model
  watch(() => props.modelValue, (newVal) => {
    if (newVal !== inputValue.value) {
      inputValue.value = newVal;
    }
  });

  // Function to handle input events
const onInput = (event) => {
  emit('update:modelValue', event.target.value);
};

  
  // Provide a computed ref to collect the validation errors
  const validationErrors = computed(() => {
    return errorMessage.value ? [errorMessage.value] : [];
  });
  
  </script>