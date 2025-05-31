<template>
  <div>
    <v-row class="w-50 mx-auto">
      <v-col>
        <h2>Добавление новых товаров</h2>

        <!-- Поле Название -->
        <v-text-field
          v-model="name"
          label="Название"
          variant="underlined"
          class="form-control"
        />

        <!-- Выпадающий список Категория -->
        <v-select
          v-model="category"
          label="Категория"
          :items="categories"
        />

        <!-- Поле Описание -->
        <v-text-field
          v-model="description"
          label="Описание"
          variant="underlined"
          class="form-control"
        />

        <!-- Поле Цена -->
        <v-text-field
          v-model="price"
          label="Цена"
          variant="underlined"
          class="form-control"
          type="number"
        />

        <!-- Кнопка Добавить -->
        <v-btn @click="addNewProduct" class="mt-3" color="primary">Добавить</v-btn>

        <!-- Уведомление об успехе -->
        <v-alert
          type="success"
          v-if="succed"
          class="mt-4"
        >
          Товар успешно добавлен!
        </v-alert>
      </v-col>
    </v-row>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

// Включаем поддержку cookie
axios.defaults.withCredentials = true

// Состояния
const categories = ref([])

const name = ref('')
const category = ref('')
const description = ref('')
const price = ref('')
const succed = ref(false)

// Получение категорий
async function fetchCategories() {
  try {
    await axios.get('http://localhost/sanctum/csrf-cookie')
    const response = await axios.get('http://localhost/api/getcategory')

    // Ожидается, что Laravel вернет массив строк
    categories.value = response.data
    console.log('Категории:', categories.value)
  } catch (error) {
    console.error('Ошибка при получении категорий:', error)
  }
}

// Добавление нового товара
async function addNewProduct() {
  try {
    await axios.get('http://localhost/sanctum/csrf-cookie')

    const response = await axios.post('http://localhost/api/product', {
      name: name.value,
      category: category.value,
      description: description.value,
      price: price.value
    })

    // Успешно — сбрасываем поля и показываем сообщение
    name.value = ''
    category.value = ''
    description.value = ''
    price.value = ''
    succed.value = true
  } catch (error) {
    console.error('Ошибка при добавлении товара:', error)
  }
}

// Загружаем категории при монтировании
fetchCategories()
</script>

<style scoped>
/* По желанию можно добавить стили */
</style>
