<template>
    <div class="login-wrapper bg-white rounded-4 shadow p-4 mx-auto" style="max-width: 400px;">
        <h2 class="text-center mb-4">Вход</h2>

        <form :action="route" method="POST" novalidate>
            <input type="hidden" name="_token" :value="csrf">

            <!-- Email -->
            <div class="mb-3">
                <input
                    type="email"
                    name="email"
                    class="form-control rounded-2"
                    placeholder="Email"
                    :value="oldValues.email || ''"
                    :class="{ 'is-invalid': errors?.email }"
                >
                <div v-if="errors?.email" class="invalid-feedback d-block">
                    {{ errors.email[0] }}
                </div>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <input
                    type="password"
                    name="password"
                    class="form-control rounded-2"
                    placeholder="Пароль"
                    :class="{ 'is-invalid': errors?.password }"
                >
                <div v-if="errors?.password" class="invalid-feedback d-block">
                    {{ errors.password[0] }}
                </div>
            </div>

            <p class="text-center mb-3">
                Нет аккаунта?
                <a :href="registerRoute" class="text-decoration-none">Зарегистрироваться</a>
            </p>

            <button type="submit" class="btn w-100 rounded-2 login-btn">
                Войти
            </button>
        </form>
    </div>
</template>

<script>
export default {
    name: 'LoginForm',
    props: {
        route: String,
        csrf: String,
        registerRoute: String,
        errors: {
            type: Object,
            default: () => ({})
        },
        oldValues: {
            type: Object,
            default: () => ({})
        }
    }
}
</script>

<style scoped>
.login-wrapper {
    margin-top: 80px;
}
input:focus {
    box-shadow: none;
}
.login-btn {
    background-color: #FFD700;
    color: black;
    transition: background-color 0.2s ease;
}
.login-btn:hover {
    background-color: #e6c200;
}
</style>
