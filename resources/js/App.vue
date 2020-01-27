<template>
  <div class="container">
    <ul>
      <li v-for="(todo, key) in todos" :key="key" @click="toggle(key)">
        <span v-if="todo.is_done">✅</span>
        <span v-else>📌</span>
        {{ todo.text }}
      </li>
    </ul>
    <form @submit.prevent="addNewTodo">
      <input type="text" v-model="newtodo" />
      <button type="submit">Ekle</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      newtodo: "",
      todos: [
        {
          text: "Vue.js anlatılacak",
          is_done: false
        },
        {
          text: "Laravel anlatılacak",
          is_done: true
        }
      ]
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
  methods: {
    toggle(key) {
      this.todos[key].is_done = !this.todos[key].is_done;
    },
    addNewTodo() {
      if (this.newtodo.length > 3) {
        this.todos.push({
          text: this.newtodo,
          is_done: false
        });
        this.newtodo = "";
      }
    }
  }
};
</script>
