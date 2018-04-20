require('./bootstrap');
import Vue from 'vue';
import DataViewer from './components/DataViewer.vue'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import locale from 'element-ui/lib/locale/lang/en'
Vue.use(ElementUI, { locale })
var app = new Vue({
    el: '#app',
    components: {
        DataViewer
    }
})