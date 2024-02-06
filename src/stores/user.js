
export const useUserStore = defineStore('User', {

  state: () => ({
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
      }
  }

})
