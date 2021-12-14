<template>
    <div>
        <table id="cart" class="table table-hover table-condensed" >
            <thead>
            <tr>
                <th style="width:50%">Product</th>
                <th style="width:10%">Price</th>
                <th style="width:8%">Quantity</th>
                <th style="width:22%" class="text-center">Subtotal</th>
                <th style="width:10%"></th>
            </tr>
            </thead>
            <tbody>
                    <tr v-for="(cartList, index) in cart" :key="index">
                        <td data-th="Product">
                            <div class="row">
                            <div class="col-sm-3 hidden-xs"><img src="css/t-shirt.png" width="100" height="100" class="img-responsive"/></div>
                                <div class="col-sm-9">
                                    <h4 class="nomargin">{{cartList.name}}</h4>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">{{cartList.price}} Lei</td>
                        <td data-th="Quantity">
                            <update-cart-component :id="cartList.id" :quantity="cartList.quantity"></update-cart-component>
                        </td>
                        <td data-th="Subtotal" class="text-center">{{ cartList.price * cartList.quantity }} Lei  </td>
                        <td class="actions" data-th="">
                            <remove-cart-component :id="cartList.id"></remove-cart-component>
                        </td>
                    </tr>
            </tbody>
            <tfoot>
            <tr>
                <td><a href="homepage" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                <td colspan="2" class="hidden-xs"></td>
                <td class="hidden-xs text-center" >
                    <strong>
                        <total-component ref="total"></total-component>
                    </strong>
                </td>
                <td> 
                    <div class="col-sm-6 text-center">
                        <a href="oder-details-form" class="btn btn-success btn-block d-inline-flex">Checkout</a>
                    </div>
                </td>
            </tr>
            </tfoot>
        </table>    
    </div>
</template>

<script>
import RemoveCartComponent from './RemoveCartComponent.vue'
import UpdateCartComponent from './UpdateCartComponent.vue'
import TotalComponent from './TotalComponent.vue'

export default {
    components: {
    RemoveCartComponent,
    UpdateCartComponent,
    TotalComponent
    },
    data() {
        return {
            cart: [],
            total: {
                required: true,
                default: 0,
            },
        };
    },
    mounted() {
        /**
         * Repopulates cart collection on the event listener
         */
        this.$root.$on('result-update', (data) => {
             this.cart = data ;
        });
        this.$root.$on('result-remove', (data) => {
             this.cart = data ;
        });
    },
    created() {
        this.getResults();
    },
    methods: {
        /**
         * Fetches from controller cart collection
         */
        getResults() {
           fetch('cart-collection')
            .then(res => res.json())
            .then(res => {
                this.cart = res;
            })
        },  
    }
}
</script>