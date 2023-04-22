<template>
    <div>
        <userPanel>
            <template v-slot:Main>
                <div class="flex-col">
                    <div class="md:flex md:items-center mb-6 py-3 px-4 pr-8 ">
                        <div class="">
                            <label class="block text-gray-500 font-regular md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                                Please, select classroom: 
                            </label>
                        </div>
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <div class="relative">                                                                                                                           
                                <select  class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                id="SalonSelect" @change="showTable">
                                    <option></option>
                                    <option v-for="classroom in classrooms" :key="classroom.id" :value="classroom.id"> 
                                        {{ classroom.ClassName}} - {{classroom.Details}}
                                    </option>
                                </select>                            
                            </div>
                        </div>                        
                    </div>
                    
                    <!-- <slot></slot>     -->
                    <showTables v-if="filteredStudents"  v-model:filteredStudents="filteredStudents"></showTables>
                </div>
            </template>
        </userPanel>
    </div>
</template>

<script>

import userPanel from '@/Layouts/userPanel.vue'
import showTables from '@/Pages/Attendances/Show.vue'
import { Link } from '@inertiajs/inertia-vue3'


export default {
    components: {userPanel, showTables, Link},

    data() {
        return {
            
        }
    },

    props: {
        classrooms: Array,
        filteredStudents: Array,      
    },

    methods: {

        showTable() {       
            // Go to attenances/classroom.id to get attendance list of classroom selected
            console.log('perro', this.classrooms[document.getElementById("SalonSelect").value-1])
            this.$inertia.get(window.location.origin + '/attendances/'+this.classrooms[document.getElementById("SalonSelect").value-1].id,{},{ preserveState: true })
        },
    },
    
}
</script>