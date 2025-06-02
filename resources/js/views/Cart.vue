<template>

    <v-alert type="success" v-if="success" class="mt-4">
        {{ message }}
    </v-alert>
    <v-alert type="error" v-if="error" class="mt-4">
        {{ message }}
    </v-alert>
    <v-data-table :items="products" :headers="headers" item-value="id" class="elevation-1">

        <template #item.total_cost="{ item }">
            {{ item.columns.total_cost }} ₽
        </template>
        <template #item.created_at="{ item }">
            {{ formatDate(item.columns.created_at) }}
        </template>
        <template #item.status="{ item }">
            <v-select :items="statusOptions" v-model="item.columns.status" density="compact" variant="underlined"
                hide-details @update:modelValue="updateStatus(item.columns)" />
        </template>
    </v-data-table>
</template>
<script setup>

import { ref, onMounted } from 'vue'
import axios from 'axios'

import { computed } from 'vue'
import { useOrderStore } from '@/stores/orderStore'

const statusOptions = ['новый', 'выполнен']

const success = ref(false)
const message = ref('')
const error = ref(false)

const store = useOrderStore()
const orderCount = computed(() => store.orderCountNew)

async function updateStatus(order) {
    try {
        await axios.put(`https://test1.webastera.com/api/order/${order.id}`, {
            status: order.status,
        })
        showSuccess('Статус заказа обновлен!')
        store.setOrderCount(store.orderCountNew - 1)

        fetchProducts()
    } catch (e) {
        console.error(`Ошибка при обновлении статуса заказа ${order.id}:`, e)
    }
}

const products = ref([])
const headers = [
    { title: 'Номер заказа', key: 'id' },
    { title: 'Создан', key: 'created_at' },
    { title: 'ФИО покупателя', key: 'clients' },
    { title: 'Статус заказа', key: 'status' },
    { title: 'Итоговая сумма', key: 'total_cost' },
]
async function fetchProducts() {
    try {
        const response = await axios.get('https://test1.webastera.com/api/order')
        products.value = response.data.data

    } catch (error) {
        console.error('Ошибка при получении товаров:', error)
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
onMounted(() => {
    fetchProducts()
})
</script>