require("./bootstrap");
window.Vue = require("vue");

import store from "./store";

import VueRouter from "vue-router";
Vue.use(VueRouter);

import Login from "./components/Login.vue";
import TodoList from "./components/TodoList.vue";

const routes = [
    { path: "/", component: Login },
    { path: "/todo", component: TodoList }
];

const router = new VueRouter({ routes, mode: "history" });

router.beforeEach((to, from, next) => {
    const loggedIn = store.state.token;
    if (to.matched[0].path == "/todos" && !loggedIn) {
        return next("/");
    } else {
    }

    next();
});

import App from "./App.vue";

const app = new Vue({
    el: "#app",
    render: h => h(App),
    store,
    router
});
