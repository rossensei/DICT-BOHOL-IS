<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    employees: Array
})
</script>

<template>
    <Head title="Employees" />
    <AppLayout>
        <div class="py-12">
            <div class="w-full px-12">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl text-gray-700 font-bold">Manage Employees</h1>
                        <p class="text-sm text-gray-500 mb-4">Ensure your account is using a long, random password to stay secure.</p>
                    </div>

                    <Link href="/employees/create" class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-sm text-white font-medium rounded-md">Add Employee</Link>
                </div>

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
                                   <p class="flex items-center justify-center ms-6">{{ `${emp.fname} ${emp.mname[0]}. ${emp.lname}` }}</p>
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
                                    <!-- <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a> -->
                                    <div
                                    class="
                                    relative
                                    before:absolute
                                    before:content-[attr(data-tip)]
                                    before:px-3 before:py-2
                                    before:left-1/2 before:-top-3
                                    before:w-max before:max-w-xs
                                    before:-translate-x-1/2 before:-translate-y-full
                                    before:bg-gray-700 before:text-white
                                    before:rounded-md before:opacity-0
                                    before:transition-all

                                    after:absolute
                                    after:left-1/2 after:-top-3
                                    after:h-0 after:w-0
                                    after:-translate-x-1/2 after:border-8
                                    after:border-t-gray-700
                                    after:border-l-transparent
                                    after:border-b-transparent
                                    after:border-r-transparent
                                    after:opacity-0
                                    after:transition-all

                                    hover:before:opacity-100 hover:after:opacity-100
                                    "
                                    data-tip="Edit"
                                    >
                                        <Link :href="`/employees/edit/${emp.id}`" class="w-8 h-8 flex justify-center items-center hover:bg-gray-200 rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg>
                                        </Link>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>