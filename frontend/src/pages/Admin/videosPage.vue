<template>
  <q-page class="flex flex-center">
    <q-card class="my-card q-pa-lg">
      <div class="text-h5 q-mb-md text-center text-primary">
        Video Player Demo
      </div>

      <q-btn-group spread class="q-mb-lg">
        <q-btn
          label="Play Sample Video 1"
          color="primary"
          outline
          unelevated
          @click="setVideo('http://localhost:8002/videos/react.mp4')"
          class="btn-hover"
        />
        <q-btn
          label="Play Sample Video 2"
          color="secondary"
          outline
          unelevated
          @click="setVideo('http://localhost:8002/videos/laravel.mp4')"
          class="btn-hover"
        />
      </q-btn-group>

      <div class="video-wrapper">
        <VideoPlayer :url="videoUrl" />
      </div>
    </q-card>
  </q-page>
</template>

<script setup>
import { ref } from 'vue'
import VideoPlayer from 'components/VideoPlayer.vue'

const videoUrl = ref('http://localhost:8002/videos/react.mp4')

function setVideo(url) {
  videoUrl.value = url
}
</script>

<style scoped>
.my-card {
  max-width: 720px;
  width: 90vw;
  border-radius: 16px;
  box-shadow:
    0 8px 20px rgba(0, 0, 0, 0.12),
    0 4px 10px rgba(0, 0, 0, 0.08);
  background: white;
}

.video-wrapper {
  position: relative;
  padding-top: 56.25%; /* 16:9 Aspect Ratio */
  border-radius: 12px;
  overflow: hidden;
  box-shadow:
    0 6px 18px rgba(0, 0, 0, 0.15);
}

.video-wrapper > * {
  position: absolute !important;
  top: 0;
  left: 0;
  width: 100% !important;
  height: 100% !important;
  border-radius: 12px;
}

.btn-hover:hover {
  box-shadow: 0 4px 12px rgba(0, 123, 255, 0.4);
  transition: box-shadow 0.3s ease;
}
</style>
