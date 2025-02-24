<template>
    <section :id="category.name" class="dish-category-section mt-5">
        <h4 class="mb-4">{{ category.name }}</h4>

        <div class="row g-4">
            <div
                v-for="dish in category.dishes"
                :key="dish.id"
                class="col-6 col-md-4 col-lg-3"
            >
                <dish-card
                    :dish="dish"
                    :csrf="csrf"
                    :cart-items="cartItems"
                    :is-authenticated="isAuthenticated"
                    @updated="$emit('updated')"
                />
            </div>
        </div>
    </section>
</template>


<script>
import DishCard from './DishCard.vue';

export default {
    name: 'DishCategory',
    components: {
        DishCard
    },
    props: {
        category: Object,
        cartItems: Array,
        csrf: String,
        isAuthenticated: Boolean
    }
}
</script>

<style scoped>
.dish-category-section {
    scroll-margin-top: 4.8rem;
}
</style>
