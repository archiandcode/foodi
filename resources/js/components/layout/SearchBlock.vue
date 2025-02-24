<template>
    <section class="search-section py-4 bg-white">
        <div class="container-lg d-flex justify-content-center">
            <form action="#" method="GET" class="w-100" style="max-width: 600px;">
                <div class="input-group rounded-pill overflow-hidden border border-warning">
                    <input type="text" name="query" class="form-control border-0" placeholder="Найти ресторан">
                    <button class="btn " style="background-color: #FFD700;">Найти</button>
                </div>
            </form>
        </div>
    </section>
</template>

<script>
export default {
    name: 'SearchBlock',
}
</script>

<style scoped>
.search-section {
    background-color: #f8f8f8;
}
.input-group input:focus {
    outline: none;
    box-shadow: none;
}
</style>
