<template>
    <div>
        <userPanel>
            <template v-slot:Main>
                <div class="mx-auto w-full flex-col">
                    
                    <div class="flex flex-1  flex-col md:flex-row lg:flex-row mx-2">
                        <!--Horizontal form-->
                        <div class="mb-2 border-solid border-grey-light rounded border shadow-sm w-full md:w-full lg:w-full">
                            <div class="flex flex-row justify-between content-end bg-gray-300 px-2 py-3 border-solid border-gray-400 border-b">
                                <div class="py-2 px-4 ">CLASSROOMS</div>
                                <div>
                                    <button data-modal="centeredFormModal" type="Button" @click="newClassroom()"
                                    class="modal-trigger bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded " >
                                        Create Classroom
                                    </button>
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
                                            <tr class="text-sm" v-for="(classroom) in classrooms" :key="classroom.id">
                                                <td class="border px-1 py-1 text-center">{{ classroom.ClassName }} </td>
                                                <td class="border px-1 py-1 text-center">{{ classroom.Details }} </td>  
                                                <td class="border px-1 py-1 text-center">{{ classroom.Year }}</td>                                        
                                                <td class="border px-1 py-1 text-center">{{ classroom.Owner}}</td>
                                                <td class="border px-1 py-1 text-center">{{ classroom.OwnerEmail}}</td>                                            
                                                <td class="border px-1 py-1 text-center">{{ classroom.OwnerTel}}</td>
                                                <td class="border px-1 py-1 text-center">{{ classroom.Active}}</td>                                                                              
                                                <td class="border px-4 py-2 text-center">
                                                    <a data-modal="centeredFormModal" class="modal-trigger" href="#" @click="editClassroom(classroom)" >
                                                        Editar
                                                    </a>
                                                        <br><br>                  
                                                    <a href="#" @click.prevent="destroy(classroom.id)">
                                                        Delete 
                                                    </a>
                                                        <br><br>
                                                    <a data-modal="centeredFormModal" class="modal-trigger" href="#" @click="{modalState='addDescriptorsModal'; classroomID=classroom.id}" > 
                                                        Descriptors 
                                                    </a>
                                                        <br><br>
                                                    <a data-modal="centeredFormModal" class="modal-trigger" href="#" @click="editMembers(classroom.id)" >
                                                        Members
                                                    </a>
                                                </td>
                                            </tr>                                                                                                                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--/Horizontal form-->                    
                    </div>


                    <modalCentered>

                        <template v-slot:title>
                            <div v-if="modalState=='editModal'">CLASSROOM DETAILS</div>
                            <div v-if="modalState=='addDescriptorsModal'">GENERATE AUTOMATIC DESCRIPTORS</div>
                            <div v-if="modalState=='addStudentsModal'">MEMBERS</div>
                        </template>
                        <template v-slot:content>
                            <!-- CLASSROOM DETAILS -->
                            <div v-if="modalState=='editModal'">
                                <form id='form_id' @submit.prevent="submit()" class="w-full">
                                                <div class="flex flex-wrap -mx-3 mb-6">
                                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="grid-first-name">
                                                            ClassName
                                                        </label>
                                                        <input
                                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white-500"
                                                            id="ClassName" type="text" name="ClassName" required placeholder="ClassName" v-model="form.ClassName">                                            
                                                    </div>
                                                    <div class="w-full md:w-1/2 px-3">
                                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="grid-last-name">
                                                            Year
                                                        </label>
                                                        <input
                                                            class="appearance-none block w-full bg-gray-200 text-grey-darker border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                                            id="Year" type="text" placeholder="Year" v-model="form.Year" >
                                                    </div>
                                                </div>
                                                <div class="flex flex-wrap -mx-3 mb-6">
                                                    <div class="w-full px-3">
                                                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1" for="grid-password">
                                                            Details
                                                        </label>
                                                        <input class="appearance-none block w-full bg-gray-200 text-grey-darker border border-grey-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey" 
                                                        id="grid-password" type="Details" placeholder="Details" v-model="form.Details">                                                        
                                                    </div>
                                                </div>                                                
                                                <div class="flex flex-wrap -mx-3 mb-6">
                                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="grid-first-name">
                                                            Owner
                                                        </label>
                                                        <input
                                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white-500"
                                                            id="Owner" type="text" name="Owner" required placeholder="Owner" v-model="form.Owner">                                            
                                                    </div>
                                                    <div class="w-full md:w-1/2 px-3">
                                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="grid-last-name">
                                                            Owner's Email
                                                        </label>
                                                        <input
                                                            class="appearance-none block w-full bg-gray-200 text-grey-darker border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                                            id="OwnerEmail" type="email" placeholder="OwnerEmail" v-model="form.OwnerEmail" required>
                                                    </div>
                                                </div>
                                                <div class="flex flex-wrap -mx-3 mb-6">
                                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="grid-first-name">
                                                            Owner's Telephone
                                                        </label>
                                                        <input
                                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white-500"
                                                            id="OwnerTel" type="OwnerTel" name="OwnerTel" placeholder="Owner Telphone" v-model="form.OwnerTel" required>                                            
                                                    </div>
                                                    <div class="w-full md:w-1/2 px-3">
                                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="grid-last-name">
                                                            Is it Active?
                                                        </label>
                                                        <select
                                                            class="appearance-none block w-full bg-gray-200 text-grey-darker border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                                            id="Active" type="Active" v-model="form.Active" required>
                                                            <option value="1">True</option>
                                                            <option value="0">False</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="flex flex-wrap -mx-3 mb-6">
                                                    
                                                </div>                                    

                                                <div class="mt-5">
                                                    <input  id="submidButton" class='bg-green-500 close-modal hover:bg-green-800 text-white font-bold mr-2 py-2 px-4 rounded' 
                                                            type="submit" :value=" create ? 'Create' : 'Update' ">                                        
                                                    <span class='close-modal cursor-pointer bg-red-200 hover:bg-red-500 text-red-900 font-bold py-2 px-4 rounded' >
                                                        Close
                                                    </span>
                                                </div>
                                </form>
                            </div>

                            <!-- ADD DESCRIPTORS -->
                            <div v-if="modalState=='addDescriptorsModal'">
                                <div class="flex justify-center flex-wrap -mx-3 mb-6">
                                    <form id='form_id' @submit.prevent="generateDescriptors()" class="flex justify-center flex-wrap">
                                        <input  id="genDescriptorsBtn" data-modal="centeredFormModal"   
                                                class='modal-trigger w-fit bg-green-500 text-center close-modal 
                                                hover:bg-green-800 text-white font-bold mr-2 py-2 px-4 rounded' 
                                                type="submit"
                                                value="Generate descriptors" >
                                        
                                        <label class="block tracking-wide text-gray-700 text-xs font-light mb-1" for="grid-first-name">
                                            <br> 
                                            This action will delete all previous classroom descriptors 
                                        </label>
                                    </form>                                                                    
                                </div>
                            </div>

                            <!-- ADD STUDENTS -->
                            <div v-if="modalState=='addStudentsModal'">
                                <div class="content-center">
                                    <addStudents class="mb-4" modal="" v-bind:ClassroomStudents="ClassroomStudents" v-bind:students="students">

                                    </addStudents>
                                    <div class="flex items-center justify-end gap-2 ">
                                        <span class='close-modal cursor-pointer bg-red-200 hover:bg-red-500 text-red-900 font-bold py-2 px-4 rounded' >
                                            Close
                                        </span>
                                        <span class='close-modal bg-green-500 hover:bg-green-800 text-white font-bold mr-2 py-2 px-4 rounded' 
                                        type="button" @click="updateMembers()">
                                            Save
                                        </span>
                                    </div>
                                    
                                </div>
                                
                                
                            </div>
                                
                        </template>
                    </modalCentered>


                </div>
            </template>
        </userPanel>
    </div>
</template>

<script>

import userPanel from '@/Layouts/userPanel.vue'
import addStudents from '../../Components/addStudents.vue'
import modalCentered from '@/Components/ModalCentered.vue'
import { Link } from '@inertiajs/inertia-vue3'


export default {
    components: {userPanel, addStudents, Link, modalCentered},

    props: {
        classrooms: Array,
        student_classrooms: Array,
        students: Array,
    },

    data() {
        return {
            form: {
                ClassName: null,
                Details:null,
                Year:null,
                Owner: null,
                OwnerEmail: null,
                OwnerTel: null,  
                Active: 1,
                Institution_id: '1',          
            },
            ClassroomStudents: [],
            classroomID: null,
            create: true,
            modalState: null,  
                    
        }
    },

    methods: {

        updateMembers(){
        
            this.$inertia.put(this.route('studentClassrooms.update', this.classroomID), this.ClassroomStudents) 

        },

        editMembers(classroomID){

            this.modalState ='addStudentsModal'

            // Get the classroomID
            this.classroomID = classroomID
        
            // Filter the student_classrooms array
            this.ClassroomStudents = []
            this.student_classrooms.forEach(element => {
                if(element.classroom_id == classroomID){
                    this.ClassroomStudents.push(element)
                }
            })        
            

        },

        newClassroom() {
            this.modalState ='editModal'
            this.create = true
            this.form = {
                ClassName: null,
                Details:null,
                Year:null,
                Owner: null,
                OwnerEmail: null,
                OwnerTel: null,  
                Active: '', 
                Institution_id: '1',         
            }  
        },

        editClassroom(classroom) {    
            this.modalState='editModal'    
            this.create = false
            this.form = classroom
        },

        submit() {            
            if(this.create){
                // Creating new classroom            
                this.$inertia.post(this.route('classrooms.store'), this.form )
            } else {                           
                // Updating classroom                        
                this.$inertia.put(this.route('classrooms.update',this.form.id),this.form)

            }
        },

        destroy(id) {
            
            if(confirm('Are you sure?')){
                this.$inertia.delete(this.route('classrooms.destroy',id))
            }
        },

        generateDescriptors() {
            console.log("que onda cabron",this.classroomID)

            


        },


        
    },

    
    
}

</script>