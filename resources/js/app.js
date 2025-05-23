import './bootstrap';

import { createApp } from 'vue';
import Navbar from "./components/layout/Navbar.vue";
import SearchBlock from "./components/layout/SearchBlock.vue";
import RestaurantList from "./components/restaurants/RestaurantList.vue";
import LoginForm from "./components/auth/LoginForm.vue";
import RegisterForm from "./components/auth/RegisterForm.vue";
import DishesView from "./components/dishes/DishesView.vue";
import CartPage from "./components/cart/CartPage.vue";
import LocationModal from './components/modals/LocationModal.vue';
import UserProfile from "./components/user-profile/UserProfile.vue";
import UserOrders from "./components/user-profile/UserOrders.vue";

const app = createApp({})

app.component('navbar', Navbar);
app.component('search-block', SearchBlock);
app.component('restaurant-list', RestaurantList);
app.component('login-form', LoginForm);
app.component('register-form', RegisterForm);
app.component('dishes-view', DishesView);
app.component('cart-page', CartPage);
app.component('location-modal', LocationModal);
app.component('user-profile', UserProfile)
app.component('user-orders', UserOrders)

app.mount('#app');
