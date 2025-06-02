<template>
  <div>
    <v-row class="w-50 mx-auto">
      <v-col>
        <h2>Добавление новых товаров</h2>


        <v-text-field v-model="name" label="Название" variant="underlined" class="form-control" />


        <v-select v-model="category" :items="categories" item-title="text" item-value="value" label="Категория" />


        <v-text-field v-model="description" label="Описание" variant="underlined" class="form-control" />

<v-text-field
  v-model="price"
  label="Цена"
  variant="underlined"
  class="form-control"
  type="text"
  @keydown="onPriceKeydown"
  @input="onPriceInput"
/>


        <v-btn @click="addNewProduct" class="mt-3" color="primary">Добавить</v-btn>


        <v-alert type="success" v-if="success" class="mt-4">
          Товар успешно Обновлев!
        </v-alert>
        <v-alert type="error" v-if="error" class="mt-4">
          {{ message }}
        </v-alert>
      </v-col>
    </v-row>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'





const categories = ref([])

const name = ref('')
const category = ref('')
const description = ref('')
const price = ref('')
const success = ref(false)
const error = ref(false)
const message = ref(null)


async function fetchCategories() {
  try {

    const response = await axios.get('https://test1.webastera.com/api/getcategory')


    categories.value = Object.entries(response.data).map(([name, id]) => ({
      text: name,
      value: id
    }))
  } catch (error) {
    console.error('Ошибка при получении категорий:', error)
  }
}


async function addNewProduct() {
  try {


    const response = await axios.post('https://test1.webastera.com/api/product', {
      name: name.value,
      category: category.value,
      description: description.value,
      price: price.value
    })
    console.log(response)

    name.value = ''
    category.value = ''
    description.value = ''
    price.value = ''

    showSuccess('Товар успешно добавлен!')
  } catch (error) {
    if (error.response?.status === 422) {
      const errors = error.response.data.errors
      const firstMessage = Object.values(errors)[0][0]
      showError(firstMessage)
    } else {
      showError('Неизвестная ошибка')
      console.error(error)
    }
  }
}
function showError(msg) {
  message.value = msg
  error.value = true
  success.value = false
  setTimeout(() => {
    error.value = false
  }, 3000)
}

function showSuccess(msg) {
  message.value = msg
  success.value = true

  setTimeout(() => {
    success.value = false
  }, 3000)
}

function onPriceInput(e) {
  
  e.target.value = e.target.value.replace(',', '.')
  price.value = e.target.value
}

function onPriceKeydown(e) {
  const key = e.key
  const value = e.target.value
  const cursorPos = e.target.selectionStart
  const dotIndex = value.indexOf('.')

  const allowedControlKeys = ['Backspace', 'Delete', 'Tab', 'ArrowLeft', 'ArrowRight']
 
  if (allowedControlKeys.includes(key)) return

  
  if ((key === '.' || key === ',') && cursorPos === 0) {
    e.preventDefault()
    return
  }

  
  if ((key === '.' || key === ',') && !value.includes('.')) return
 
  if (/^[0-9]$/.test(key)) { 
    if (dotIndex !== -1 && cursorPos > dotIndex) {
      const decimalPart = value.split('.')[1] || ''
      if (decimalPart.length >= 2) {
        e.preventDefault()
        return
      }
    }
    return
  }
 
  e.preventDefault()
}

fetchCategories()
</script>

<style scoped></style>
