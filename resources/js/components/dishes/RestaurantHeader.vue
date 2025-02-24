<template>
    <div class="position-relative">
        <img :src="restaurant.banner_url" class="w-100 rounded-4" style="height: 250px; object-fit: cover;" alt="{{ restaurant.name }}">

        <div class="position-absolute bottom-0 start-0 p-4 w-100">
            <div class="d-inline-block bg-dark bg-opacity-50 text-white px-3 py-2 rounded-5">
                <h1 class="fw-bold fs-4 m-0">{{ restaurant.name }}</h1>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'RestaurantHeader',
    props: {
        restaurant: Object
    }
}
</script>
