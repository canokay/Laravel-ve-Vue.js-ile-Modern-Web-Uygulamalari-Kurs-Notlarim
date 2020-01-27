require("./bootstrap");
window.Vue = require("vue");
import ExampleComponent from "./App.vue";

const app = new Vue({
    el: "#app",
    render: h => h(ExampleComponent)
});
