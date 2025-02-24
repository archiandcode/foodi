<template>
    <div class="container py-4">
        <h3 class="mb-4">Ваша корзина</h3>

        <div v-if="items.length === 0" class="text-center">
            <p>Корзина пуста</p>
        </div>

        <div v-else>
            <div
                v-for="item in items"
                :key="item.id"
                class="d-flex justify-content-between align-items-center mb-3 p-3 bg-white rounded-4 shadow-sm"
            >
                <div>
                    <strong>{{ item.dish.name }}</strong>
                    <div>{{ item.dish.price }} ₸ / шт</div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-outline-secondary btn-sm" @click="decrement(item.dish.id)">−</button>
                    <span>{{ item.quantity }}</span>
                    <button class="btn btn-outline-secondary btn-sm" @click="increment(item.dish.id)">＋</button>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <button class="btn btn-outline-dark" @click="goBack">← Назад</button>
                <button class="btn btn-success" @click="confirmOrder">Подтвердить заказ</button>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: 'CartPage',
    props: {
        initialItems: Array,
        csrf: String,
        restaurantSlug: String,
    },
    data() {
        return {
            items: this.initialItems,
            error: null
        };
    },
    computed: {
        totalPrice() {
            return this.items.reduce((sum, item) => {
                return sum + item.dish.price * item.quantity;
            }, 0);
        }
    },
    methods: {
        async increment(dishId) {
            try {
                const res = await fetch('/cart/increment', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': this.csrf,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ dish_id: dishId })
                });
                const data = await res.json();
                if (!res.ok) throw new Error(data.message);
                this.updateItem(data.dish.id, data.quantity);
            } catch (e) {
                this.error = e.message;
            }
        },
        async decrement(dishId) {
            try {
                const res = await fetch('/cart/decrement', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': this.csrf,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ dish_id: dishId })
                });
                const data = await res.json();
                if (!res.ok) throw new Error(data.message);
                this.updateItem(data.dish.id, data.quantity);
            } catch (e) {
                this.error = e.message;
            }
        },
        updateItem(dishId, quantity) {
            const index = this.items.findIndex(i => i.dish.id === dishId);
            if (index !== -1) {
                if (quantity === 0) {
                    this.items.splice(index, 1);
                } else {
                    this.items[index].quantity = quantity;
                }
            }
        },
        goBack() {
            window.location.href = `/restaurant/${this.restaurantSlug}`;
        },
        async confirmOrder() {
            const payload = {
                restaurant_id: this.items[0]?.dish?.restaurant_id,
                total_price: this.totalPrice,
                dishes: this.items.map(item => ({
                    dish_id: item.dish.id,
                    quantity: item.quantity,
                    price: item.dish.price,
                    total: item.quantity * item.dish.price,
                }))
            };

            try {
                const response = await fetch('/order', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': this.csrf,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                const data = await response.json();

                if (!response.ok) {
                    if (response.status === 422 && data.errors) {
                        this.error = Object.values(data.errors).flat().join(' ');
                    } else if (data.details) {
                        this.error = `Ошибка: ${data.message}. Подробности: ${data.details}`;
                    } else {
                        this.error = data.message || 'Неизвестная ошибка при оформлении заказа';
                    }
                    return;
                }

                alert('Заказ успешно оформлен!');
                window.location.href = `/restaurant/${this.restaurantSlug}`;
            } catch (e) {
                this.error = 'Сервер не отвечает. Повторите попытку позже.';
            }
        }
    }
};
</script>

<style scoped>
.container {
    max-width: 700px;
}
</style>
