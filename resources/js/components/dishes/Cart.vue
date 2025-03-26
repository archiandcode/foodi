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

        <div v-if="cartItems.length === 0" class="text-center mt-5 flex-grow-1 d-flex align-items-center justify-content-center">
            <p class="mt-2">В вашей корзине пока пусто</p>
        </div>

        <div v-else class="cart-body">
            <div class="dish-cart-items">
                <template v-for="item in cartItems" :key="item.dish_id">
                    <div
                        v-if="item.dish"
                        class="d-flex justify-content-between align-items-center mb-3"
                    >
                        <div class="d-flex align-items-start gap-2">
                            <img
                                :src="item.dish.image_url"
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
            </div>

            <div class="cart-footer pt-3 border-top">
                <div class="d-flex justify-content-between align-items-center fw-bold fs-5">
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
        csrf: String,
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
        }
    },
};
</script>

<style scoped>
.dish-cart {
    width: 400px;
    height: 600px;
    top: 5.1rem;
    display: flex;
    flex-direction: column;
}

.cart-body {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.dish-cart-items {
    overflow-y: auto;
    flex-grow: 1;
    padding-right: 4px;
}

.cart-footer {
    flex-shrink: 0;
}
</style>
