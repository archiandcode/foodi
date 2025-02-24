<template>
    <a :href="link" class="text-decoration-none text-dark">
        <div class="card restaurant-card shadow-sm border-0 rounded-4 overflow-hidden">
            <img :src="bannerUrl" class="card-img-top" alt="restaurant image">
            <div class="card-body">
                <h5 class="card-title mb-2">{{ name }}</h5>
            </div>
        </div>
    </a>
</template>

<script>
export default {
    name: 'RestaurantCard',
    props: {
        name: String,
        bannerUrl: String,
        link: {
            type: String,
            required: true
        }
    }
}
</script>

<style scoped>
.card-img-top {
    object-fit: cover;
    height: 200px;
}

.restaurant-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.restaurant-card:hover {
    transform: translateY(-4%);
    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
}
</style>
