<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    employees: Array
})
</script>

<template>
    <Head title="Employees" />
    <AppLayout>
        <div class="py-12">
            <div class="w-full px-12">
                <h1 class="text-2xl text-gray-700 font-bold">Manage Employees</h1>
                <p class="text-sm text-gray-500 mb-4">Ensure your account is using a long, random password to stay secure.</p>

                <div class="relative overflow-hidden overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ID NO
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Employee Type
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Address
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Role
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="emp in employees" :key="emp.id" class="bg-white hover:bg-gray-50">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    {{ emp.id_no }}
                                </th>
                                <td class="px-6 py-4 flex items-center">
                                    <img v-show="emp.profile_photo_path" :src="emp.profile_photo_path_url" class="rounded-full w-14 h-14" alt="profile pic">
                                    <img v-show="!emp.profile_photo_path" src="https://i.mydramalist.com/QJ082Y_5c.jpg" class="rounded-full w-14 h-14" alt="profile pic">
                                   <p class="flex items-center justify-center ms-6">{{ `${emp.fname} ${emp.mname} ${emp.lname}` }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    {{ emp.emp_type }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ emp.address }}
                                </td>
                                <td class="px-6 py-4">
                                    Administrator
                                </td>
                                <td class="px-6 py-4">
                                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>