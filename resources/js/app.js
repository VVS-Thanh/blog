require('./bootstrap');


import Vue from "vue";

window.Vue = Vue;
import axios from "axios";
import moment from "moment";
import CKEditor from 'ckeditor4-vue';
import Select2 from 'v-select2-component';

import Multiselect from 'vue-multiselect'
window.CKEditor = CKEditor;
window.Multiselect = Multiselect;

// register globally
Vue.component('multiselect', Multiselect)

window.Select2 = Select2;
window._ = require("lodash");
window.axios = require("axios");
window.moment = require("moment");



