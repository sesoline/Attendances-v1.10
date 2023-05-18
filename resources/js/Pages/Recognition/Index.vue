<template>
    <userPanel>
        <template v-slot:Main>
            <div class="flex-col w-full content-center justify-center">

                    <!-- Select Classroom -->
                    
                    <div>
                        <selectClassroom v-if="myStatus=='01'" v-bind:classrooms="classrooms" @on_change="on_change" />
                    </div>
                    <!-- End Select Classroom -->
                    <!-- {{ allMembers }}
                    .
                    .
                    .
                    . -->
                    eeeeeeeeeeste es el esttado: {{ myStatus }}
                    <!-- Camera  -->
                    <cameraTool v-if="myStatus=='02'"></cameraTool>
                    <createDescriptors v-bind:membersOff="membersOFF" v-if="myStatus=='03'"></createDescriptors>
                    
            </div>
        </template>
        
    </userPanel>
</template>


<script>

import userPanel from '@/Layouts/userPanel.vue'
import selectClassroom from '@/Components/selectClassroom2.vue'
import cameraTool from '@/Components/Camera.vue'
import createDescriptors from './createDescriptors.vue'
import axios from 'axios'
//import {readPhotos, createDescriptor } from '@/faceID.js'

import { Link } from '@inertiajs/inertia-vue3'


export default {
    components: {userPanel, selectClassroom, cameraTool, createDescriptors, Link},

    data() {
        return {
            myStatus: '01',
            allMembers: [],
            membersOFF: [],
            myToken: null,
        }
    },
    
    props: {
        classrooms: Array,
        members: Array,
        state: String,
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
            
            //this.$inertia.post(window.location.origin + '/Students/getDescriptors/',{classroomID})

console.log(classroomID)


            // Let's do an AJAX POST to DB throught AXIOS
            axios.post('/Students/getDescriptors/', {classroomID: classroomID})
            .then(response => {

                // Manejo de la respuesta exitosa del servidor
                this.allMembers = response.data
                this.allMembers.forEach(element =>{
                    if(element.faceDescriptor == null){
                        this.membersOFF.push(element)
                    }
                    this.myStatus='03'
                })

                //console.log(this.state,this.membersOFF)

                // Update face descriptors
                // getting images
                //readPhotos()


                
                
            })
            .catch(error => {
                // Manejo del error en caso de que la solicitud falle
                console.log(error,'error')
            });
        



        },
    },

    beforeCreate(){
        this.myStatus = true
    },

    mounted(){
        if(this.state=='02'){
            console.log(this.member,'muestre')
        }



    },


}

</script>