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
                                <button data-modal="centeredFormModal" class="mr-2 modal-trigger bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Open modal X
                                </button>
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
                                    <th class="border w-1/4 px-4 py-2 text-center"> Last Name </th>
                                    <th class="border w-1/4 px-4 py-2 text-center"> First Name </th>
                                    <th class="border w-1/4 px-4 py-2 text-center"> Telephone </th>                                
                                    <th class="border w-1/4 px-4 py-2 text-center"> email </th>
                                    <th class="border w-1/8 px-4 py-2 text-center"> Foto </th>
                                    <th class="border w-1/2 px-4 py-2 text-center"> Options </th>
                                </tr>
                                </thead>
                                <tbody>                                                                        
                                        <tr class="text-sm" v-for="(Student, index) in DBdata" :key="Student.id">
                                            <td class="border px-1 py-1 text-center"> {{index}} </td>  
                                            <td class="border px-1 py-1 text-center">{{ Student.LastName }}</td>                                        
                                            <td class="border px-1 py-1 text-center">{{ Student.FirstName}}</td>
                                            <td class="border px-1 py-1 text-center">{{ Student.Telephone}}</td>                                            
                                            <td class="border px-1 py-1 text-center">{{ Student.email}}</td>
                                            <td class="border px-1 py-1 place-content-center">
                                                <img class="mx-auto" :src="'storage/'+Student.Photo" :alt="Student.FirstName" width="30" > 
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
                    <!-- Centered With a Form Modal -->
                    <div id='centeredFormModal' class="modal-wrapper">
                        <div class="overlay close-modal"></div>
                        <div class="modal modal-centered">
                            <div class="modal-content shadow-lg p-5">
                                <div class="border-b p-2 pb-3 pt-0 mb-4">
                                <div class="flex justify-between items-center">
                                        Modal header
                                        <span class='close-modal cursor-pointer px-3 py-1 rounded-full bg-gray-100 hover:bg-gray-200'>
                                            <i class="fas fa-times text-gray-700"></i>
                                        </span>
                                </div>
                                </div>
                                <!-- Modal content -->
                                <form id='form_id' class="w-full">
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="grid-first-name">
                                                First Name
                                            </label>
                                            <input
                                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white-500"
                                                id="grid-first-name" type="text" placeholder="Jane">
                                            <p class="text-red-500 text-xs italic">Please fill out this field.</p>
                                        </div>
                                        <div class="w-full md:w-1/2 px-3">
                                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="grid-last-name">
                                                Last Name
                                            </label>
                                            <input
                                                class="appearance-none block w-full bg-gray-200 text-grey-darker border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                                id="grid-last-name" type="text" placeholder="Doe">
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full px-3">
                                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1" for="grid-password">
                                                Password
                                            </label>
                                            <input
                                                class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                                id="grid-password" type="password" placeholder="******************">
                                            <p class="text-grey-dark text-xs italic">Make it as long and as crazy as
                                                you'd like</p>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-2">
                                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1" for="grid-city">
                                                City
                                            </label>
                                            <input
                                                class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                                id="grid-city" type="text" placeholder="Albuquerque">
                                        </div>
                                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1" for="grid-state">
                                                State
                                            </label>
                                            <div class="relative">
                                                <select
                                                    class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                                    id="grid-state">
                                                    <option>New Mexico</option>
                                                    <option>Missouri</option>
                                                    <option>Texas</option>
                                                </select>
                                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-grey-darker">
                                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1" for="grid-zip">
                                                Zip
                                            </label>
                                            <input
                                                class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                                id="grid-zip" type="text" placeholder="90210">
                                        </div>
                                    </div>

                                    <div class="mt-5">
                                        <button class='bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded'> Submit </button>
                                        <span class='close-modal cursor-pointer bg-red-200 hover:bg-red-500 text-red-900 font-bold py-2 px-4 rounded'>
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
    
}

</script>