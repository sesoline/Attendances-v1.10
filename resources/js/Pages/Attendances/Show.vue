<template>
    <div>
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
                                    <th class="border w-1/16 px-4 py-2 text-center"> No. </th>
                                    <th class="border w-1/4 px-4 py-2 text-center"> Full Name </th>
                                    <th class="border w-1/4 px-4 py-2 text-center"> Telephone </th>
                                    <th class="border w-1/8 px-4 py-2 text-center"> Classes </th>
                                    <th class="border w-1/8 px-4 py-2 text-center"> Missed </th>                                
                                    <th class="border w-1/8 px-4 py-2 text-center"> Excused </th>
                                    <th class="border w-1/8 px-4 py-2 text-center"> Foto </th>
                                    <th class="border w-1/8 px-4 py-2 text-center"> Details </th>
                                </tr>
                                </thead>
                                <tbody>                                                                        
                                        <tr class="text-sm" v-for="(filteredStudent, index) in filteredStudents" :key="filteredStudent.id">
                                            <td class="border px-1 py-1 text-center"> {{ index}} </td>  
                                            <td class="border px-1 py-1 text-center">{{ filteredStudent.LastName}} {{filteredStudent.FirstName }}</td>                                        
                                            <td class="border px-1 py-1 text-center">{{ filteredStudent.Telephone}}</td>
                                            <td class="border px-1 py-1 text-center">{{ filteredStudent.total_days}}</td>
                                            <td class="border px-1 py-1 text-center">{{ filteredStudent.total_days - filteredStudent.total_Attended}}</td>                                            
                                            <td class="border px-1 py-1 text-center">{{ filteredStudent.total_Excused}}</td>
                                            <td class="border px-1 py-1 place-content-center">
                                                <img class="mx-auto" :src="url(filteredStudent.Photo)" :alt="filteredStudent.FirstName" width="30" > 
                                            </td>
                                            <td class="border px-1 py-1 text-center"> See </td>
                                            
                                        </tr>                                                                                                                                       
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--/Horizontal form-->                    
                </div>
                </div>
    </div>
</template>

<script>


import { Link } from '@inertiajs/inertia-vue3'


export default {
    components: {Link},

    props: {
        filteredStudents: Array,
    },

    methods: {
        destroy(id) {
            
            if(confirm('Are you sure?')){
                this.$inertia.delete(this.route('students.destroy',id))
            }
        },

        url(url) {
            return window.location.origin + '/storage/' + url      
        },
    },


    
}

</script>