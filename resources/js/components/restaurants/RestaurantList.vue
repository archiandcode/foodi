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
        };
    },
    mounted() {
        this.fetchRestaurants();
    },
    methods: {
        async fetchRestaurants() {
            try {
                const cityId = localStorage.getItem('selectedCity');
                const response = await axios.get('/restaurants', {
                    params: { cityId }
                });
                this.restaurants = response.data;
            } catch (error) {
                console.error('Ошибка при загрузке ресторанов:', error);
            }
        },
    },
};
</script>
