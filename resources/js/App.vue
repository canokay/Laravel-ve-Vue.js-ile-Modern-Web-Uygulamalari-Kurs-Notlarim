<template>
  <div class="container">
    <div id="login" v-if="!token">
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
    <div id="todos" v-else>
      <ul>
        <li
          v-for="todo in todos"
          :key="todo.id"
          @click="toggle(todo.id)"
          :class="{ 'completed': todo.completed_at }"
        >
          <span v-if="todo.completed_at">✅</span>
          <span v-else>📌</span>
          {{ todo.text }}
        </li>
      </ul>
      <form @submit.prevent="addNewTodo">
        <input type="text" v-model="newtodo" :disabled="isLoading" />
        <button type="submit" :disabled="isLoading">
          <span v-if="isLoading">...</span>
          <span v-else>Ekle</span>
        </button>
      </form>
      <span v-if="error">{{ error }}</span>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      newtodo: "",
      todos: [],
      isLoading: false,
      error: "",
      login_email: null,
      login_password: null,
      token: null
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
          this.token = response.data.access_token;
          axios.defaults.headers.common[
            "Authorization"
          ] = `Bearer ${this.token}`;
          this.fetchTodos();
        })
        .catch(warning =>
          console.error(`login error: ${JSON.stringify(warning, null, 2)}`)
        );
    },
    toggle(todoId) {
      const todoIndex = this.todos.findIndex(todo => todo.id === todoId);
      if (todoIndex === -1) return false;
      axios
        .put(`http://homestead.test/api/todos/${todoId}/toggle`)
        .then(
          response =>
            (this.todos[todoIndex].completed_at = response.data.completed_at)
        )
        .catch(warning =>
          console.error(`toggle error: ${JSON.stringify(warning, null, 2)}`)
        );
    },
    addNewTodo() {
      if (this.newtodo.length < 3) {
        this.error = "Lütfen 3'den fazla karakter giriniz.";
        setTimeout(() => (this.error = ""), 2000);
        return false;
      }
      this.isLoading = true;
      axios
        .post("http://homestead.test/api/todos/", { todo: this.newtodo })
        .then(response => {
          this.todos.unshift(response.data);
          this.newtodo = "";
        })
        .catch(warning =>
          console.log(`addNewTodo error: ${JSON.stringify(warning, null, 2)}`)
        )
        .then(() => {
          if (this.error.length > 0) this.error = "";
          this.isLoading = false;
        });
    },
    fetchTodos() {
      axios
        .get("http://homestead.test/api/todos/")
        .then(response => (this.todos = response.data))
        .catch(warning =>
          console.error(`ilgili catch: ${JSON.stringify(warning, null, 2)}`)
        );
    }
  }
};
</script>

<style>
.completed {
  text-decoration: line-through;
}
</style>
