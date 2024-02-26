import GlobalApi from '@/controllers/global'
export const useUserStore = defineStore('User', {

  state: () => ({
    permissions: JSON.parse(localStorage.getItem('abilities')) || [],
    accessToken: null,
    userData: null
  }),

  actions: {
      loginSuccess(user) {
        this.accessToken = user.token
        this.userData = user.user

        localStorage.setItem('token', this.accessToken);
        localStorage.setItem('userData', JSON.stringify(this.userData));

      },

      logoutSuccess() {
        this.accessToken = this.userData = null
        localStorage.removeItem('token');
        localStorage.removeItem('userData');
      },

      getAbilities() {
        GlobalApi.getAbilities().then(response => {
          localStorage.setItem('abilities', JSON.stringify(response.data))
          this.permissions = response.data
        })
      }
  }

})
