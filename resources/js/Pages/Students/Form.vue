<template>
    <div>
        <userPanel>
            <template v-slot:Main>
                <form class="mx-auto p-4" @submit.prevent="submit()" enctype="multipart/form-data" >                    
                    <div class=" place-content-center">
                        <div class="md:flex md:items-center mb-6">
                            <label class="block text-gray-500 font-regular md:text-right mb-1 md:mb-0 pr-4" for="Nombres"> First Name: </label>
                            <input class="bg-grey-200 appearance-none border-1 border-grey-200 rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-purple-light" 
                                type="text" name="Name" id="Name" v-model="form.FirstName" required > 
                        </div>
                        
                        <div class="md:flex md:items-center mb-6">
                            <label class="block text-gray-500 font-regular md:text-right mb-1 md:mb-0 pr-4" for="PrimerApellido"> LastName: </label>
                            <input class="bg-grey-200 appearance-none border-1 border-grey-200 rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-purple-light" 
                                type="text" name="LastName" id="LastName" v-model="(form.LastName)" required >
                        </div>
                        
                        <div class="md:flex md:items-center mb-6">
                            <label class="block text-gray-500 font-regular md:text-right mb-1 md:mb-0 pr-4"  for="Salon"> ClassRoom: </label>
                            <input class="bg-grey-200 appearance-none border-1 border-grey-200 rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-purple-light" 
                                type="text" name="ClassName" id="ClassName" v-model="(form.ClassName)" required > 
                        </div>
                        
                        <div class="md:flex md:items-center mb-6">    
                            <label class="block text-gray-500 font-regular md:text-right mb-1 md:mb-0 pr-4"  for="Telefono"> Telefono: </label>
                            <input class="bg-grey-200 appearance-none border-1 border-grey-200 rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-purple-light" 
                                type="text" name="Telephone" id="Telephone" v-model="(form.Telephone)" required > 
                        </div>
                        
                        <div class="md:flex md:items-center mb-6">
                            <label class="block text-gray-500 font-regular md:text-right mb-1 md:mb-0 pr-4"  for="Direccion"> Direccion: </label>
                            <input class="bg-grey-200 appearance-none border-1 border-grey-200 rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-purple-light" 
                                type="text" name="Address" id="Address" v-model="(form.Address)" required > 
                        </div>
                        
                        <div class="md:flex md:items-center mb-6">
                            <label class="block text-gray-500 font-regular md:text-right mb-1 md:mb-0 pr-4"  for="email"> e-mail: </label>
                            <input class="block text-gray-500 font-regular md:text-right mb-1 md:mb-0 pr-4"  
                                type="email" name="email" id="email" v-model="(form.email)" required >
                        </div>
                        
                        <div class="md:flex md:items-center mb-6">
                            <label class="block text-gray-500 font-regular md:text-right mb-1 md:mb-0 pr-4" for="Foto"> Photo: </label>
                        </div>
                        
                        
                        <div v-if="!create" >
                            <img :src="url" width="300" alt=""> 
                            <br>
                        </div>

                        <input  class="bg-transparent hover:bg-blue-500 text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded" 
                                type="file" name="Foto" id="Photo" @input="form.Photo = $event.target.files[0]" accept="image/png, image/jpeg" >   <!-- @input is explained into the inertia documentation -->
                        <br><br>
                        
                        <div class="flex pb-16 flex-row justify-end">
                            
                            <Link class="bg-blue-500 hover:bg-blue-300 text-white font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded" :href="route('students.index')" method="GET" type="button" >
                                Back
                            </Link>
                            <input id="subminButton" class="bg-green-500 hover:bg-green-800 text-white font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded" 
                                type="submit" :value=" create ? 'Create' : 'Update' ">
                            
                        </div>  
                                                                      
                    </div>
                </form>
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
        student: Object,
        create: Boolean,    // If it's true, this will be an created form
    },

    data() {
        return {
            form: {
                FirstName: null,
                LastName:null,
                ClassName:null,
                Telephone: null,
                Address: null,
                Photo: null,            
            },          
        }
    },

    created() {    
        if(!this.create) {
            this.form = this.student        // If its a create form, the student array will be null        
        }           
        
    },

    methods: {
        submit() {            
            if(this.create){
                // Posting a new Student
                if(this.form.Photo===null){
                    this.form.Photo='images/defaultUser.png'
                }
                this.$inertia.post(this.route('students.store'), this.form )
            } else {                           
                // Updating a student
                
                console.log(Object.assign({'_method': '_put'},this.form))

                this.$inertia.post(this.route('students.update',this.student.id),
                Object.assign({'_method': 'put'},this.form))

            }
        },

    },

    computed: {
        url() {
            return window.location.origin + '/storage/' + this.form.Photo      
            }

    }
    
   
}


</script>