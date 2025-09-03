<template>
  <q-item clickable :tag="linkTag" :to="to" @click="$emit('click', $event)">
    <q-item-section v-if="icon" avatar>
      <q-icon :name="icon" />
    </q-item-section>

    <q-item-section>
      <q-item-label>{{ title }}</q-item-label>
    </q-item-section>
  </q-item>
</template>

<script>
import { defineComponent, computed } from "vue";

export default defineComponent({
  name: "EssentialLink",
  props: {
    title: {
      type: String,
      required: true,
    },
    caption: {
      type: String,
      default: "",
    },
    link: {
      type: String,
      default: "",
    },
    to: {
      type: [String, Object],
      default: null,
    },
    icon: {
      type: String,
      default: "",
    },
  },
  setup(props) {
    const linkTag = computed(() => (props.to ? "router-link" : "a"));
    return {
      linkTag,
    };
  },
});
</script>
