// Utilities
import { defineStore } from 'pinia'

export const useDonationStore = defineStore('donation-store', {
  state: () => ({
    donations: [],
    types: [],
  }),

  actions: {
    setDonations(data) {
      this.donations = data
    },
    setDonationTypes(data) {
      this.types = data
    }
  }
})
