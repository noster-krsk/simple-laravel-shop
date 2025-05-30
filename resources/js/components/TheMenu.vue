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
          <li class="nav-item">
            <router-link to="/add" class="nav-link">Добавление товаров</router-link>
          </li>
          <li class="nav-item">
             <router-link to="/" class="nav-link">Просмотр заказа</router-link>
          </li>
          <!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Добавление товаров</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Действие</a></li>
              <li><a class="dropdown-item" href="#">Еще одно действие</a></li>
              <li><a class="dropdown-item" href="#">Здесь кое-что еще</a></li>
            </ul>
          </li> -->
        </ul>
        <!-- <form role="search">
          <input class="form-control" type="search" placeholder="Поиск" aria-label="Поиск">
        </form> -->
      </div>
    </div>
  </nav>
</template>