<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import Tooltip from '@/Components/Tooltip.vue';

const props = defineProps({
    employees: Object
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
                            <tr v-for="emp in employees.data" :key="emp.id" class="bg-white hover:bg-gray-50">
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
                                    <Link id="edit-button" :href="`/employees/edit/${emp.id}`" data-tool-tip="Edit" class="w-8 h-8 flex justify-center items-center hover:bg-gray-200 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
#edit-button[data-tool-tip] {
    position: relative;
}

#edit-button[data-tool-tip]::before {
    content: attr(data-tool-tip);
    display: block;
    position: absolute;
    background-color: #374151;
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: .8em;
    bottom: 100%;
    left: 50%;
    white-space: nowrap;
    transform: scale(0);
    transition: transform ease-out 150ms;
}

#edit-button[data-tool-tip]:hover::before {
    transform: scale(1);
}
</style>