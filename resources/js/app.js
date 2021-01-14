require('./bootstrap');

import {createApp} from "vue"
//import mitt from 'mitt'
import App from "./components/App";
// const emitter = mitt()
//
// Window.Apply = new class {
//
//     constructor() {
//         this.vue = emitter;
//     }
//
//     fire(event, data) {
//         this.vue.emit(event, data)
//     }
//
//     listen(event, callback) {
//         this.vue.on(event, callback)
//     }
// }

const app = createApp({
components: {
    App
}
}).mount("#app")




