<template>
    <nav class="navbar bg-white shadow-sm sticky-top">
        <div class="container-lg d-flex align-items-center justify-content-between">
            <span class="fs-3 text-secondary">🍴</span>

            <a
                v-if="!isLoggedIn && !onAuthPage"
                :href="loginRoute"
                class="btn btn-light px-4 rounded-1"
            >
                Войти
            </a>

            <div v-if="isLoggedIn" class="d-flex align-items-center gap-2" style="overflow: visible;">
                <div class="position-relative">
                    <button
                        class="btn btn-light d-flex align-items-center gap-2"
                        @click="toggleMenu"
                    >
                        <i class="bi bi-person-circle fs-4"></i>
                    </button>

                    <ul
                        v-show="isMenuOpen"
                        class="dropdown-menu dropdown-menu-end show position-absolute mt-2 shadow"
                        style="right: 0;"
                    >
                        <li><a class="dropdown-item" :href="profileRoute">Профиль</a></li>
                        <li>
                            <button class="dropdown-item text-danger" @click="submitLogout">
                                Выйти
                            </button>
                        </li>
                    </ul>

                    <form
                        ref="logoutForm"
                        method="POST"
                        action="/logout"
                        style="display: none;"
                    >
                        <input type="hidden" name="_token" :value="csrfToken" />
                    </form>

                </div>
                <button
                    class="btn btn-outline-primary"
                    @click="$emit('open-location-modal')"
                    title="Изменить город"
                >
                    <i class="bi bi-geo-alt"></i>
                </button>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: 'Navbar',
    props: {
        loginRoute: { type: String, required: true },
        profileRoute: { type: String, default: '/profile' },
        isLoggedIn: { type: Boolean, required: true },
        onAuthPage: { type: Boolean, default: false },
        csrfToken: { type: String, required: true }
    },
    data() {
        return {
            isMenuOpen: false,
        };
    },
    methods: {
        toggleMenu() {
            this.isMenuOpen = !this.isMenuOpen;
        },
        submitLogout() {
            this.$refs.logoutForm.submit();
        },
        handleOutsideClick(event) {
            const menu = this.$el.querySelector('.dropdown-menu');
            const button = this.$el.querySelector('button');
            if (menu && !menu.contains(event.target) && !button.contains(event.target)) {
                this.isMenuOpen = false;
            }
        }
    },
    mounted() {
        document.addEventListener('click', this.handleOutsideClick);
    },
    beforeUnmount() {
        document.removeEventListener('click', this.handleOutsideClick);
    }
}
</script>

<style scoped>
.dropdown-toggle::after {
    display: none !important;
}
</style>
