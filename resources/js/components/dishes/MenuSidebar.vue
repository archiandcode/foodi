<template>
    <aside class="sidebar-sticky">
        <a href="/" class="btn btn-light w-100 mb-3">← Все рестораны</a>
        <h5>Меню</h5>
        <ul class="list-unstyled">
            <li
                v-for="category in categories"
                :key="category.id"
            >
                <a
                    :href="'#' + encodeURIComponent(category.name)"
                    class="text-dark text-decoration-none d-block py-2 px-3 rounded-3"
                    :class="{ 'bg-white': activeCategory === category.name }"
                    @click="setActive(category.name)"
                >
                    {{ category.name }}
                </a>
            </li>
        </ul>
    </aside>
</template>

<script>
export default {
    name: 'MenuSidebar',
    props: {
        categories: Array
    },
    data() {
        return {
            activeCategory: null
        }
    },
    mounted() {
        this.syncFromHash()
        window.addEventListener('hashchange', this.syncFromHash);
    },
    beforeUnmount() {
        window.removeEventListener('hashchange', this.syncFromHash);
    },
    methods: {
        syncFromHash() {
            const hash = decodeURIComponent(window.location.hash.slice(1));
            this.activeCategory = hash;
        },
        setActive(name) {
            this.activeCategory = name;
        }
    }
}
</script>

<style scoped>
.sidebar-sticky {
    position: sticky;
    top: 5.1rem;
    align-self: flex-start;
    height: fit-content;
}
</style>
