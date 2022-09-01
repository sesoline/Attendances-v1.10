<template>
    <div>
        <userPanel>
            <template v-slot:Main>
                <div class="flex-col">
                    
                    <div class="flex flex-1  flex-col md:flex-row lg:flex-row mx-2">
                    <!--Horizontal form-->
                    <div class="mb-2 border-solid border-grey-light rounded border shadow-sm w-full md:w-full lg:w-full">
                        <div class="flex flex-row justify-between content-end bg-gray-300 px-2 py-3 border-solid border-gray-400 border-b">
                            <div class="py-2 px-4 ">CLASSROOMS</div>
                            <div>
                                <Link type="Button" :href="route('classrooms.create')" 
                                class="bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded " >
                                    Create Classroom
                                </Link>
                            </div>
                            
                        </div>
                        
                        <div class="p-3">
                            <table class="table-fixed">
                                <thead>
                                <tr>
                                    <th class="border w-1/16 px-4 py-2 text-center"> Class </th>
                                    <th class="border w-1/4 px-4 py-2 text-center"> Details </th>
                                    <th class="border w-1/4 px-4 py-2 text-center"> Year </th>
                                    <th class="border w-1/8 px-4 py-2 text-center"> Owner </th>                                
                                    <th class="border w-1/4 px-4 py-2 text-center"> Owner Email </th>
                                    <th class="border w-1/8 px-4 py-2 text-center"> Owner Tel </th>
                                    <th class="border w-1/8 px-4 py-2 text-center"> Active </th>
                                    <th class="border w-1/2 px-4 py-2 text-center"> Options </th>
                                </tr>
                                </thead>
                                <tbody>                                                                        
                                        <tr class="text-sm" v-for="(classroom, index) in classrooms" :key="classroom.id">
                                            <td class="border px-1 py-1 text-center">{{ classroom.ClassName }} </td>
                                            <td class="border px-1 py-1 text-center">{{ classroom.Details }} </td>  
                                            <td class="border px-1 py-1 text-center">{{ classroom.Year }}</td>                                        
                                            <td class="border px-1 py-1 text-center">{{ classroom.Owner}}</td>
                                            <td class="border px-1 py-1 text-center">{{ classroom.OwnerEmail}}</td>                                            
                                            <td class="border px-1 py-1 text-center">{{ classroom.OwnerTel}}</td>
                                            <td class="border px-1 py-1 text-center">{{ classroom.Active}}</td>                                                                              
                                            <td class="border px-4 py-2 text-center">
                                                <Link :href="route('classrooms.edit',classroom.id)" method="GET" > 
                                                    Edit 
                                                </Link>
                                                    |                    
                                                <a href="#" @click.prevent="destroy(classroom.id)">
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

import { Link } from '@inertiajs/inertia-vue3'


export default {
    components: {userPanel, Link},

    props: {
        classrooms: Array,
    },

    methods: {
        destroy(id) {
            
            if(confirm('Are you sure?')){
                this.$inertia.delete(this.route('classrooms.destroy',id))
            }
        }
    },
    
}

</script>