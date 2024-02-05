<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    photo: null,
    fname: '', 
    mname: '', 
    lname: '',
    address: '', 
    id_no: '',
    emp_type: '', 
    status: '',
    role: ''
})
</script>

<template>
    <Head title="New Employee" />

    <AppLayout>
        <div class="py-12">
            <div class="w-full px-12">
                <h1 class="text-2xl text-gray-700 font-bold">Create new employee</h1>
                <p class="text-sm text-gray-500 mb-8">Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus maxime perferendis culpa accusantium expedita nam consequatur aspernatur sequi ullam.</p>
                <!-- <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/fnames/helene-engels.png" alt="" class="rounded-full w-20"> -->
                
                <!-- <h1 class="text-lg font-semibold text-gray-700">General Information</h1> -->
                <div class="max-w-4xl w-full">
                    <div class="flex items-start space-x-3 mb-4">
                        <InputLabel for="id_no" value="ID no." class="shrink-0 w-[150px]" />

                        <TextInput
                        id="id_no"
                        v-model="form.id_no"
                        type="number"
                        class="w-full"
                        />
                        <InputError :message="form.errors.id_no" />
                    </div>
                    <div class="flex items-start space-x-3 mb-4">
                        <InputLabel for="fname" value="First name" class="shrink-0 w-[150px]" />

                        <TextInput
                        id="fname"
                        v-model="form.fname"
                        type="text"
                        class="w-full "
                        />
                        <InputError :message="form.errors.fname" />
                    </div>
                    <div class="flex items-start space-x-3 mb-4">
                        <InputLabel for="mname" value="Middle name" class="shrink-0 w-[150px]" />

                        <TextInput
                        id="mname"
                        v-model="form.mname"
                        type="text"
                        class="w-full "
                        />
                        <InputError :message="form.errors.mname" />
                    </div>
                    <div class="flex items-start space-x-3 mb-4">
                        <InputLabel for="lname" value="Last name" class="shrink-0 w-[150px]" />

                        <TextInput
                        id="lname"
                        v-model="form.lname"
                        type="text"
                        class="w-full "
                        />
                        <InputError :message="form.errors.lname" />
                    </div>
                    <div class="flex items-start space-x-3 mb-4">
                        <InputLabel for="address" value="Address" class="shrink-0 w-[150px]" />

                        <TextInput
                        id="address"
                        v-model="form.address"
                        type="text"
                        class="w-full "
                        />
                        <InputError :message="form.errors.address" />
                    </div>

                    <div class="flex items-start space-x-3 mb-4">
                        <InputLabel for="emp_type" value="Employee Type" class="shrink-0 w-[150px]" />

                        <select v-model="form.emp_type" id="emp_type" class="w-full rounded-lg border-gray-300">
                            <option value="">Select type</option>
                            <option value="">Plantilla</option>
                            <option value="">Contract of Service</option>
                        </select>
                        <InputError :message="form.errors.emp_type" />
                    </div>

                    <div class="flex items-start space-x-3 mb-4">
                        <InputLabel for="status" value="Status" class="shrink-0 w-[150px]" />

                        <select v-model="form.status" id="status" class="w-full rounded-lg border-gray-300">
                            <option value="">Select status</option>
                            <option value="">Active</option>
                            <option value="">Inactive</option>
                        </select>
                        <InputError :message="form.errors.status" />
                    </div>

                    <div class="flex items-start space-x-3 mb-4">
                        <!-- <InputLabel for="role" value="Role" class="shrink-0 w-[150px]" /> -->
                        <p class="shrink-0 w-[150px]">Role</p>

                        <!-- <select v-model="form.role" id="role" class="w-full rounded-lg border-gray-300">
                            <option value="">Select role</option>
                            <option value="">Active</option>
                            <option value="">Inactive</option>
                        </select> -->
                        <div class="flex">
                            <div class="flex items-center me-4">
                                <TextInput id="admin" name="role" value="Administrator" type="radio" />
                                <InputLabel v-model="form.role" for="admin" value="Administrator" />
                            </div>
                            <div class="flex items-center me-4">
                                <TextInput id="user" name="role" value="User" type="radio" />
                                <InputLabel v-model="form.role" for="user" value="User" />
                            </div>
                        </div>
                        <InputError :message="form.errors.role" />
                    </div>
                    
                </div>

            </div>
        </div>
    </AppLayout>
</template>