<template>
    <nav class="navbar bg-white shadow-sm sticky-top">
        <div class="container-lg d-flex align-items-center justify-content-between">
            <span class="fs-3 text-secondary">🍴</span>

            <div>
                <!-- Кнопка Войти -->
                <a
                    v-if="!isLoggedIn && !onAuthPage"
                    :href="loginRoute"
                    class="btn btn-light px-4 rounded-1"
                >
                    Войти
                </a>

                <!-- Кнопка Выйти -->
                <form
                    v-if="isLoggedIn"
                    ref="logoutForm"
                    method="POST"
                    action="/logout"
                    class="d-inline"
                >
                    <input type="hidden" name="_token" :value="csrfToken" />
                    <button type="submit" class="btn btn-light px-4 rounded-1">
                        Выйти
                    </button>
                </form>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: 'Navbar',
    props: {
        loginRoute: { type: String, required: true },
        isLoggedIn: { type: Boolean, required: true },
        onAuthPage: { type: Boolean, default: false },
        csrfToken: { type: String, required: true }
    }
}
</script>
