<template>
  <v-container>
    <h2 class="mb-4 text-center">Список товаров</h2>

    <v-row>
      <v-col v-for="product in products" :key="product.id" cols="12" sm="6" md="4" lg="3">
        <v-card class="mx-auto" elevation="2">
          <v-card-title>{{ product.name }}</v-card-title>
          <v-card-text>
            <div><strong>Цена:</strong> {{ product.price }} ₽</div>
            <div><strong>Категория:</strong> {{ product.category?.name || '—' }}</div>
          </v-card-text>
          <div class=" text-center">
            <v-btn size="x-small" color="primary" @click="openDialog(product)">Подробнее</v-btn>
            <br />
            <br />
          </div>
          <v-dialog v-model="dialog" width="500">
            <v-card v-if="selectedProduct">
              <v-card-title class="text-h6">
                 {{ selectedProduct.name }}
              </v-card-title>
              <v-card-text>
  


                <div><strong>Цена:</strong> {{ selectedProduct.price }} ₽</div>
                <div><strong>Категория:</strong> {{ selectedProduct.category?.name || '—' }}</div>
                <div><strong>Описание:</strong> {{ selectedProduct.description || 'Описание отсутствует' }}</div>
              </v-card-text>
              <v-card-actions>
                <v-spacer />
                <v-btn color="primary" @click="dialog = false">Закрыть</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>

        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const products = ref([])
const selectedProduct = ref(null)
const dialog = ref(false)

async function fetchProducts() {
  try {
    const response = await axios.get('http://localhost/api/product')
    products.value = response.data.data
  } catch (error) {
    console.error('Ошибка при получении товаров:', error)
  }
}
function openDialog(product) {
  selectedProduct.value = product
  dialog.value = true
}

onMounted(fetchProducts)
</script>
