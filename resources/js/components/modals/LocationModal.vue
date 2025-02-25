<template>
    <div class="modal fade" id="locationModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Выберите страну и город</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Страна</label>
                        <select class="form-select" v-model="selectedCountry" @change="fetchCities">
                            <option value="">Выберите страну</option>
                            <option v-for="country in countries" :key="country.id" :value="country.id">
                                {{ country.name }}
                            </option>
                        </select>
                    </div>

                    <div class="mb-3" v-if="cities.length">
                        <label class="form-label">Город</label>
                        <select class="form-select" v-model="selectedCity">
                            <option value="">Выберите город</option>
                            <option v-for="city in cities" :key="city.id" :value="city.id">
                                {{ city.name }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" :disabled="!selectedCity" @click="saveAndClose">
                        Сохранить
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            countries: [],
            cities: [],
            selectedCountry: localStorage.getItem('selectedCountry') || '',
            selectedCity: localStorage.getItem('selectedCity') || '',
        };
    },
    mounted() {
        this.fetchCountries();

        if (!this.selectedCountry || !this.selectedCity) {
            this.$nextTick(() => {
                const modal = new bootstrap.Modal(document.getElementById('locationModal'), {
                    backdrop: 'static',
                    keyboard: false
                });
                modal.show();
                this.modalInstance = modal; // если всё-таки понадобится
            });
        }
    },
    methods: {
        fetchCountries() {
            fetch('/location/countries')
                .then(res => res.json())
                .then(data => this.countries = data);
        },
        fetchCities() {
            this.selectedCity = '';
            this.cities = [];

            if (this.selectedCountry) {
                fetch(`/location/cities?country=${this.selectedCountry}`)
                    .then(res => res.json())
                    .then(data => this.cities = data);
            }
        },
        saveAndClose() {
            localStorage.setItem('selectedCountry', this.selectedCountry);
            localStorage.setItem('selectedCity', this.selectedCity);

            const modalEl = document.getElementById('locationModal');
            const modal = bootstrap.Modal.getInstance(modalEl);
            modal?.hide();
        }
    }
}
</script>
