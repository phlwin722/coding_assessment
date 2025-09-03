<template>
    <q-inner-loading
      :showing="props.loading"
      :label="props.label"
      label-style="font-size: 1.1em"
    />
  </template>
  
  <script setup>
  const props = defineProps({
    loading: {
      type: Boolean,
      required: true,
    },
    label: {
      type: String,
      default: 'Please wait...',
    },
  })
  </script>