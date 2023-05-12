<template>
    <userPanel>
        <template v-slot:Main>
            <div class="flex w-full content-center justify-center">

                    <!-- Select Classroom -->
                    
                    <div>
                        <selectClassroom v-if="myStatus" v-bind:classrooms="classrooms" @on_change="on_change" />
                    </div>
                    <!-- End Select Classroom -->
                    {{ members }}
                    <!-- Camera  -->
                    <cameraTool v-if="myStatus==false"></cameraTool>
                    
            </div>
        </template>
        
    </userPanel>
</template>


<script>

import userPanel from '@/Layouts/userPanel.vue'
import selectClassroom from '@/Components/selectClassroom2.vue'
import cameraTool from '@/Components/Camera.vue'

import { Link } from '@inertiajs/inertia-vue3'


export default {
    components: {userPanel, selectClassroom, cameraTool, Link},

    data() {
        return {
            myStatus: true,
            myMembers: null,
            myToken: null,
        }
    },
    
    props: {
        classrooms: Array,
        members: Array,
    },

    methods: {
    

        on_change(classroomID){

            
            
            // 1. Debor sacar el descriptor de cada estudiante
            // 2. debo ir a la base de datos, tomar los descriptores de lso estudiantes y colocarlos en el salon
            
            // al seleccionar el salon el sistema revice los descriptores de los estudiantes
            //   Como lo revisa:
            //      1. recorre los alumnos del salon, mirando el campo descriptor
            //      2. si el campo es null entonces procede a crear el descriptor
            //      3. Si no hay foto para crear el descriptor, debe arrojar un mensaje al usuario indicando el proble,a


            this.$inertia.post(window.location.origin + '/Students/getDescriptors/',{classroomID},{ preserveState: true })


            //console.log(classroomID,this.members, response, 'sfsf', this.myMembers,'sssse')





            this.myStatus = false

            

        },
    },

    beforeCreate(){
        this.myStatus = true
    },

    updated(){
        
        this.myToken = document.head.querySelector('meta[name="csrf-token"]').content
        console.log(this.myToken,'el token perro')


    },
    
}

</script>