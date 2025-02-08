<script>
    document.addEventListener('DOMContentLoaded', function () {
        const countrySelect = document.getElementById('countrySelect');
        const citySelect = document.getElementById('citySelect');
        const cityUrl = countrySelect.dataset.url;

        fetch('/api/countries')
            .then(response => response.json())
            .then(data => {
                data.forEach(country => {
                    const option = document.createElement('option');
                    option.value = country.id;
                    option.textContent = country.name;
                    if (country.id == "{{ old('country_id', $address->country_id ?? '') }}") {
                        option.selected = true;
                    }
                    countrySelect.appendChild(option);
                });

                if (countrySelect.value) {
                    loadCities(countrySelect.value);
                }
            });

        countrySelect.addEventListener('change', function () {
            loadCities(this.value);
        });

        function loadCities(countryId) {
            citySelect.innerHTML = '<option value="">-- Загрузка... --</option>';

            if (!countryId) {
                citySelect.innerHTML = '<option value="">-- Сначала выберите страну --</option>';
                return;
            }

            fetch(`${cityUrl}?country=${countryId}`)
                .then(response => response.json())
                .then(data => {
                    citySelect.innerHTML = '<option value="">-- Выберите город --</option>';
                    data.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.id;
                        option.textContent = city.name;
                        if (city.id == "{{ old('city_id', $address->city_id ?? '') }}") {
                            option.selected = true;
                        }
                        citySelect.appendChild(option);
                    });
                })
                .catch(() => {
                    citySelect.innerHTML = '<option value="">-- Ошибка загрузки --</option>';
                });
        }

    });
</script>
