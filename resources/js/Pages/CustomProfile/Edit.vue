<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    userInfo: Object,
    credentials: Object
});

const form = useForm({
    _method: 'PATCH',
    fname: props.userInfo.fname,
    mname: props.userInfo.mname,
    lname: props.userInfo.lname,
    address: props.userInfo.address,
    photo: null,
});

const photoInput = ref(null);
const photoPreview = ref(null);
const photoValidationErrorMessage = ref('');

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {

    const photo = photoInput.value.files[0];

    if (! photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        // photoPreview.value = e.target.result;

        const img = new Image();
        img.src = e.target.result;

        img.onload = () => {
            // Check if the image is square
            if (img.width === img.height) {
                // Update the photo preview only if it's a square image
                photoPreview.value = e.target.result;
            } else {
                // Handle the case when the image is not square
                photoValidationErrorMessage.value = "The image aspect ratio must be 1:1.";
                // You can also clear the input or take other appropriate actions.
                photoInput.value = null;
                photoPreview.value = null;
            }
        };
    };

    reader.readAsDataURL(photo);
}

const deletePhoto = () => {
    router.delete(route('current-user-photo.destroy'), {
        preserveScroll: true,
        onSuccess: () => {
            photoPreview.value = null;
            clearPhotoFileInput();
        },
    });
};

const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};

const updateProfileInformation = () => {
    if (photoInput.value) {
        form.photo = photoInput.value.files[0];
    }

    form.post('/profile', {
        preserveScroll: true,
        onSuccess: () => clearPhotoFileInput(),
    });
};


</script>

<template>
    <Head title="My Profile" />
    <AppLayout>
        <div class="py-12">
            <div class="w-full px-12">
                <h1 class="text-2xl text-gray-700 font-bold">My Profile</h1>
                <p class="text-sm text-gray-500">Update your photo and personal details here.</p>

                <div class="flex-col divide-y divide-gray-300 mt-4 mb-4">
                    <div class="flex items-start space-x-4 p-4">
                        <div class="w-[300px]">
                            <h4 class="text-md font-semibold text-gray-700">Your Photo</h4>
                        </div>

                        <div class="w-[576px]">
                            <div class="z-0 relative rounded-full w-[200px] h-[200px] overflow-hidden">
                                <img :src="userInfo.profile_photo_path_url" alt="user-photo" class="object-cover h-full w-full">

                                <input
                                id="userphoto"
                                ref="photoInput"
                                type="file"
                                class="hidden"
                                @change="updatePhotoPreview"
                                >
                                <button type="button" @click="selectNewPhoto" class="absolute z-10 top-1/2 transform -translate-y-1/2 bg-gray-600 hover:bg-gray-500 h-9 w-[120px] flex justify-center items-center text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                        <path d="M12 9a3.75 3.75 0 1 0 0 7.5A3.75 3.75 0 0 0 12 9Z" />
                                        <path fill-rule="evenodd" d="M9.344 3.071a49.52 49.52 0 0 1 5.312 0c.967.052 1.83.585 2.332 1.39l.821 1.317c.24.383.645.643 1.11.71.386.054.77.113 1.152.177 1.432.239 2.429 1.493 2.429 2.909V18a3 3 0 0 1-3 3h-15a3 3 0 0 1-3-3V9.574c0-1.416.997-2.67 2.429-2.909.382-.064.766-.123 1.151-.178a1.56 1.56 0 0 0 1.11-.71l.822-1.315a2.942 2.942 0 0 1 2.332-1.39ZM6.75 12.75a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0Zm12-1.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                            <!-- <div class="relative mb-2 rounded-full w-[200px] h-[200px] overflow-hidden">

                                <div v-if="userInfo.profile_photo_path" class="mt-2">
                                    <img v-show="!photoPreview" :src="userInfo.profile_photo_path_url" alt="user-photo" class="rounded-full w-[200px] h-[200px]">

                                    <img v-show="photoPreview" :src="photoPreview" alt="user-photo" class="rounded-full w-[200px] h-[200px]">
                                </div>

                                <div v-else class="mt-2">
                                    <img v-show="!photoPreview" src="https://www.svgrepo.com/show/382095/female-avatar-girl-face-woman-user-4.svg" class="rounded-full w-[200px] h-[200px]" alt="user-photo">
                                    <img v-show="photoPreview" :src="photoPreview" alt="user-photo" class="rounded-full w-[200px] h-[200px]">
                                </div>

                                <input
                                id="userphoto"
                                ref="photoInput"
                                type="file"
                                class="hidden"
                                @change="updatePhotoPreview"
                                >
                                <button type="button" @click="selectNewPhoto" class="absolute bottom-[25px] right-[15px] bg-gray-600 hover:bg-gray-500 h-9 w-9 flex justify-center items-center rounded-full text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                        <path d="M12 9a3.75 3.75 0 1 0 0 7.5A3.75 3.75 0 0 0 12 9Z" />
                                        <path fill-rule="evenodd" d="M9.344 3.071a49.52 49.52 0 0 1 5.312 0c.967.052 1.83.585 2.332 1.39l.821 1.317c.24.383.645.643 1.11.71.386.054.77.113 1.152.177 1.432.239 2.429 1.493 2.429 2.909V18a3 3 0 0 1-3 3h-15a3 3 0 0 1-3-3V9.574c0-1.416.997-2.67 2.429-2.909.382-.064.766-.123 1.151-.178a1.56 1.56 0 0 0 1.11-.71l.822-1.315a2.942 2.942 0 0 1 2.332-1.39ZM6.75 12.75a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0Zm12-1.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div> -->

                            <InputError :message="photoValidationErrorMessage" />
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 p-4">
                        <div class="w-[300px]">
                            <h4 class="text-md font-semibold text-gray-700">Employee Information</h4>
                        </div>
                        <div class="w-[576px]">

                            <div class="mb-4 w-full">
                                <InputLabel
                                for="id_no"
                                value="ID no"
                                class="font-medium text-md"
                                />

                                <TextInput
                                id="id_no"
                                type="text"
                                v-model="props.userInfo.id_no"
                                class="w-full"
                                disabled
                                />
                            </div>

                            <div class="mb-4 w-full">
                                <InputLabel
                                for="emp_type"
                                value="Employee Type"
                                class="font-medium text-md"
                                />

                                <TextInput
                                id="emp_type"
                                type="text"
                                v-model="props.userInfo.emp_type"
                                class="w-full"
                                disabled
                                />
                            </div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4 p-4">
                        <div class="w-[300px]">
                            <h4 class="text-md font-semibold text-gray-700">Personal Details</h4>
                        </div>
                        <div class="w-[576px]">

                            <div class="mb-4 w-full">
                                <InputLabel
                                for="fname"
                                value="First name"
                                class="font-medium text-md"
                                />

                                <TextInput
                                id="fname"
                                v-model="form.fname"
                                class="w-full"
                                />
                            </div>

                            <div class="mb-4 w-full">
                                <InputLabel
                                for="mname"
                                value="Middle name"
                                class="font-medium text-md"
                                />

                                <TextInput
                                id="mname"
                                v-model="form.mname"
                                class="w-full"
                                />
                            </div>

                            <div class="mb-4 w-full">
                                <InputLabel
                                for="lname"
                                value="Last name"
                                class="font-medium text-md"
                                />

                                <TextInput
                                id="lname"
                                v-model="form.lname"
                                class="w-full"
                                />
                            </div>

                            <div class="mb-4 w-full">
                                <InputLabel
                                for="address"
                                value="Address"
                                class="font-medium text-md"
                                />

                                <TextInput
                                id="address"
                                v-model="form.address"
                                class="w-full"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" @click.prevent="updateProfileInformation" class="px-4 py-2 rounded-md text-sm text-white font-medium bg-blue-600 hover:bg-blue-500">Save changes</button>
            </div>
        </div>
    </AppLayout>
</template>
