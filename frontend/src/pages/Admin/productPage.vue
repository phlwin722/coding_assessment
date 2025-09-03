<template>
  <div class="q-pa-md">
    <!-- Filters Row -->
    <div class="q-gutter-md row">
      <q-select
        filled
        v-model="filteredProduct"
        label="Filter by Category"
        :options="categoryOptions"
        style="width: 250px"
        behavior="menu"
      />

      <q-input
        v-model="search"
        debounce="500"
        filled
        placeholder="Search by Name or Description"
        style="width: 250px"
      >
        <template v-slot:append>
          <q-icon name="search" />
        </template>
      </q-input>
    </div>

    <!-- Product Table -->
    <q-table
      title="Treats"
      :rows="filteredRows"
      :columns="columns"
      row-key="name"
      class="q-mt-md"
    >
      <template v-slot:top>
        <div class="flex justify-end full-width q-gutter-sm">
          <q-btn
            color="primary"
            icon="add"
            to="/admin/product/form"
            class="custom-btn"
            glossy
            size="sm"
            label="Create"
          >
            <q-tooltip
              anchor="center left"
              self="center right"
              :offset="[10, 10]"
            >
              <strong>Add </strong> Product
            </q-tooltip>
          </q-btn>
        </div>
      </template>

      <template v-slot:body-cell-description="props">
        <q-td :props="props" style="max-width: 200px; overflow: hidden">
          <div class="ellipsis">
            {{ props.row.description }}
          </div>
        </q-td>
      </template>

      <template v-slot:body-cell-actions="props">
        <q-td :props="props">
          <div class="q-gutter-x-sm">
            <q-btn
              square
              color="positive"
              icon="edit"
              dense
              size="sm"
              :to="`/admin/product/form/${props.row.id}`"
              class="custom-btn2"
            >
              <q-tooltip
                anchor="center left"
                self="center right"
                :offset="[10, 10]"
                class="bg-secondary"
              >
                Edit Products
              </q-tooltip>
            </q-btn>
            <q-btn
              square
              color="negative "
              icon="delete"
              dense
              size="sm"
              class="custom-btn2"
              @click="beforeDelete(props.row.id)"
            >
              <q-tooltip
                anchor="center right"
                self="center left"
                :offset="[10, 10]"
                class="bg-secondary"
              >
                Delete Products
              </q-tooltip>
            </q-btn>
          </div>
        </q-td>
      </template>
    </q-table>
  </div>

  <q-dialog v-model="confirm" persistent>
    <q-card style="min-width: 400px">
      <q-card-section class="row items-center q-gutter-sm">
        <q-avatar icon="warning" color="negative" text-color="white" />
        <div class="text-h6 text-negative">Confirm Deletion</div>
      </q-card-section>

      <q-card-section class="q-pt-none">
        <div class="text-body1">
          Are you sure you want to
          <strong class="text-negative">delete</strong> this product? <br />This
          action cannot be undone.
        </div>
      </q-card-section>

      <q-card-actions align="right">
        <q-btn flat label="Cancel" icon="close" color="primary" v-close-popup />
        <q-btn
          unelevated
          label="Yes, Delete it"
          icon="delete"
          color="negative"
          @click="deleteProduct"
          v-close-popup
        />
      </q-card-actions>
    </q-card>
  </q-dialog>
</template>

<script setup>
import { ref, computed } from "vue";
import { axios } from "src/boot/axios";

const categoryOptions = ref([
  "All",
  "Electronics",
  "Furniture",
  "Clothing",
  "Books",
]);

const filteredProduct = ref("All");
const search = ref("");
const confirm = ref(false);
const productToDelete = ref(null);

const rows = ref([]);

const columns = [
  {
    name: "name",
    required: true,
    label: "Name",
    align: "left",
    field: (row) => row.name,
    format: (val) => `${val}`,
    sortable: true,
  },
  {
    name: "description",
    align: "left",
    label: "Description",
    field: "description",
  },
  {
    name: "category",
    align: "left",
    label: "Category",
    field: "category",
  },
  {
    name: "data_time",
    align: "left",
    label: "Data & Time",
    field: "date_time"
  },
  {
    name: "actions",
    label: "Actions",
    field: "actions",
  },
];

const beforeDelete = (id) => {
  productToDelete.value = id;
  confirm.value = true;
};

const deleteProduct = async () => {
  try {
    await axios.delete(`/products/delete/${productToDelete.value}`);
    confirm.value = false;
    fetchData();
  } catch (err) {
    console.error(err);
  }
};

const fetchData = async () => {
  try {
    const response = await axios.get("/products/index");
    rows.value = response.data.product;
  } catch (err) {
    console.log(err);
  }
};

fetchData();

const filteredRows = computed(() => {
  return rows.value.filter((row) => {
    const matchesSearch =
      row.name.toLowerCase().includes(search.value.toLowerCase()) ||
      row.description?.toLowerCase().includes(search.value.toLowerCase());
    const matchesCategory =
      filteredProduct.value === "All" || row.category === filteredProduct.value;
    return matchesSearch && matchesCategory;
  });
});
</script>
