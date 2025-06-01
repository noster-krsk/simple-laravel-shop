<template>
    <v-container>
        <h2 class="mb-4 text-center">Список товаров</h2>
        
        <v-alert type="success" v-if="success" class="mt-4">
            {{ message }}
        </v-alert>
        <v-data-table :items="products" :headers="headers" item-value="id" class="elevation-1">
    <template #item.id="{ item }">
  <span class="d-none">{{ item.columns.id }}</span>
</template>
            <template #item.price="{ item }">
                {{ item.columns.price }} ₽
            </template>
            <template #item.created_at="{ item }">
                {{ formatDate(item.columns.created_at) }}
            </template>
            <template #item.updated_at="{ item }">
                {{ formatDate(item.columns.updated_at) }}
            </template>
      
            <template #item.actions="{ item }">
                <v-icon icon="mdi-pencil" class="me-2" color="primary" @click="openDialog(item.columns)" /> 
                <v-icon icon="mdi-delete" color="red" @click="deleteProduct(item.columns)" />
            </template>
        </v-data-table>
        <v-dialog v-model="dialog" width="500">
            <v-card v-if="selectedProduct">
                <v-card-title class="text-h6">
                    Редактирование {{ selectedProduct.name }}
                </v-card-title>
                <v-card-text>
                    <v-text-field v-model="selectedProduct.name" label="Название" variant="underlined"
                        class="form-control" />

                    
                    <v-select v-model="selectedProduct['category.name']" :items="categories" item-title="text"
                        item-value="value" label="Категория" />

                   
                    <v-text-field v-model="selectedProduct.description" label="Описание" variant="underlined"
                        class="form-control" />

                    
                    <v-text-field v-model="selectedProduct.price" label="Цена" variant="underlined" class="form-control"
                        type="number" />
              
                </v-card-text>
                <v-card-actions>
                    <v-spacer />
                    <v-btn @click="editProduct(selectedProduct.id)" color="primary">Сохранить</v-btn>
                    <v-btn color="primary" @click="dialog = false">Закрыть</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-container>
</template>


<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const products = ref([])
const success = ref(false)
const selectedProduct = ref([])
const message = ref()
const dialog = ref(false)
const categories = ref([])

const headers = [
  { title: '', key: 'id', sortable: false  }, 
  { title: 'Название', key: 'name' },
  { title: 'Описание', key: 'description' },
  { title: 'Цена', key: 'price' },
  { title: 'Категория', key: 'category.name' },
  { title: 'Создан', key: 'created_at' },
  { title: 'Изменения', key: 'updated_at' },
  { title: 'Действия', key: 'actions', sortable: false }
]

async function fetchProducts() {
    try {
        const response = await axios.get('http://localhost/api/product')
        products.value = response.data.data
        console.log(response)
    } catch (error) {
        console.error('Ошибка при получении товаров:', error)
    }
}
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
async function editProduct(item) {
    try {
        const response = await axios.put(`http://localhost/api/product/${item}`, {
            name: selectedProduct.value.name,
            category: selectedProduct.value.category_id,
            description: selectedProduct.value.description,
            price: selectedProduct.value.price
        })
        await fetchProducts()
        console.log(response)
        success.value = true
        dialog.value = false
        showSuccess(response.data.message)
    } catch (error) {
        console.error('Ошибка при обновлении данных:', error)
    }

  
}

async function deleteProduct(item) {
    if (confirm(`Удалить товар "${item.name}"?`)) {
        try {
            const response = await axios.delete(`http://localhost/api/product/${item.id}`)
            products.value = products.value.filter(p => p.id !== item.id)
            console.log(response)
            success.value = true
            showSuccess(response.data.message)
        } catch (error) {
            console.error('Ошибка при удалении:', error)
        }
    }
}
function formatDate(dateString) {

    const timestamp = Date.parse(dateString)
    if (isNaN(timestamp)) return '—'

    const date = new Date(timestamp)

    return date.toLocaleString('ru-RU', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
    })
}

function openDialog(product) {
    console.log(product)
    const categoryName = product['category.name'] || product.category?.name

    
    const matched = categories.value.find(c => c.text === categoryName)

    selectedProduct.value = {
        ...product,
        category_id: matched ? matched.value : null
    }

    dialog.value = true
}
function showSuccess(msg) {
    message.value = msg
    success.value = true

    setTimeout(() => {
        success.value = false
    }, 3000)
}

    onMounted(() => {
      fetchProducts()
      fetchCategories()
    })

</script>
<style scoped>
th[data-column-key="id"] {
  display: none !important;
}
</style>