<template>
  <v-container>
    <h2 class="mb-4 text-center">Список товаров</h2>

    <v-alert type="success" v-if="success" class="mt-4">
      {{ message }}
    </v-alert>
    <v-alert type="error" v-if="error" class="mt-4">
      {{ message }}
    </v-alert>

    <v-row>
      <v-col v-for="product in products" :key="product.id" cols="12" sm="6" md="4" lg="3">
        <v-card class="mx-auto" elevation="2">
          <v-card-title>{{ product.name }}</v-card-title>
          <v-card-text>
            <div><strong>Цена:</strong> {{ product.price }} ₽</div>
            <div><strong>Категория:</strong> {{ product.category?.name || '—' }}</div>
          </v-card-text>

          <div class="text-start">
            <v-btn size="x-small" color="success" @click="openOrder(product)">Приобрести</v-btn> 
            <v-btn size="x-small" color="primary" @click="openDialog(product)">Подробнее</v-btn>
          </div>
          <br />
          <!-- Диалог "Подробнее" -->
          <v-dialog v-model="dialog" width="500">
            <v-card v-if="selectedProduct">
              <v-card-title class="text-h6">{{ selectedProduct.name }}</v-card-title>
              <v-card-text>
                <div><strong>Цена:</strong> {{ selectedProduct.price }} ₽</div>
                <div><strong>Категория:</strong> {{ selectedProduct.category?.name || '—' }}</div>
                <div><strong>Описание:</strong> {{ selectedProduct.description || 'Описание отсутствует' }}</div>
              </v-card-text>
              <v-card-actions>
                <v-spacer />
                <v-btn size="x-small" color="success" @click="openOrder(selectedProduct)">Приобрести</v-btn>
                <v-btn color="primary" @click="dialog = false">Закрыть</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>

          <!-- Диалог "Оформление заказа" -->
          <v-dialog v-model="openOrderDialog" width="500">
            <v-card v-if="selectedProduct">
              <v-card-title class="text-h6">Оформление заказа</v-card-title>
              <v-card-text>
                <div><strong>Название товара:</strong> {{ selectedProduct.name }}</div>
                <div><strong>Цена за штуку:</strong> {{ selectedProduct.price }} ₽</div>
                <div><strong>Категория:</strong> {{ selectedProduct.category?.name || '—' }}</div>
                <div><strong>Описание:</strong> {{ selectedProduct.description || 'Описание отсутствует' }}</div>

                <v-text-field
                  v-model="fio"
                  hide-details
                  density="compact"
                  variant="outlined"
                  class="ma-2"
                  label="Введите ФИО (при наличии)"
                />
                <v-text-field
                  v-model="comment"
                  hide-details
                  density="compact"
                  variant="outlined"
                  class="ma-2"
                  label="Введите комментарий к заказу"
                />

                <div class="d-flex flex-wrap" style="gap: 8px;">
                  <v-btn icon size="x-small" @click="decrease(selectedProduct)">
                    <v-icon>mdi-minus</v-icon>
                  </v-btn>

                  <v-text-field
                    v-model="selectedProduct.quantity"
                    type="number"
                    min="1"
                    hide-details
                    style="max-width: 90px;"
                    density="compact"
                    variant="outlined"
                  />

                  <v-btn icon size="x-small" @click="increase(selectedProduct)">
                    <v-icon>mdi-plus</v-icon>
                  </v-btn>
                </div>

                <hr />

                <div>
                  <strong>Общая сумма в заказе:</strong>
                  {{ selectedProduct.price * selectedProduct.quantity || 0 }} ₽
                </div>
              </v-card-text>

              <v-card-actions>
                <v-spacer />
                <v-btn size="x-small" color="success" @click="addToCart(selectedProduct)">Оформить</v-btn>
                <v-btn color="primary" @click="openOrderDialog = false">Закрыть</v-btn>
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

import { computed } from 'vue'
import { useOrderStore } from '@/stores/orderStore'
const store = useOrderStore()
const orderCount = computed(() => store.orderCountNew)

const products = ref([])
const selectedProduct = ref(null)
const dialog = ref(false)
const success = ref(false)
const message = ref('')
const error = ref(false)
const openOrderDialog = ref(false)
const fio = ref('')
const comment = ref(null)

// Загрузка товаров
async function fetchProducts() {
  try {
    const response = await axios.get('http://localhost/api/product')
    products.value = response.data.data.map(p => ({ ...p, quantity: 1 }))
  } catch (error) {
    console.error('Ошибка при получении товаров:', error)
  }
}

function increase(p) {
  p.quantity = (p.quantity || 1) + 1
}

function decrease(p) {
  if (p.quantity > 1) {
    p.quantity--
  }
}

async function addToCart(p) {
  const qty = parseInt(p.quantity)
  if (!qty || qty < 1) {
    alert('Укажите количество')
    return
  }
  console.log('Запрос:', {
  clients: fio.value,
  comment: comment.value,
  product_id: p.id,
  quantity: qty,
  total_cost: p.price * qty
})
  try {
    await axios.post('http://localhost/api/order', {
      clients: fio.value,
      comment: comment.value || '',
      product_id: p.id,
      quantity: qty,
      total_cost: p.price * qty
    })

    p.quantity = 1
    openOrderDialog.value = false
    showSuccess('Товар успешно добавлен!')
    store.setOrderCount(store.orderCountNew + 1)
  } catch (err) {
    if (err.response?.status === 422) {
      const firstMessage = Object.values(err.response.data.errors)[0][0]
      showError(firstMessage)
    } else {
      showError('Неизвестная ошибка')
      console.error(err)
    }
  }
}

function openDialog(product) {
  selectedProduct.value = product
  dialog.value = true
}

function openOrder(product) {
  selectedProduct.value = product
  dialog.value = false
  openOrderDialog.value = true
}

function showSuccess(msg) {
  message.value = msg
  success.value = true
  setTimeout(() => (success.value = false), 3000)
}

function showError(msg) {
  message.value = msg
  error.value = true
  setTimeout(() => (error.value = false), 3000)
}

onMounted(fetchProducts)
</script>
