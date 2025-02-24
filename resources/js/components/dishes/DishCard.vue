<template>
    <div class="p-3 bg-white rounded-4 h-100 d-flex flex-column justify-content-between">
        <img :src="fullImage" class="mb-3 w-100 rounded-3" style="height: 140px; object-fit: cover;" :alt="dish.name">

        <div>
            <h6>{{ dish.price }} ₸</h6>
            <p class="mb-1">{{ dish.name }}</p>
        </div>

        <div class="mt-3">
            <button
                v-if="quantity === 0"
                @click="addToCart"
                class="btn btn-outline-dark w-100"
            >
                + Добавить
            </button>

            <div v-else class="d-flex justify-content-between align-items-center px-3 py-2 rounded" style="background-color: #f1f1f1;">
                <button class="btn btn-sm px-2" @click="decrement">−</button>
                <span>{{ quantity }}</span>
                <button class="btn btn-sm px-2" @click="increment">＋</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'DishCard',
    props: {
        dish: Object,
        csrf: String,
        cartItems: {
            type: Array,
            default: () => []
        },
        isAuthenticated: Boolean
    },

    computed: {
        fullImage() {
            return `/storage/${this.dish.image}`;
        },
        quantity() {
            const item = this.cartItems.find(i => i.dish.id === this.dish.id);
            return item ? item.quantity : 0;
        }
    },

    methods: {
        addToCart() {
            if (!this.isAuthenticated) {
                window.location.href = '/login';
                return;
            }

            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': this.csrf,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ dish_id: this.dish.id })
            }).then(() => {
                this.$emit('updated');
            });
        },

        async increment() {
            await fetch('/cart/increment', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': this.csrf,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ dish_id: this.dish.id })
            });

            this.$emit('updated', this.dish.id);
        },

        async decrement() {
            await fetch('/cart/decrement', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': this.csrf,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ dish_id: this.dish.id })
            });

            this.$emit('updated', this.dish.id);
        }
    }

}
</script>
