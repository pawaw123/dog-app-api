<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({ favorite: Object })
const form = useForm({});

const deleteFavorite = (id) => {
    form.delete(`/dogs/favorite/${id}/delete`);
};

</script>
<template>
    <Head title="Edit Favorite" />
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Favorites | {{ favorite.id }}
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-4 ">
                        <img :src="favorite.image_url" :alt="favorite.image_url" class="w-auto object-contain mx-auto my-2 p-4 border-2">
                        <div class="text-xl">Liked by: <span class="font-semibold">{{ favorite.user.name }}</span></div>
                        <div class="w-full text-center my-4">
                            <button @click="deleteFavorite(favorite.id)" class="p-2 w-96 bg-red-200 rounded-lg hover:bg-red-300"><i class="fa-solid fa-trash"></i> Remove</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
