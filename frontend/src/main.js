import { createApp } from "vue";
import "./style.css";
import App from "./App.vue";
import router from "./router"; // Importa o router que criamos

createApp(App)
  .use(router) // Usa o router
  .mount("#app");
