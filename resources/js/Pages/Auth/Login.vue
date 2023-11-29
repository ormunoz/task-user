<template>
    <Head title="Log in" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submitForm">
            <div>
                <TextInput v-model="form.email" type="email" label="Email" placeholder="Email" />
                <InputError class="mt-2" :message="'Debe agregar un Email valido'" />
            </div>

            <div class="mt-4">
                <TextInput v-model="form.password" type="password" label="Password" placeholder="Password" />
                <InputError class="mt-2" :message="'Contraseña Incorrecta'" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <div class="block mt-4">
                    <label class="flex items-center" style="cursor: pointer;" @click="registerUser">
                        <span class="ms-2 text-sm text-gray-600">Registrarme</span>
                    </label>
                </div>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                    @click="submitForm">
                    Log in
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template>
  
<script>
import { Head, useForm, router } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

export default {
    components: {
        Head,
        AuthenticationCard,
        AuthenticationCardLogo,
        InputError,
        InputLabel,
        PrimaryButton,
        TextInput,
    },
    props: {
        canResetPassword: Boolean,
        status: String,
    },
    setup() {
        const form = useForm({
            email: '',
            password: '',
        });


        const submitForm = () => {
            form.transform((data) => ({
                ...data,
            })).post(route('login'), {
                onFinish: () => form.reset('password'),
            });
        };

        const registerUser = () => {
            router.get(route('register'));

        };

        return {
            form,
            submitForm,
            registerUser
        };
    },
};
</script>

<style scoped>
.login-container {
    display: grid;
    grid-template-columns: 50% 50%;
    height: 100vh;
    width: 100vw;
}

.vertical-center {
    color: rgb(27, 90, 141);
    background: rgb(88, 240, 194);
    display: flex;
    justify-content: center;
    align-items: center;
}

.logo-container {
    background-color: #ffffff;
}

.logo-container img {
    max-width: 300px;
}

.btn-primary {
    background-color: #003489;
    border: #003489;
}

a {
    color: #003489;
}

@media (max-width: 575.98px) {
    .login-container {
        grid-template-columns: 100%;
    }

    .logo-container {
        display: none;
    }
}
</style>