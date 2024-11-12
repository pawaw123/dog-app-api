<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({ breeds: Object, dogs: Object, breed: String })

// const form = useForm({
//   url: "",
//   breed: "",
// });

const submit = (url, breed) => {
    const form = useForm({
        url: url,
        breed: breed,
    });
  form.post("/dogs/add-to-favorite");
};
</script>
<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dogs
            </h2>
        </template>

        <div class="py-12 text-gray-800">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 flex justify-between">
                <div class="w-96 bg-white shadow-sm sm:rounded-lg mx-2">
                    <div class="p-6">
                        <div class="font-semibold text-xl">Breeds</div>

                        <div class="my-6">
                            <div v-for="(value, name, index) in breeds">
                                <div class="my-2">
                                    <a :href="'list?breed=' + name">
                                        <button class="w-full p-2 rounded-md bg-blue-200 hover:bg-blue-300">{{ name[0].toUpperCase() + name.slice(1) }}</button>
                                    </a>
                                    <div v-if="value.length > 0" class="ml-8 my-1">
                                        <label class="text-sm font-medium">Sub-breed</label>
                                        <div class="my-1" v-for="sub in value">
                                            <a :href="'list?breed=' + sub">
                                                <button class="w-full p-2 rounded-md bg-blue-200 hover:bg-blue-300">{{ sub[0].toUpperCase() + sub.slice(1) }}</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6" v-if="breed != null">

                        <div class="mb-10 mt-4">
                            <div class="italic text-gray-400">Selected breed:</div>
                            <div class="indent-5 font-semibold text-2xl">
                                {{ breed[0].toUpperCase() + breed.slice(1) }}
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <div v-for="dog in dogs" class="w-64 rounded-lg border-4 border-blue-600 shadow-lg p-2 mx-auto">
                                <img :src="dog" :alt="dog" class="w-96 h-48 object-contain mx-auto my-2">
                                <form @submit.prevent="submit(dog, breed)">
                                    <!-- <input name="url" v-model="form.url" type="hidden" :value="{{ dog }}"/>
                                    <input name="breed" v-model="form.breed" type="hidden"/> -->

                                    <button type="submit" class="p-2 w-full bg-gray-200 rounded-lg hover:bg-gray-300"><i class="fa-regular fa-star"></i> Add to Favorite</button>
                                </form>
                            </div>
                        </div>
                        <!-- <div v-for="dog in dogs">
                            <div class="w-64 rounded-lg border-4 border-blue-600 shadow-lg p-2">
                                <img :src="dog" alt="" class="w-auto mx-auto my-2">
                                <button class="p-2 w-full bg-gray-200 rounded-lg hover:bg-gray-300"><i class="fa-regular fa-star"></i> Add to Favorite</button>
                            </div>
                        </div> -->
                    </div>
                    <div class="p-6" v-else>
                        <div class="w-full text-center text-xl italic">Please select breed first! Thank you!</div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
