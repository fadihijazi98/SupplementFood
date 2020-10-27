/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import * as htmlToImage from 'html-to-image';
import { toPng, toJpeg, toBlob, toPixelData, toSvg } from 'html-to-image';


require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data() {
        return {
            amounts_list: {},
            warnings_list: {},
            name: document.getElementById('name').value,
            dose_size: document.getElementById('dose_size').value,
            dose_for_each_package: document.getElementById('dose_for_each_package').value,
            daily_amount: '',
            dose_daily_amount: '',
            content: '',
            supplement_id: '',
        }
    },
    methods: {

        getAmountList() {
            axios.get("/ingredient?supplement_id="+this.supplement_id)
                 .then(response => {
                     this.amounts_list = response.data;
                 });
        },

        getWarningsList() {
            axios.get("/warning?supplement_id="+this.supplement_id)
                 .then(response => {
                     this.warnings_list = response.data;
                 });
        },

        addAmount() {
            axios.post('/ingredient',{
                    supplement_id: this.supplement_id,
                    daily_ratio: this.daily_amount,
                    amount_for_each_dose: this.dose_daily_amount
                })
                .then(response => {
                    this.dose_daily_amount = '';
                    this.daily_amount = '';
                    alert(response.data);
                    this.getAmountList();
                });

        },

        addWarning() {
            axios.post('/warning', {
                supplement_id: this.supplement_id,
                content: this.content
            })
            .then(response => {
                this.content = '';
                alert(response.data);
                this.getWarningsList()
            });
        },

        deleteIngredient(id) {
            axios.delete('/ingredient/'+id)
                  .then(response => {
                      alert(response.data);
                      this.getAmountList();
                  })
        },

        deleteWarning(id) {
            axios.delete('/warning/'+id)
                .then(response => {
                    alert(response.data);
                    this.getWarningsList();
                })
        },

        exportToImage() {

            // document.getElementById('parent-table-render').style.display = "block";


            htmlToImage.toJpeg(document.getElementById('table-render'), { quality: 1 })
                .then(function (dataUrl) {
                    var node = document.getElementById('table-render');
                    var link = document.createElement('a');
                    link.download = 'supplements.jpeg';
                    link.href = dataUrl;
                    axios.post('/image', {
                            supplement_id: supplement_id.value,
                        dataUrl: dataUrl
                    }).then(response => {
                        alert(response.data);
                    });
                    link.click();
                });

        },

    },
    mounted() {
        this.supplement_id = document.getElementById('supplement_id').value;
        this.getAmountList();
        this.getWarningsList();
    }
});
