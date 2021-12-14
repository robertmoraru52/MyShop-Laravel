require('./bootstrap');
require('admin-lte');

import Vue from 'vue'

//Main pages
import AutocompleteComponent from './components/AutocompleteComponent.vue';
import ProductsHomepageComponent from './components/ProductsHomepageComponent.vue';
import RemoveCartComponent from './components/RemoveCartComponent.vue';
import CartComponent from './components/CartComponent.vue';
import TotalComponent from './components/TotalComponent.vue';
import CategorySelectComponent from './components/CategorySelectComponent.vue';
import CategoryFilterComponent from './components/CategoryFilterComponent.vue';

const vue = new Vue({
    el: '#app',
    components: {ProductsHomepageComponent, AutocompleteComponent, RemoveCartComponent, CartComponent, TotalComponent,CategorySelectComponent, CategoryFilterComponent},
});
 