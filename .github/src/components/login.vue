<template>
  <form @submit.prevent="login">
    <input v-model="email" type="email" placeholder="Email" />
    <input v-model="password" type="password" placeholder="Password" />
    <button type="submit">Login</button>
  </form>
</template>
<script>
export default {
  data() { return { email: '', password: '' } },
  methods: {
    async login() {
      await this.$axios.post('/api/login', { email: this.email, password: this.password });
      // handle 2FA requirement per response
    }
  }
}
</script>
