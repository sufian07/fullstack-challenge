import { createApp } from "vue";
import { createPinia } from "pinia";
import App from "./App.vue";
import router from "./router";
import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faCloud, faUser } from "@fortawesome/free-solid-svg-icons";
import "./assets/main.css";

/* add icons to the library */
library.add(faUser, faCloud);

const app = createApp(App);

app.use(createPinia());
app.use(router);
app.component("font-awesome-icon", FontAwesomeIcon);
app.mount("#app");
