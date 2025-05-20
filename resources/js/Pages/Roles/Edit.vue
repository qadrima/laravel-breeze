<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import SidebarLayout from '@/Layouts/SidebarLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Checkbox from '@/Components/Checkbox.vue';
import PrimaryLink from '@/Components/PrimaryLink.vue';

const props = defineProps({
    role: Object,
    permissions: Array,
    rolePermissions: Array
});

const form = useForm({
    name: props.role.name,
    description: props.role.description,
    permissions: props.rolePermissions || []
});

const submit = () => {
    form.put(route('roles.update', props.role.id));
};
</script>

<template>
    <Head title="Edit Role" />

    <SidebarLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Role</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submit" class="space-y-6">
                            <div>
                                <InputLabel for="name" value="Name" />
                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                    required
                                    autofocus
                                />
                                <InputError :message="form.errors.name" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel value="Permissions" />
                                <div class="mt-2 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    <div v-for="permission in permissions" :key="permission.id" class="flex items-center">
                                        <Checkbox
                                            :id="`permission-${permission.id}`"
                                            :value="permission.id"
                                            v-model:checked="form.permissions"
                                            class="mr-2"
                                        />
                                        <label :for="`permission-${permission.id}`" class="text-sm text-gray-700">
                                            {{ permission.name }}
                                        </label>
                                    </div>
                                </div>
                                <InputError :message="form.errors.permissions" class="mt-2" />
                            </div>

                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="form.processing">Update Role</PrimaryButton>
                                <PrimaryLink :href="route('roles.index')">Cancel</PrimaryLink>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </SidebarLayout>
</template> 