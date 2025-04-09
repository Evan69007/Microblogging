import { createApp } from "vue";
import App from "./App.vue";
import router from "./router"; // Importer le router
import "./assets/style.css";

const app = createApp(App);

app.use(router);

app.mount("#app");
