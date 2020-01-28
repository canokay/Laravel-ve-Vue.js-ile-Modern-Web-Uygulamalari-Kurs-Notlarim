<template>
  <div id="login">
    <form @submit.prevent="login">
      <label for="email">Email</label>
      <input id="email" type="email" v-model="login_email" />
      <br />
      <label for="password">Şifre</label>
      <input id="password" type="password" v-model="login_password" />
      <br />
      <button type="submit">Giriş Yap</button>
    </form>
  </div>
</template>
<script>
export default {
  data() {
    return {
      isLoading: false,
      error: "",
      login_email: null,
      login_password: null,
    };
  },
  methods: {
    login() {
      axios
        .post("http://homestead.test/api/auth/login", {
          email: this.login_email,
          password: this.login_password
        })
        .then(response => {
          this.$store.commit('setToken', response.data.access_token);
        })
        .catch(warning =>
          console.error(`login error: ${JSON.stringify(warning, null, 2)}`)
        );
    },
  },
}
</script>