<template>
    <div>
        <h4 class="mb-4 text-center">Мои заказы</h4>

        <div v-if="loading" class="text-center py-4">
            <div class="spinner-border text-warning" role="status">
                <span class="visually-hidden">Загрузка...</span>
            </div>
        </div>

        <div v-else-if="orders.length" class="d-flex flex-column gap-4 align-items-center">
            <div
                v-for="order in orders"
                :key="order.id"
                class="card shadow-sm rounded-4 w-100"
                style="max-width: 720px;"
            >
                <div class="card-body d-flex justify-content-between align-items-center flex-wrap">
                    <div class="mb-2 mb-md-0">
                        <h5 class="mb-1">Заказ #{{ order.id }}</h5>
                        <p class="mb-1 text-muted small">{{ order.name }}</p>
                        <p class="mb-0 text-secondary small">
                            <i class="bi bi-clock me-1"></i>{{ formatDate(order.created_at) }}
                        </p>
                    </div>
                    <div>
                        <span
                            :class="['badge', 'px-3', 'py-2', 'rounded-pill', statusClass(order.status)]"
                        >
                            {{ statusText(order.status) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div v-else class="text-muted text-center">У вас пока нет заказов.</div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'UserOrders',
    data() {
        return {
            orders: [],
            loading: true,
        };
    },
    mounted() {
        this.fetchOrders();
    },
    methods: {
        async fetchOrders() {
            try {
                const response = await axios.get('/orders');
                this.orders = response.data;
            } catch (e) {
                console.error('Ошибка при получении заказов:', e);
            } finally {
                this.loading = false;
            }
        },
        formatDate(date) {
            return new Date(date).toLocaleString('ru-RU', {
                day: 'numeric', month: 'long', year: 'numeric',
                hour: '2-digit', minute: '2-digit'
            });
        },
        statusText(status) {
            const map = {
                pending: 'В ожидании',
                processing: 'В обработке',
                completed: 'Завершён',
                cancelled: 'Отменён'
            };
            return map[status] || status;
        },
        statusClass(status) {
            const map = {
                pending: 'bg-warning text-dark',
                processing: 'bg-info text-white',
                completed: 'bg-success text-white',
                cancelled: 'bg-danger text-white'
            };
            return map[status] || 'bg-secondary text-white';
        }
    }
}
</script>
