<template>
    <aside class="dish-cart position-sticky bg-white rounded-4 shadow-sm p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Корзина</h5>
            <button
                v-if="cartItems.length > 0"
                @click="clearCart"
                class="btn btn-sm btn-link text-muted"
            >
                Очистить
            </button>
        </div>

        <div v-if="cartItems.length === 0" class="text-center mt-5">
            <img
                src="https://avatars.mds.yandex.net/get-bunker/994123/d04c085fae5bf3b50f6a912a6190f94df21adaa4/orig"
                alt="Empty"
                width="60"
            />
            <p class="mt-2">В вашей корзине пока пусто</p>
        </div>

        <div v-else>
            <template v-for="item in cartItems" :key="item.dish_id">
                <div
                    v-if="item.dish"
                    class="d-flex justify-content-between align-items-center mb-3"
                >
                    <div class="d-flex align-items-start gap-2">
                        <img
                            :src="fullImage(item.dish.image)"
                            alt=""
                            width="50"
                            class="rounded"
                        />
                        <div>
                            <strong>{{ item.dish.name }}</strong>
                            <div class="text-muted small">
                                {{ item.dish.price }} ₸
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <button
                            class="btn btn-sm px-2"
                            @click="$emit('decrement', item.dish.id)"
                        >
                            −
                        </button>
                        <span>{{ item.quantity }}</span>
                        <button
                            class="btn btn-sm px-2"
                            @click="$emit('increment', item.dish.id)"
                        >
                            ＋
                        </button>
                    </div>
                </div>
            </template>

            <div
                class="d-flex justify-content-between align-items-center mt-4 fw-bold fs-5"
            >
                <span>Итого:</span>
                <span>{{ totalPrice }} ₸</span>
            </div>

            <a
                href="/cart"
                class="btn btn-warning w-100 mt-3 rounded-3 fw-semibold"
            >
                Далее
            </a>
        </div>
    </aside>
</template>

<script>
export default {
    name: 'Cart',
    props: {
        cartItems: {
            type: Array,
            default: () => [],
        },
    },
    computed: {
        totalPrice() {
            return this.cartItems.reduce((sum, item) => {
                if (item.dish) {
                    return sum + item.dish.price * item.quantity;
                }
                return sum;
            }, 0);
        }
    },
    methods: {
        clearCart() {
            this.$emit('clear');
        },
        fullImage(path) {
            return path && path.startsWith('http') ? path : `/storage/${path}`;
        },
    },
};
</script>

<style scoped>
.dish-cart {
    width: 260px;
    top: 5.1rem;
    height: fit-content;
}
</style>
