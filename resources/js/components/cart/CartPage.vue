<template>
    <div class="container py-4 cart-container">
        <h3 class="mb-4">Ваша корзина</h3>

        <div v-if="items.length === 0" class="text-center">
            <p>Корзина пуста</p>
        </div>

        <div v-else>
            <div class="cart-card bg-white rounded-4 shadow-sm p-3 mb-4">
                <div class="cart-items-scroll">
                    <div
                        v-for="item in items"
                        :key="item.id"
                        class="d-flex gap-3 align-items-center mb-3 border-bottom pb-3"
                    >
                        <div class="dish-img-wrapper">
                            <img :src="item.dish.image_url" alt="dish image" class="img-fluid rounded-3 dish-img" />
                        </div>

                        <div class="flex-grow-1 d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ item.dish.name }}</strong>
                                <div class="text-muted">{{ item.dish.price }} ₸ / шт</div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <button class="btn btn-outline-secondary quantity-btn" @click="decrement(item.dish.id)">−</button>
                                <span>{{ item.quantity }}</span>
                                <button class="btn btn-outline-secondary quantity-btn" @click="increment(item.dish.id)">＋</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end mb-3">
                <h5 class="fw-bold text-success fs-5">Итого: {{ totalPrice }} ₸</h5>
            </div>

            <div class="sticky-actions d-flex flex-wrap justify-content-between gap-2">
                <button class="btn btn-outline-dark flex-grow-1" @click="goBack">← Назад</button>
                <button class="btn btn-outline-primary flex-grow-1" @click="openAddressModal">Указать адрес</button>
                <button
                    :class="['btn', 'flex-grow-1', isAddressSelected ? 'btn-success' : 'btn-secondary']"
                    :disabled="!isAddressSelected"
                    @click="confirmOrder"
                >
                    Подтвердить заказ
                </button>
            </div>
        </div>

        <div v-show="isAddressModalOpen" class="modal-overlay">

        <div class="modal-content-custom bg-white rounded-4 shadow p-4">
                <h5 class="mb-3">Укажите адрес доставки</h5>

                <div class="mb-3">
                    <div id="map" class="map-container"></div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Комментарий (необязательно):</label>
                    <textarea v-model="address.note" class="form-control" rows="2"></textarea>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <button class="btn btn-secondary" @click="closeAddressModal">Отмена</button>
                    <button class="btn btn-primary" @click="saveAddress" :disabled="!isAddressSelected">
                        Сохранить
                    </button>
                </div>
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
            error: null,
            isAddressModalOpen: false,
            address: {
                latitude: null,
                longitude: null,
                city_id: null,
                note: '',
            },
            map: null,
            marker: null,
        };
    },
    computed: {
        totalPrice() {
            return this.items.reduce((sum, item) => sum + item.dish.price * item.quantity, 0);
        },
        isAddressSelected() {
            return this.address.latitude !== null && this.address.longitude !== null;
        }
    },
    watch: {
        items(newItems) {
            if (newItems.length === 0) {
                this.goBack();
            }
        }
    },
    mounted() {
        if (this.items.length === 0) {
            this.goBack();
        }
    },
    methods: {
        openAddressModal() {
            this.isAddressModalOpen = true;

            const cityId = localStorage.getItem('selectedCity');
            this.address.city_id = cityId ? parseInt(cityId) : null;

            this.$nextTick(() => {
                setTimeout(() => {
                    const mapElement = document.getElementById('map');
                    if (!mapElement) return;

                    if (!this.map) {
                        this.map = new google.maps.Map(mapElement, {
                            center: this.getInitialMapCenter(),
                            zoom: 14,
                            mapTypeControl: false,
                            streetViewControl: false,
                            fullscreenControl: false,
                            zoomControl: true
                        });

                        this.map.addListener('click', (e) => {
                            const lat = e.latLng.lat();
                            const lng = e.latLng.lng();

                            this.address.latitude = lat;
                            this.address.longitude = lng;

                            if (this.marker) {
                                this.marker.setPosition(e.latLng);
                            } else {
                                this.marker = new google.maps.Marker({
                                    position: e.latLng,
                                    map: this.map,
                                });
                            }
                        });
                    } else {
                        google.maps.event.trigger(this.map, 'resize');
                        this.map.setCenter(this.getInitialMapCenter());

                        if (this.isAddressSelected) {
                            const latLng = new google.maps.LatLng(this.address.latitude, this.address.longitude);
                            if (this.marker) {
                                this.marker.setPosition(latLng);
                            } else {
                                this.marker = new google.maps.Marker({
                                    position: latLng,
                                    map: this.map,
                                });
                            }
                        }
                    }
                }, 200);
            });
        },
        getInitialMapCenter() {
            return this.isAddressSelected
                ? { lat: this.address.latitude, lng: this.address.longitude }
                : { lat: 43.2389, lng: 76.8897 };
        },
        closeAddressModal() {
            this.isAddressModalOpen = false;
        },
        saveAddress() {
            if (this.isAddressSelected) {
                this.closeAddressModal();
            }
        },
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
                    this.items = this.items.filter(i => i.dish.id !== dishId);
                } else {
                    this.items = this.items.map(i =>
                        i.dish.id === dishId ? { ...i, quantity } : i
                    );
                }
            }
        },
        goBack() {
            window.location.href = `/restaurant/${this.restaurantSlug}`;
        },
        async confirmOrder() {
            const cityId = localStorage.getItem('selectedCity');
            this.address.city_id = cityId ? parseInt(cityId) : null;

            const payload = {
                restaurant_id: this.items[0]?.dish?.restaurant_id,
                total_price: this.totalPrice,
                dishes: this.items.map(item => ({
                    dish_id: item.dish.id,
                    quantity: item.quantity,
                    price: item.dish.price,
                    total: item.quantity * item.dish.price,
                })),
                address: this.address
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
                    this.error = data.message || 'Ошибка при оформлении заказа';
                    return;
                }

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

.cart-card {
    max-height: 400px;
    overflow-y: auto;
    border: 1px solid #ddd;
}

.cart-items-scroll {
    max-height: 100%;
    overflow-y: auto;
    padding-right: 8px;
}

.quantity-btn {
    width: 32px;
    height: 32px;
    font-size: 18px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.sticky-actions {
    position: sticky;
    bottom: 0;
    background-color: #fff;
    padding-top: 12px;
    border-top: 1px solid #eee;
    gap: 12px;
}

.dish-img-wrapper {
    flex: 0 0 64px;
    height: 64px;
    overflow: hidden;
    border-radius: 0.5rem;
}

.dish-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 0.5rem;
}

@media (max-width: 576px) {
    .sticky-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .sticky-actions button {
        width: 100%;
    }
}

.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1050;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-content-custom {
    width: 90%;
    max-width: 500px;
}

.map-container {
    width: 100%;
    height: 300px;
    border-radius: 8px;
}
</style>
