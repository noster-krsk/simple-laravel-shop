<template>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark" aria-label="Third navbar example">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">Система управления товарами и заказами</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample03">
        <ul class="navbar-nav me-auto mb-2 mb-sm-0">
          <li class="nav-item">
            <router-link to="/" class="nav-link" aria-current="page">Товары</router-link>
          </li>

    

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Управление товар</a>
            <ul class="dropdown-menu">
              <li><router-link to="/add" class="dropdown-item">Добавление товаров</router-link></li>
              <li><router-link to="/products" class="dropdown-item">Просмотр товаров</router-link></li>
            </ul>
          </li>
        </ul>

      
          <router-link to="/cart" class="btn btn-outline-light position-relative">
            <i class="bi bi-receipt"></i>
       
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              {{orderCountNew}}
              <span class="visually-hidden">Управление заказами</span>
            </span>
          </router-link>
    
      </div>
    </div>
  </nav>
</template>
<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const orderCountNew = ref(null)
async function fetchOrder() {
    try {
        
        const response = await axios.get('http://localhost/api/order')
        orderCountNew.value = response.data.count
       
        console.log(response)
    } catch (error) {
        console.error('Ошибка при получении категорий:', error)
    }
}
onMounted(() => {
      fetchOrder()
    })
</script>
