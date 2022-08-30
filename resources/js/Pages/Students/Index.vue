<template>
    <div>
        <userPanel>
            <template v-slot:Main>
                <div class="flex-col">

                <div class="flex flex-1  flex-col md:flex-row lg:flex-row mx-2">
                    <!--Horizontal form-->
                    <div class="mb-2 border-solid border-grey-light rounded border shadow-sm w-full md:w-full lg:w-full">
                        <div class="flex flex-row justify-between content-end bg-gray-300 px-2 py-3 border-solid border-gray-400 border-b">
                            <div class="py-2 px-4 ">Students</div>
                            <div>
                                <Link type="Button" :href="route('students.create')" 
                                class="bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded " >
                                    Create Student
                                </Link>
                            </div>
                            
                        </div>
                        
                        <div class="p-3">
                            <table class="table-fixed">
                                <thead>
                                <tr>
                                    <th class="border w-1/16 px-4 py-2"> No. </th>
                                    <th class="border w-1/4 px-4 py-2"> Last Name </th>
                                    <th class="border w-1/4 px-4 py-2"> First Name </th>
                                    <th class="border w-1/4 px-4 py-2"> Telephone </th>                                
                                    <th class="border w-1/4 px-4 py-2"> email </th>
                                    <th class="border w-1/8 px-4 py-2 justify-center"> Foto </th>
                                    <th class="border w-1/2 px-4 py-2"> Options </th>
                                </tr>
                                </thead>
                                <tbody>                                                                        
                                        <tr class="text-sm" v-for="(Student, index) in DBdata" :key="Student.id">
                                            <td class="border px-1 py-1"> {{index}} </td>  
                                            <td class="border px-1 py-1">{{ Student.LastName }}</td>                                        
                                            <td class="border px-1 py-1">{{ Student.FirstName}}</td>
                                            <td class="border px-1 py-1">{{ Student.Telephone}}</td>                                            
                                            <td class="border px-1 py-1">{{ Student.email}}</td>
                                            <td class="border px-1 py-1 ">
                                                <img class="" :src="'images/Juli.png'" :alt="Student.FirstName" width="30" > 
                                            </td>

                                            <td class="border px-4 py-2">
                                                <Link :href="route('students.edit',Student.id)" method="GET" > 
                                                    Edit 
                                                </Link>
                                                    | 
                                                <!-- This is another option if i dont want an alert message:

                                                    <Link :href="route('students.destroy',Student.id)" method="DELETE" as="button" > 
                                                        Borrar 
                                                    </Link> 
                                                    
                                                -->
                                                <a href="#" @click.prevent="destroy(Student.id)">
                                                   Delete 
                                                </a>
                                            </td>
                                        </tr>                                                                                                                                       
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--/Horizontal form-->                    
                </div>
                </div>
            </template>
        </userPanel>
    </div>
</template>

<script>

import userPanel from '@/Layouts/userPanel.vue'
import { Method } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3'


export default {
    components: {userPanel, Link},

    props: {
        DBdata: Array,
    },

    methods: {
        destroy(id) {
            
            if(confirm('Are you sure?')){
                this.$inertia.delete(this.route('students.destroy',id))
            }
        }
    },
    
}

</script>