<template>
    <q-input 
      dense
      outlined 
      v-bind="props"
      hide-bottom-space
      @focused="isFocused = true"
      @blur="isFocused = false"
      :class="inputClass"
      @mousedowwn="isClicked = true"
      class="q-pt-sm q-pb-sm"
    >
      <template v-if="$slots.prepend" #prepend>
        <slot 
          name="prepend" 
        />
      </template>
      
      <template v-if="$slots.append" #append>
        <slot 
          name="append" 
        />
      </template>
    </q-input>
  </template>
  
  <script setup>
  import { 
    ref,
    computed,
    watch,
  } from 'vue' 
  
  const isFocused = ref(false)
  const isClicked = ref(false)
  
  const props = defineProps({
    icon: {
      type: String,
      default: 'text',
    },
    label: String,
    type: String,
  })
  
  // Reset click highlight if not focused
  watch(isFocused, (focused) => {
    if (!focused) {
      isClicked.value = false
    }
  })
  
  // Apply class when input is either focused or clicked
  const inputClass = computed(() =>
    isFocused.value || isClicked.value ? 'input-focused' : '',
  )
  </script>
  
  <style scoped>
  .input-focused .q-field__control {
    border-color: black;
    box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
  }
  
  .input-focused .q-field_label {
    color: black;
  }
  </style>
  