import './bootstrap';

import {createApp} from 'vue'
import router from "./router";
import App from './App.vue'
import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";
import { library, dom } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { fas } from "@fortawesome/free-solid-svg-icons";

library.add(fas);
dom.watch();

createApp(App)
.use(router)
.component("font-awesome-icon", FontAwesomeIcon)
.mount("#app")