<template>
    <div style="max-width: 480px; margin: 0 auto;" class="bg-white rounded-4 shadow-sm p-4 text-center">
        <!-- Аватар -->
        <div
            class="d-inline-flex justify-content-center align-items-center rounded-circle bg-light"
            style="width: 100px; height: 100px;"
        >
            <i class="bi bi-person-fill fs-1 text-secondary"></i>
        </div>

        <!-- Имя и email -->
        <h3 class="mt-3 fw-bold">{{ user.name }}</h3>
        <p class="text-muted mb-0">{{ user.email }}</p>
        <small class="text-secondary d-block mb-2">С {{ formatDate(user.created_at) }}</small>

        <!-- Локация -->
        <div v-if="countryName || cityName" class="bg-light rounded-3 py-2 px-3 d-inline-block mt-2">
            <i class="bi bi-geo-alt-fill text-warning me-1"></i>
            {{ countryName }}<span v-if="cityName">, {{ cityName }}</span>
        </div>

        <!-- Кнопки -->
        <div class="d-flex justify-content-center gap-2 mt-4 flex-wrap">
            <a
                :href="editProfileUrl"
                class="btn btn-outline-primary"
                style="padding: 10px 16px; font-weight: 500;"
            >
                <i class="bi bi-pencil me-2"></i> Редактировать
            </a>
            <button
                @click="openLocationModal"
                class="btn btn-outline-secondary"
                style="padding: 10px 16px; font-weight: 500;"
            >
                <i class="bi bi-geo-alt me-2"></i> Изменить адрес
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'UserProfile',
    props: {
        user: Object
    },
    data() {
        return {
            countryName: localStorage.getItem('selectedCountryName') || '',
            cityName: localStorage.getItem('selectedCityName') || ''
        }
    },
    mounted() {
        window.addEventListener('location-updated', this.updateLocationNames);
    },

    beforeUnmount() {
        window.removeEventListener('location-updated', this.updateLocationNames);
    },
    computed: {
        editProfileUrl() {
            return '/profile/edit';
        }
    },
    methods: {
        formatDate(date) {
            return new Date(date).toLocaleDateString('ru-RU', {
                day: 'numeric', month: 'long', year: 'numeric'
            });
        },
        openLocationModal() {
            const modal = new bootstrap.Modal(document.getElementById('locationModal'), {
                backdrop: 'static',
                keyboard: false
            });
            modal.show();
        },
        updateLocationNames() {
            this.countryName = localStorage.getItem('selectedCountryName') || '';
            this.cityName = localStorage.getItem('selectedCityName') || '';
        }
    }
}
</script>
