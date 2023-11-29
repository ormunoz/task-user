<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <div class="container-fluid">
                <!-- Logo -->
                <div class="navbar-brand">
                    <Link :href="route('dashboard')">
                    <ApplicationMark class="block h-9 w-auto" />
                    </Link>
                </div>
                <!-- Navigation Links -->
                <div>
                    <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                        Menu
                    </NavLink>
                </div>

                <div class="collapse navbar-collapse">
                    <!-- Navigation Links -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                Menu
                            </NavLink>
                        </li>

                    </ul>

                </div>
                <!-- Settings Dropdown -->
                <div class="ms-3 relative">
                    <Dropdown align="right" width="48">
                        <template #trigger>
                            <span class="inline-flex rounded-md">
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                    {{ $page.props.auth.user.name }}

                                    <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            </span>
                        </template>

                        <template #content>
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                Configuracion
                            </div>
                            <DropdownLink :href="route('profile.show')">
                                Perfil
                            </DropdownLink>
                            <div class="border-t border-gray-200" />
                            <!-- Authentication -->
                            <form @submit.prevent="logout">
                                <DropdownLink as="button">
                                    Cerrar Sesion
                                </DropdownLink>
                            </form>
                        </template>
                    </Dropdown>
                </div>
            </div>
        </nav>
        <!-- Page Heading -->
        <header v-if="$slots.header" class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header" />
            </div>
        </header>

        <!-- Page Content -->
        <main>
            <slot />
        </main>
    </div>
</template>
  
<script>
import { ref, defineComponent } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';

export default defineComponent({
    components: {
        ApplicationMark,
        Dropdown,
        DropdownLink,
        NavLink,
        Link
    },
    setup(props, { emit }) {

        const switchToTeam = (team) => {
            router.put(route('current-team.update'), {
                team_id: team.id,
            }, {
                preserveState: false,
            });
        };

        const logout = () => {
            router.post(route('logout'));
        };

        return {
            switchToTeam,
            logout,
        }
    }
})

</script>
  