
<template>

    <FormSection @submitted="updatePassword">
        <template #title>
            Actualizar Contraseña
        </template>

        <template #description>
            Aquí puedes actualizar tu contraseña, debes ingresar la contraseña actual y luego la nueva, la contraseña como requisito debe
            tener minimo 8 caracteres.
        </template>

        <template #form>
            <TextInput v-model="form.current_password" type="password" label="Contraseña actual"
                placeholder="Contraseña actual" />
            <InputError class="mt-2" :message="form.errors.current_password" />

            <TextInput v-model="form.password" type="password" label="Nueva Contraseña" placeholder="Nueva Contraseña" />
            <InputError class="mt-2" :message="form.errors.password" />

            <TextInput v-model="form.password_confirmation" type="password" label="Repita Contraseña "
                placeholder="Repita Contraseña" />
            <InputError class="mt-2" :message="form.errors.password_confirmation" />
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="me-3 mt-3">
                Saved.
            </ActionMessage>

            <PrimaryButton :class="{ 'disabled': form.processing }" :disabled="form.processing">
                Guardar
            </PrimaryButton>
        </template>
    </FormSection>
</template>


<script >
import { ref, defineComponent } from 'vue';
import { useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

export default defineComponent({
    components: {
        ActionMessage,
        FormSection,
        InputError,
        InputLabel,
        PrimaryButton,
        TextInput,
    },

    setup() {
        const passwordInput = ref(null);
        const currentPasswordInput = ref(null);

        const form = useForm({
            current_password: '',
            password: '',
            password_confirmation: '',
        });

        const updatePassword = () => {
            form.put(route('user-password.update'), {
                errorBag: 'updatePassword',
                preserveScroll: true,
                onSuccess: () => form.reset(),
                onError: () => {
                    if (form.errors.password) {
                        form.reset('password', 'password_confirmation');
                        passwordInput.value.focus();
                    }

                    if (form.errors.current_password) {
                        form.reset('current_password');
                        currentPasswordInput.value.focus();
                    }
                },
            });
        };

        return {
            updatePassword,
            form
        }
    }

})

</script>
