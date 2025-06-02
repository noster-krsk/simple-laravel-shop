import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useOrderStore = defineStore('order', () => {
  const orderCountNew = ref(0)

  function setOrderCount(count) {
    orderCountNew.value = count
  }

  return {
    orderCountNew,
    setOrderCount
  }
})
