<template>
    <div class="restaurant-layout d-flex gap-4 container-xxl py-4">
        <menu-sidebar :categories="categories" />

        <main class="flex-grow-1">
            <restaurant-header :restaurant="restaurant" />

            <div v-for="category in categories" :key="category.id">
                <dish-category
                    :category="category"
                    :csrf="csrf"
                    :cart-items="localCartItems"
                    :is-authenticated="isAuthenticated"
                    @updated="refreshCart"
                />
            </div>
        </main>

        <cart
            :cart-items="localCartItems"
            @increment="handleIncrement"
            @decrement="handleDecrement"
            @clear="handleClear"
        />
    </div>
</template>

<script>
import MenuSidebar from './MenuSidebar.vue';
import RestaurantHeader from './RestaurantHeader.vue';
import DishCategory from './DishCategory.vue';
import Cart from './Cart.vue';

export default {
    name: 'DishesView',
    components: {
        MenuSidebar,
        RestaurantHeader,
        DishCategory,
        Cart
    },
    props: {
        restaurant: Object,
        categories: Array,
        csrf: String,
        isAuthenticated: Boolean,
    },
    data() {
        return {
            localCartItems: []
        };
    },
    mounted() {
        this.refreshCart();
    },
    methods: {
        refreshCart() {
            fetch(`/cart/items?restaurant_id=${this.restaurant.id}`)
                .then(res => res.json())
                .then(data => {
                    this.localCartItems = data.items;
                });
        },
        handleIncrement(dishId) {
            fetch('/cart/increment', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': this.csrf,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ dish_id: dishId })
            }).then(() => this.refreshCart());
        },
        handleDecrement(dishId) {
            fetch('/cart/decrement', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': this.csrf,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ dish_id: dishId })
            }).then(() => this.refreshCart());
        },
        handleClear() {
            fetch('/cart/clear', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': this.csrf,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            }).then(() => this.refreshCart());
        }
    }
}
</script>
