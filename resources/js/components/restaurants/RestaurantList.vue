<template>
    <section>
        <div class="container-lg">
            <h2 class="text-center mb-4">Рестораны</h2>

            <div class="row g-4">
                <div
                    class="col-md-4"
                    v-for="restaurant in restaurants"
                    :key="restaurant.id"
                >
                    <RestaurantCard
                        :name="restaurant.name"
                        :banner-url="restaurant.banner_url"
                        :link="restaurant.link"
                    />
                </div>
            </div>

            <div v-if="loading" class="text-center mt-4">
                <div class="spinner-border text-warning" role="status">
                    <span class="visually-hidden">Загрузка...</span>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import axios from 'axios';
import RestaurantCard from './RestaurantCard.vue';

export default {
    name: 'RestaurantList',
    components: { RestaurantCard },
    data() {
        return {
            restaurants: [],
            loading: true,
        };
    },
    mounted() {
        this.waitForCityAndFetch();
    },
    methods: {
        waitForCityAndFetch() {
            const checkInterval = 100;

            const interval = setInterval(() => {
                const cityId = localStorage.getItem('selectedCity');

                if (cityId) {
                    clearInterval(interval);
                    this.fetchRestaurants(cityId);
                }
            }, checkInterval);
        },

        async fetchRestaurants(cityId) {
            try {
                const response = await axios.get('/restaurants', {
                    params: { cityId }
                });
                this.restaurants = response.data;
            } catch (error) {
                console.error('Ошибка при загрузке ресторанов:', error);
            } finally {
                this.loading = false;
            }
        }
    }
};
</script>
