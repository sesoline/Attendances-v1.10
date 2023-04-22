<template>
    <div>
        <userPanel>
            <template v-slot:Main>
                <div class="mx-auto flex-col">
                    
                    <div class="flex flex-1  flex-col md:flex-row lg:flex-row mx-2">
                    <!--Horizontal form-->
                    <div class="mb-2 border-solid border-grey-light rounded border shadow-sm w-full md:w-full lg:w-full">
                        <div class="flex flex-row justify-between content-end bg-gray-300 px-2 py-3 border-solid border-gray-400 border-b">
                            <div class="py-2 px-4 ">Students</div>
                            <div>                                
                                <button data-modal="centeredFormModal" type="Button" @click.prevent="newStudent()"
                                class="bg-green-500 modal-trigger hover:bg-green-800 text-white font-bold py-2 px-4 rounded ">
                                    Create Student
                                </button>                                                            
                            </div>
                            
                        </div>
                        
                        <div class="p-3">
                            <table class="table-fixed">
                                <thead>
                                <tr>
                                    <th class="border w-1/16 px-4 py-2 text-center"> No. </th>
                                    <th class="border w-1/4 px-4 py-2 text-center"> Last Name </th>
                                    <th class="border w-1/4 px-4 py-2 text-center"> First Name </th>
                                    <th class="border w-1/4 px-4 py-2 text-center"> Telephone </th>                                
                                    <th class="border w-1/4 px-4 py-2 text-center"> email </th>
                                    <th class="border w-1/8 px-4 py-2 text-center"> Foto </th>
                                    <th class="border w-1/2 px-4 py-2 text-center"> Options </th>
                                </tr>
                                </thead>
                                <tbody>                                                                        
                                        <tr class="text-sm" v-for="(Student, index) in students" :key="Student.id">
                                            <td class="border px-1 py-1 text-center"> {{index}} </td>  
                                            <td class="border px-1 py-1 text-center">{{ Student.LastName }}</td>                                        
                                            <td class="border px-1 py-1 text-center">{{ Student.FirstName}}</td>
                                            <td class="border px-1 py-1 text-center">{{ Student.Telephone}}</td>                                            
                                            <td class="border px-1 py-1 text-center">{{ Student.email}}</td>
                                            <td class="border px-1 py-1 place-content-center">
                                                <img class="mx-auto" :src="'storage/'+Student.Photo" :alt="Student.FirstName" width="30" > 
                                            </td>

                                            <td class="border px-4 py-2">
                                                <a data-modal="centeredFormModal" class="modal-trigger" href="#" @click="editStudent(Student)" >
                                                    Edit
                                                </a>
                                                    | 
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
                    <!-- Centered With a Form Modal -->
                    <div id='centeredFormModal' class="modal-wrapper">
                        <div class="overlay close-modal"></div>
                        <div class="modal modal-centered">
                            <div class="modal-content shadow-lg p-5">
                                <div class="border-b p-2 pb-3 pt-0 mb-4">
                                <div class="flex justify-between items-center">
                                        Student
                                        <span class='close-modal cursor-pointer px-3 py-1 rounded-full bg-gray-100 hover:bg-gray-200'>
                                            <i class="fas fa-times text-gray-700"></i>
                                        </span>
                                </div>
                                </div>
                                <!-- Modal content -->
                                <form id='form_id' @submit.prevent="submit()" class="w-full">
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="grid-first-name">
                                                First Name
                                            </label>
                                            <input
                                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white-500"
                                                id="FirstName" type="text" name="FirstName" required placeholder="First Name" v-model="form.FirstName">                                            
                                        </div>
                                        <div class="w-full md:w-1/2 px-3">
                                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="grid-last-name">
                                                Last Name
                                            </label>
                                            <input
                                                class="appearance-none block w-full bg-gray-200 text-grey-darker border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                                id="LastName" type="text" placeholder="Last Name" v-model="form.LastName" >
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="grid-first-name">
                                                Telephone
                                            </label>
                                            <input
                                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white-500"
                                                id="Telephone" type="text" name="Telephone" required placeholder="Telephone" v-model="form.Telephone">                                            
                                        </div>
                                        <div class="w-full md:w-1/2 px-3">
                                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="grid-last-name">
                                                Address
                                            </label>
                                            <input
                                                class="appearance-none block w-full bg-gray-200 text-grey-darker border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                                id="Address" type="text" placeholder="Address" v-model="form.Address" >
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="grid-first-name">
                                                Email
                                            </label>
                                            <input
                                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white-500"
                                                id="email" type="email" name="email" required placeholder="example@example.com" v-model="form.email">                                            
                                        </div>
                                        <!-- <div class="w-full md:w-1/2 px-3">
                                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="grid-last-name">
                                                Classrooms
                                            </label>
                                            <div class="relative">
                                                <select  class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey" id="grid-state">
                                                    <option v-for="e, index in form.StudentClassrooms" :value="e" :key="e" >{{form.StudentClassrooms[index]}}</option>                                                    
                                                </select>                
                                            </div>                                          
                                        </div> -->
                                    </div>
                                    <addClassroom   class="py-4" modal="" v-bind:classrooms="classrooms"
                                                    v-bind:student_classrooms="form.StudentClassrooms" > 
                                    </addClassroom>   
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full px-3">
                                            <div v-if="!create" >
                                                <img class="mx-auto" :src="url" width="200" alt=""> 
                                                <br>
                                            </div>
                                            <input  class="bg-transparent hover:bg-blue-500 text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded" 
                                                    type="file" name="Foto" id="Photo" @input="form.Photo = $event.target.files[0]" accept="image/png, image/jpeg" >   <!-- @input is explained into the inertia documentation -->                                            
                                        </div>
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
                        </div>
                    </div>
                </div>
            </template>
        </userPanel>
    </div>
</template>

<script>

import userPanel from '@/Layouts/userPanel.vue'
import addClassroom from '@/Components/addClassroom.vue'

import { Link } from '@inertiajs/inertia-vue3'

import '@/main.js'


export default {
    components: {userPanel, Link, addClassroom},

    props: {
        students: Array,
        classrooms:Array,
        student_classrooms: Array,      
    },

    data() {
        return {
            form: {
                FirstName: null,
                LastName:null,
                StudentClassrooms:null,
                Telephone: null,
                Address: null,
                Photo: null,            
            },  
            create: true,        
        }
    },

    computed: {
        url() {
            return window.location.origin + '/storage/' + this.form.Photo      
            }

    },

    methods: {

        
        newStudent() {
            this.form = {
                FirstName: null,
                LastName:null,
                //ClassName:null,
                Telephone: null,
                Address: null,
                Photo: null,            
            }  
            this.create = true
        },
        
        editStudent(student) {
            
            this.create = false
            this.form = student
            this.form.StudentClassrooms = [] 

            // I had to use JSON cuz the filter method leave me a proxy array that insert errors on vuejs
            this.form.StudentClassrooms  = JSON.parse(JSON.stringify(this.student_classrooms.filter(e => e.id == student.id)))

           
        },
        
        submit() {     
                        
            if(this.create){
                // Posting a new Student
                if(this.form.Photo===null){
                    this.form.Photo='images/defaultUser.png'
                }                
                this.$inertia.post(this.route('students.store'), this.form )
                
            } else {                           
                // Updating a student
           
                // It will be making a put to theserver using post

                console.log(this.form.StudentClassrooms,'guardado')
                this.$inertia.post(this.route('students.update',this.form.id), Object.assign({'_method': 'put'},this.form)) 
                 //   However, you can also use this:
                 // 
                 //         this.$inertia.put(this.route('students.update',this.form.id),this.form)
                 //



            }
        },

        destroy(id) {
            
            if(confirm('Are you sure?')){
                this.$inertia.delete(this.route('students.destroy',id))
            }
        },

        toggleModal(action, elem_trigger)
        {            
            elem_trigger.addEventListener('click', function () {
                if (action == 'add') {
                    let modal_id = this.dataset.modal;
                    document.getElementById(`${modal_id}`).classList.add('modal-is-open');
                } else {
                    // Automaticlly get the opned modal ID
                    let modal_id = elem_trigger.closest('.modal-wrapper').getAttribute('id');
                    document.getElementById(`${modal_id}`).classList.remove('modal-is-open');
                }                
            });
        },
        
    },

    

    mounted() {
        
        // Check if there is modals on the page
        if (document.querySelector('.modal-wrapper'))
        {
            // Open the modal
            document.querySelectorAll('.modal-trigger').forEach(btn => {
                this.toggleModal('add', btn);
            });
            
            // close the modal
            document.querySelectorAll('.close-modal').forEach(btn => {
                this.toggleModal('remove', btn);
            });
        } 
        
    },

    updated() {
        
        // Check if there is modals on the page
        if (document.querySelector('.modal-wrapper'))
        {
            // Open the modal
            document.querySelectorAll('.modal-trigger').forEach(btn => {
                this.toggleModal('add', btn);
            });
            
            // close the modal
            document.querySelectorAll('.close-modal').forEach(btn => {
                this.toggleModal('remove', btn);
            });
        } 
        
    },
    
}

</script>