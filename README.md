<h1 align="center">🛒 Система управления заказами</h1>

<p align="center">
  <strong>Тестовое задание для программиста PHP</strong><br>
  Разработка веб-приложения для управления товарами и заказами на Laravel + Vue 3.
</p>

<hr>

<h2>📌 О задании</h2>

<ul>
  <li><strong>Цель:</strong> создать веб-приложение с backend на Laravel 9 и SPA-интерфейсом на Vue 3</li>
  <li><strong>Автор:</strong> Яковлев Александр Леонидович</li>
  <li><strong>Лицензия:</strong> MIT</li>
</ul>

<hr>

<h2>⚙️ Стек технологий</h2>

<h4>Backend:</h4>
<ul>
  <li>Laravel v9.52.20</li>
  <li>PHP 8.2.27</li>
  <li>RESTful API</li>
  <li>Eloquent ORM</li>
  <li>Repository + Service Layer Architecture</li>
</ul>

<h4>Frontend:</h4>
<ul>
  <li>Vue 3</li>
  <li>Vuetify 3</li>
  <li>Bootstrap 5</li>
  <li>Axios</li>
  <li>Vite</li>
  <li>Pinia</li>
</ul>

<hr>

<h2>🧩 Функциональность</h2>

<h3>📦 Управление товарами</h3>
<ul>
  <li>Добавление, редактирование, удаление</li>
  <li>Просмотр списка с сокращённой информацией (название, цена, категория)</li>
  <li>Просмотр полной карточки товара</li>
</ul>

<h3>📦 Категории товаров</h3>
<ul>
  <li>Миграция и сидирование таблицы <code>categories</code> с данными: <em>лёгкий, хрупкий, тяжёлый</em></li>
  <li>Привязка товара к одной категории (one-to-many)</li>
</ul>

<h3>🧾 Управление заказами</h3>
<ul>
  <li>Создание заказа с:
    <ul>
      <li>ФИО (обязательное)</li>
      <li>Дата создания (обязательная)</li>
      <li>Комментарий</li>
      <li>Статус: <code>новый</code> или <code>выполнен</code> (по умолчанию — <code>новый</code>)</li>
      <li>Один товар с количеством ≥ 1</li>
    </ul>
  </li>
  <li>Просмотр всех заказов:
    <ul>
      <li>ID, дата, покупатель, статус, итоговая цена</li>
    </ul>
  </li>
  <li>Изменение статуса на "выполнен"</li>
</ul>

<hr>

<h2>🧱 Архитектура backend</h2>

<p style="font-family: monospace; font-weight: bold;">Controller → Service → Repository → Model → DB</p>

<ul>
  <li>Контроллеры: принимают запросы и возвращают JSON</li>
  <li>Бизнес-логика: полностью в сервисах</li>
  <li>Работа с базой данных: строго через репозитории</li>
</ul>

<hr>

<h2>🖥 Интерфейс</h2>

<ul>
  <li>Адаптивный интерфейс на Vuetify 3 + Bootstrap 5</li>
  <li>Используются компоненты: <code>v-data-table</code>, <code>v-alert</code>, <code>v-dialog</code>, <code>v-select</code>, <code>v-form</code></li>
  <li>Автоматическая валидация, всплывающие уведомления, подтверждения удаления</li>
</ul>

<hr>

<h2>🚀 Установка</h2>

<h4>Backend (Laravel)</h4>
<ol>
  <li>git clone https://github.com/yourname/order-system.git</li>
  <li>cd order-system/backend</li>
  <li>composer install</li>
  <li>cp .env.example .env</li>
  <li>php artisan key:generate</li>
  <li>php artisan migrate --seed</li>
  <li>php artisan serve</li>
</ol>

<h4>Frontend (Vue)</h4>
<ol>
  <li>cd order-system/frontend</li>
  <li>npm install</li>
  <li>npm run dev</li>
</ol>

<hr>

<h2>🔗 Демо</h2>
<p>
  Готовый результат размещён на сервере по адресу:<br>
  <a href="https://test1.webastera.com" target="_blank">https://test1.webastera.com</a>
</p>
<hr>

<h2>📄 Лицензия</h2>

Проект распространяется под лицензией <strong>MIT</strong>.
