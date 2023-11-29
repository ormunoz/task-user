<template>
    <FormSection @submitted="updateProfileInformation">
        <template #title>
            Informacion de Usuario
        </template>

        <template #description>
            Puedes Actualizar el nombre de usuario o el email.
        </template>

        <template #form>
            <!-- Name -->
            <TextInput v-model="form.name" type="text" label="Nombre" placeholder="Nombre" />
            <InputError :message="form.errors.name" class="mt-2" />
            <!-- Email -->
            <div class="mb-3">
                <TextInput v-model="form.email" type="email" label="Email" placeholder="Email" />
                <InputError :message="form.errors.email" class="mt-2" />

                <div v-if="$page.props.jetstream.hasEmailVerification && user.email_verified_at === null">
                    <p class="text-sm mt-2">
                        Your email address is unverified.
                        <Link :href="route('verification.send')" method="post" class="btn btn-link"
                            @click.prevent="sendEmailVerification">
                        Click here to re-send the verification email.
                        </Link>
                    </p>
                </div>
            </div>
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="me-3">
                Saved.
            </ActionMessage>

            <PrimaryButton :class="{ 'disabled': form.processing }" :disabled="form.processing">
                Guardar
            </PrimaryButton>
        </template>
    </FormSection>
</template>
  
<script>
import { ref, defineComponent } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';


export default defineComponent({
    components: {
        ActionMessage,
        FormSection,
        InputError,
        PrimaryButton,
        TextInput,
        Link
    },
    props: {
        user: Object,
    },

    setup(props, { emit }) {
        const form = useForm({
            _method: 'PUT',
            name: props.user.name,
            email: props.user.email,
        });

        const updateProfileInformation = () => {
            form.post(route('user-profile-information.update'), {
                errorBag: 'updateProfileInformation',
                preserveScroll: true,
            });
        };

        return {
            form,
            updateProfileInformation
        }

    }
});
</script>
  