<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { router } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import { ref, onMounted } from 'vue';

const props = defineProps({
    users: Object,
    perPage: Number,
    perPageOptions: Array,
});

const currentPerPage = ref(props.perPage);

onMounted(() => {
    currentPerPage.value = props.perPage;
});

const deleteUser = (id) => {
    if (confirm('Are you sure you want to delete this user?')) {
        router.delete(route('users.destroy', id));
    }
};

const changePerPage = () => {
    router.get(route('users.index'), {
        perPage: currentPerPage.value
    }, {
        preserveState: true,
        replace: true
    });
};
</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
                <Link
                    :href="route('users.create')"
                    class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700"
                >
                    Add User
                </Link>
            </div>
        </template>

        <div class="sm:py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="text-gray-900">
                        <div class="p-4 flex">
                            <div class="flex items-center">
                                <label for="perPage" class="mr-2 text-sm text-gray-600">Show:</label>
                                <select 
                                    id="perPage" 
                                    v-model="currentPerPage" 
                                    @change="changePerPage" 
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm"
                                >
                                    <option v-for="option in perPageOptions" :key="option" :value="option">
                                        {{ option }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="overflow-x-auto bg-white">
                            <table class="min-w-full divide-y divide-gray-200 text-sm">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                                        <th scope="col" class="px-6 py-3 text-left font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                                        <th scope="col" class="px-6 py-3 text-left font-semibold text-gray-600 uppercase tracking-wider">Role</th>
                                        <th scope="col" class="px-6 py-3 text-left font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    <tr
                                        v-for="user in users.data"
                                        :key="user.id"
                                        class="hover:bg-gray-50 transition-colors"
                                    >
                                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-800">
                                            {{ user.name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                                            {{ user.email }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                v-for="role in user.roles"
                                                :key="role.id"
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mr-1"
                                            >
                                                {{ role.name }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            <Link
                                                :href="route('users.edit', user.id)"
                                                class="text-indigo-600 hover:text-indigo-800 font-medium mr-4"
                                            >
                                                Edit
                                            </Link>
                                            <button
                                                @click="deleteUser(user.id)"
                                                class="text-red-600 hover:text-red-800 font-medium"
                                            >
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="my-10 p-3">
                            <Pagination :links="users.links" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template> 