<template>
    <div class="restaurant-layout d-flex gap-4 container-xxl py-4 position-relative">
        <button
            class="menu-toggle-btn btn btn-dark d-md-none"
            @click="isSidebarOpen = !isSidebarOpen"
        >
            ☰ Меню
        </button>

        <div v-if="windowWidth < 769">
            <transition name="fade">
                <div
                    v-show="isSidebarOpen"
                    class="sidebar-mobile-overlay"
                    @click="isSidebarOpen = false"
                ></div>
            </transition>

            <transition name="slide">
                <div
                    v-show="isSidebarOpen"
                    class="menu-sidebar-fixed bg-white p-3 shadow"
                >
                    <button
                        class="close-btn"
                        @click="isSidebarOpen = false"
                    >
                        ×
                    </button>
                    <menu-sidebar :categories="categories" />
                </div>
            </transition>
        </div>

        <div v-if="windowWidth >= 769" class="menu-sidebar-width">
            <menu-sidebar :categories="categories" />
        </div>

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
            v-if="windowWidth >= 1200"
            :cart-items="localCartItems"
            @increment="handleIncrement"
            @decrement="handleDecrement"
            @clear="handleClear"
        />

        <button
            v-if="windowWidth < 1200 && localCartItems.length > 0"
            class="floating-cart-button btn btn-dark d-flex align-items-center gap-2"
            @click="openCartModal"
        >
            <i class="fa-solid fa-cart-shopping"></i>
            <span>{{ totalPrice }} ₸</span>
        </button>

    </div>
</template>

<script>
import MenuSidebar from './MenuSidebar.vue'
import RestaurantHeader from './RestaurantHeader.vue'
import DishCategory from './DishCategory.vue'
import Cart from './Cart.vue'

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
        isAuthenticated: Boolean
    },
    data() {
        return {
            localCartItems: [],
            isSidebarOpen: false,
            windowWidth: window.innerWidth
        }
    },
    computed: {
        totalPrice() {
            return this.localCartItems.reduce((sum, item) => {
                return sum + (item.dish?.price || 0) * item.quantity
            }, 0)
        }
    },
    mounted() {
        this.refreshCart()
        window.addEventListener('resize', this.handleResize)
    },
    beforeUnmount() {
        window.removeEventListener('resize', this.handleResize)
    },
    methods: {
        handleResize() {
            this.windowWidth = window.innerWidth
            if (this.windowWidth >= 769) {
                this.isSidebarOpen = false
            }
        },
        refreshCart() {
            fetch(`/cart/items?restaurant_id=${this.restaurant.id}`)
                .then(res => res.json())
                .then(data => {
                    this.localCartItems = data.items
                })
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
            }).then(() => this.refreshCart())
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
            }).then(() => this.refreshCart())
        },
        handleClear() {
            fetch('/cart/clear', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': this.csrf,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            }).then(() => this.refreshCart())
        },
        openCartModal() {
            window.location.href = '/cart'
        }
    }
}
</script>

<style scoped>
.container-xxl {
    max-width: 1400px;
}

.menu-toggle-btn {
    position: fixed;
    top: 5px;
    left: 18px;
    z-index: 1051;
    border-radius: 50px;
    padding: 10px 16px;
    font-size: 14px;
}

.sidebar-mobile-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.4);
    z-index: 1050;
}

.menu-sidebar-fixed {
    position: fixed;
    top: 0;
    left: 0;
    width: 280px;
    height: 100vh;
    z-index: 1051;
    overflow-y: auto;
}

.close-btn {
    position: absolute;
    top: 12px;
    right: 12px;
    background: transparent;
    border: none;
    font-size: 36px;
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    line-height: 1;
    color: #000;
    cursor: pointer;
    z-index: 1052;
}

.slide-enter-active,
.slide-leave-active {
    transition: all 0.3s ease;
}

.slide-enter-from,
.slide-leave-to {
    transform: translateX(-100%);
    opacity: 0;
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.menu-sidebar-width {
    width: 250px;
}

.floating-cart-button {
    position: fixed;
    bottom: 16px;
    right: 16px;
    z-index: 1052;
    border-radius: 50px;
    padding: 12px 20px;
    font-size: 14px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}
</style>
