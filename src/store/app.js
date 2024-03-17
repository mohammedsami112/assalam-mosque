// Utilities
import { defineStore } from 'pinia'

export const useAppStore = defineStore('app', {
  state: () => ({
    homeLoading: true,
    home: [],
  }),

  actions: {
    setHomeData(data) {
      this.home = data
    }
  }
})
