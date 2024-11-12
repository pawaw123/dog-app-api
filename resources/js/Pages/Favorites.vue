<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({ favorites: Object })

const submit = (id) => {
    const form = useForm({
        favorite: id,
    });

    form.get("/dogs/remove-to-favorite");
};
</script>
<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Favorites
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="grid grid-cols-4 gap-4 p-4">
                        <div v-for="favorite in favorites" class="w-64 rounded-lg border-4 border-blue-600 shadow-lg p-2 mx-auto">
                            <img :src="favorite.image_url" :alt="favorite.image_url" class="w-96 h-48 object-contain mx-auto my-2">
                            <div class="text-xl">Liked by: {{ favorite.user }}</div>
                            <form @submit.prevent="submit(favorite.id)">
                                <!-- <button type="submit" class="p-2 w-full bg-red-300 rounded-lg hover:bg-red-400"><i class="fa-solid fa-star"></i> Remove to Favorite</button> -->
                                <button type="submit" class="p-2 w-full bg-gray-200 rounded-lg hover:bg-gray-300"><i class="fa-solid fa-pen-to-square"></i> Edit Dog Information</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
