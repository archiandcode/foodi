<template>
    <div class="register-wrapper bg-white rounded-4 shadow p-4 mx-auto" style="max-width: 400px;">
        <h2 class="text-center mb-4">Регистрация</h2>

        <form :action="route" method="POST" novalidate>
            <input type="hidden" name="_token" :value="csrf">

            <div class="mb-3">
                <input
                    type="text"
                    name="name"
                    class="form-control rounded-2"
                    placeholder="Имя"
                    :value="oldValues.name || ''"
                    :class="{ 'is-invalid': errors?.name }"
                >
                <div v-if="errors?.name" class="invalid-feedback d-block">
                    {{ errors.name[0] }}
                </div>
            </div>

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

            <div class="mb-3">
                <input
                    type="password"
                    name="password_confirmation"
                    class="form-control rounded-2"
                    placeholder="Подтверждение пароля"
                >
            </div>

            <p class="text-center mb-3">
                Уже есть аккаунт?
                <a :href="loginRoute" class="text-decoration-none">Войти</a>
            </p>

            <button type="submit" class="btn w-100 rounded-2 register-btn">
                Зарегистрироваться
            </button>
        </form>
    </div>
</template>

<script>
export default {
    name: 'RegisterForm',
    props: {
        route: String,
        csrf: String,
        errors: Object,
        loginRoute: String,
        oldValues: Object
    }
}
</script>

<style scoped>
.register-wrapper {
    margin-top: 80px;
}
input:focus, select:focus {
    box-shadow: none;
}
.register-btn {
    background-color: #FFD700;
    color: black;
    transition: background-color 0.2s ease;
}
.register-btn:hover {
    background-color: #e6c200;
}
</style>
