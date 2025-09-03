<template>
  <div class="q-pa-md">
    <q-stepper v-model="step" ref="stepper" color="primary" animated>
      <q-step :name="1" title="Product Info" icon="settings" :done="step > 1">
        <q-form @submit.prevent="goToNext">
          <div class="q-pa-md">
            <q-input
              v-model="name"
              label="Product Name"
              filled
              :rules="[(val) => !!val || 'Product name is required']"
              required
              dense
            />

            <q-select
              v-model="category"
              label="Category"
              :options="categoryOptions"
              filled
              dense
              :rules="[(val) => !!val || 'Category is required']"
              required
            />

            <q-editor
              v-model="description"
              label="Description"
              filled
              :rules="[(val) => !!val || 'Description is required']"
              required
            />
          </div>
        </q-form>
      </q-step>

      <q-step :name="2" title="Upload Images" icon="image" :done="step > 2">
        <q-form @submit.prevent="goToNext">
          <div class="q-pa-md">
            <p class="font-xl">Select Image</p>

            <q-file
              ref="fileInputRef"
              v-model="selectedImage"
              accept="image/*"
              style="display: none"
              @update:model-value="previewImage"
            />

            <div @click="openFilePicker" class="q-mb-md">
              <q-img
                :src="imageUrl || image"
                spinner-color="primary"
                style="
                  width: 300px;
                  height: 300px;
                  object-fit: contain;
                  border: 1px solid #e0e0e0;
                  border-radius: 5px;
                  cursor: pointer;
                "
              />
            </div>
          </div>
        </q-form>
      </q-step>

      <q-step
        :name="3"
        title="Date and Time"
        icon="calendar_today"
        :done="step > 3"
      >
        <q-form @submit.prevent="goToNext">
          <div class="flex justify-between">
            <q-date
              v-model="date"
              label="Select Date"
              mask="YYYY-MM-DD"
              filled
              :rules="[(val) => !!val || 'Date is required']"
              required
            />

            <q-time
              v-model="time"
              label="Select Time"
              format24h
              filled
              :rules="[(val) => !!val || 'Time is required']"
              required
            />
          </div>
        </q-form>
      </q-step>

      <q-step :name="4" title="Submit" icon="check" :done="step > 4">
        <div class="q-pa-md">
          <div>
            <p><strong>Product Name:</strong> {{ name }}</p>
            <p><strong>Category:</strong> {{ category }}</p>
            <p><strong>Description:</strong> {{ description }}</p>
            <p><strong>Date and Time:</strong> {{ dateTime }}</p>

            <div v-if="imageUrl">
              <p><strong>Image:</strong></p>
              <q-img
                :src="imageUrl"
                style="
                  height: 300px;
                  width: 300px;
                  object-fit: contain;
                  border: 1px solid #e0e0e0;
                "
              />
            </div>
          </div>

          <div class="q-mt-md">
            <p>Please review your data before submitting.</p>
          </div>
        </div>
      </q-step>

      <template v-slot:navigation>
        <q-stepper-navigation>
          <q-btn
            @click="goToNext"
            color="primary"
            :label="step === 4 ? 'Submit' : 'Next'"
          />
          <q-btn
            v-if="step > 1"
            flat
            color="primary"
            @click="goToPrevious"
            label="Back"
            class="q-ml-sm"
          />
        </q-stepper-navigation>
      </template>
    </q-stepper>

    <InnerLoading :loading="loading" />
  </div>
</template>

<script setup>
import { InnerLoading } from "components/index.js";
import { ref, computed, watch } from "vue";
import { $notify } from "src/boot/app";
import image from "src/assets/image.png";
import { useRoute, useRouter } from "vue-router";
import { axios } from "src/boot/axios";

const step = ref(1);
const fileInputRef = ref(null);

const name = ref("");
const category = ref("");
const description = ref("");
const selectedImage = ref(null);
const imageUrl = ref(null);
const date = ref(null);
const time = ref(null);
const formError = ref({});

const loading = ref(false);

const route = useRoute();
const router = useRouter();
const ProductID = route.params.id;

const categoryOptions = ["Electronics", "Furniture", "Clothing", "Books"];

const dateTime = computed(() => {
  if (date.value && time.value) return `${date.value} ${time.value}`;
  return null;
});

const isValidStep1 = computed(
  () => name.value && category.value && description.value
);
const isValidStep2 = computed(
  () => imageUrl.value && imageUrl.value.length > 0
);
const isValidStep3 = computed(() => date.value && time.value);

const goToNext = () => {
  if (step.value === 1 && !isValidStep1.value) {
    $notify("negative", "error", "Please fill up the blanks for Step 1.");
    return;
  }

  if (!ProductID && step.value === 2 && !isValidStep2.value) {
    $notify("negative", "error", "Please select an image for Step 2.");
    return;
  }

  if (step.value === 3 && !isValidStep3.value) {
    $notify("negative", "error", "Please select a date and time for Step 3.");
    return;
  }

  if (step.value < 4) {
    if (isValidStep1) {
      step.value++;
    }
  } else {
    submitForm();
  }
};

const goToPrevious = () => {
  if (step.value > 1) {
    step.value--;
  }
};

const previewImage = (file) => {
  if (file) {
    const reader = new FileReader();
    reader.onload = (e) => {
      imageUrl.value = e.target.result;
    };
    reader.readAsDataURL(file);
  } else {
    imageUrl.value = null;
  }
};

const openFilePicker = () => {
  const fileInput = fileInputRef.value.$el.querySelector('input[type="file"]');
  if (fileInput) {
    fileInput.click();
  }
};

const submitForm = async () => {
  try {
    loading.value = true;
    const formData = new FormData();
    formData.append("name", name.value);
    formData.append("category", category.value);
    formData.append("description", description.value);
    formData.append("date_time", dateTime.value);

    if (selectedImage.value) {
      formData.append("image", selectedImage.value);
    }

    let response;

    if (ProductID) {
      response = await axios.post(`/products/update/${ProductID}`, formData, {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      });
    } else {
      response = await axios.post("/products/create", formData, {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      });
    }

    if (response.data.message) {
      router.push("/admin/product");
    }
  } catch (error) {
    if (error.response && error.response.status === 422) {
      formError.value = error.response.data.errors;

      Object.values(formError.value).forEach((messages) => {
        messages.forEach((message) => {
          $notify("negative", "error", message);
        });
      });
    }
  } finally {
    loading.value = false;
  }
};

const fetchData = async () => {
  try {
    const response = await axios.get(`/products/findData/${ProductID}`);

    const data = response.data.data;

    name.value = data.name;
    category.value = data.category;
    description.value = data.description;

    if (data.date_time) {
      const [d, t] = data.date_time.split(" ");
      date.value = d;
      time.value = t;
    }

    imageUrl.value = data.image;
  } catch (Error) {
    console.log(Error);
  }
};

watch((ProductID) => {
  fetchData();
});
</script>

<style scoped>
.q-page {
  max-width: 800px;
  margin: auto;
}
</style>
