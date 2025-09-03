<template>
    <div>
      <video
        ref="videoRef"
        class="video-js vjs-default-skin"
        controls
        preload="auto"
        width="640"
        height="360"
      ></video>
    </div>
  </template>
  
  <script setup>
  import { onMounted, onBeforeUnmount, watch, ref } from 'vue'
  import videojs from 'video.js'
  import 'video.js/dist/video-js.css'
  
  const props = defineProps({
    url: {
      type: String,
      required: true
    }
  })
  
  const player = ref(null)
  const videoRef = ref(null)
  
  watch(() => props.url, (newUrl) => {
    if (player.value) {
      player.value.src({ type: 'video/mp4', src: newUrl })
      player.value.load()
      player.value.play()
    }
  })
  
  onMounted(() => {
    player.value = videojs(videoRef.value, {
      sources: [{ src: props.url, type: 'video/mp4' }]
    })
  })
  
  onBeforeUnmount(() => {
    if (player.value) {
      player.value.dispose()
    }
  })
  </script>
  
  <style scoped>
  .video-js {
    max-width: 100%;
  }
  </style>
  