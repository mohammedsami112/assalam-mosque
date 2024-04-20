// Utilities
import { defineStore } from 'pinia'

export const useAppStore = defineStore('app', {
  state: () => ({
    homeLoading: true,
    home: [],
    socials: {}
  }),

  actions: {
    setHomeData(data) {
      this.home = data
      this.handelSocials(data.settings)
    },
    handelSocials(data)  {
      let socials = {
        phone: null,
        google_map: null,
        facebook: null,
        youtube: null,
        instagram: null
      }

      socials.phone = data.filter(setting => setting.name == 'phone_number')[0].value
      socials.google_map = data.filter(setting => setting.name == 'google_map')[0].value
      socials.facebook = data.filter(setting => setting.name == 'facebook')[0].value
      socials.youtube = data.filter(setting => setting.name == 'youtube')[0].value
      socials.instagram = data.filter(setting => setting.name == 'instagram')[0].value

      this.socials = socials

    }
  }
})
