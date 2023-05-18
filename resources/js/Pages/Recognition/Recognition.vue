<template>
    <userPanel>
        <template v-slot:Main>
            <div class="flex w-full content-center justify-center">
                    <!-- Camera  -->
                    <cameraTool></cameraTool>                    
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
            response: null,
            FD_Members: [],     // Members with faceDescriptors
            noFD_members: [],  // Members without faceDescriptors
        }
    },
    
    props: {
        members: Array,
    },

    methods: {
    
        async fetchImages(){

            // create new descriptor
            let response = await this.$inertia.get('/photo/getDescriptors')
            this.response = response
        }
      
    },

    mounted(){
        console.log(this.members)

        // al seleccionar el salon el sistema revice los descriptores de los estudiantes
            //   Como lo revisa:
            //      1. recorre los alumnos del salon, mirando el campo descriptor
            //      2. si el campo es null entonces procede a crear el descriptor
            //      3. Si no hay foto para crear el descriptor, debe arrojar un mensaje al usuario indicando el problema

        this.members.forEach(element => {
            if(element.FaceDescriptor == null){
                this.noFD_members.push(element)
            }else{
                this.FD_Members.push(element)
            }
        })

        // Create facedescriptors
        fetchImages(this.noFD_members)



    }
    
}

</script>