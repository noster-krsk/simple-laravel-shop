<template>
  <div>
    <v-row class="w-50 mx-auto">
      <v-col>
        <h2>Добавление новых товаров</h2>

        
        <v-text-field v-model="name" label="Название" variant="underlined" class="form-control" />

        
        <v-select v-model="category" :items="categories" item-title="text" item-value="value" label="Категория" />

         
        <v-text-field v-model="description" label="Описание" variant="underlined" class="form-control" />

        
        <v-text-field v-model="price" label="Цена" variant="underlined" class="form-control" type="number" />

         
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
     
    const response = await axios.get('http://localhost/api/getcategory')

     
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
     

    const response = await axios.post('http://localhost/api/product', {
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
  succed.value = false
   setTimeout(() => {
    error.value = false
  }, 3000)
}

function showSuccess(msg) {
  message.value = msg
  succed.value = true

  setTimeout(() => {
    succed.value = false
  }, 3000)
}
 
fetchCategories()
</script>

<style scoped>
 
</style>
