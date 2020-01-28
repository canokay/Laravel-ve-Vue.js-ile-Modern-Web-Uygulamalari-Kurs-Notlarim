<template>
  <div id="todos">
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
</template>
<script>
export default {
  data() {
    return {
      newtodo: "",
      todos: [],
      isLoading: false,
      error: "",
    }
  },
  methods: {
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
    },
  },
  beforeMount() {
    this.fetchTodos()
  },
}
</script>