<template>
    <div>
        <userPanel>
            <template v-slot:Main>
                <form @submit.prevent="submit()" enctype="multipart/form-data" >                    
                    <div class=" place-content-center">
                        <div class="md:flex md:items-center mb-6">
                            <label class="block text-gray-500 font-regular md:text-right mb-1 md:mb-0 pr-4" for="Nombres"> Class Name: </label>
                            <input class="bg-grey-200 appearance-none border-1 border-grey-200 rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-purple-light" 
                                type="text" name="ClassName" id="ClassName" v-model="form.ClassName" required > 
                        </div>
                        
                        <div class="md:flex md:items-center mb-6">
                            <label class="block text-gray-500 font-regular md:text-right mb-1 md:mb-0 pr-4" for="PrimerApellido"> Details: </label>
                            <input class="bg-grey-200 appearance-none border-1 border-grey-200 rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-purple-light" 
                                type="text" name="Details" id="Details" v-model="(form.Details)" required >
                        </div>
                        
                        <div class="md:flex md:items-center mb-6">
                            <label class="block text-gray-500 font-regular md:text-right mb-1 md:mb-0 pr-4"  for="Salon"> Year: </label>
                            <input class="bg-grey-200 appearance-none border-1 border-grey-200 rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-purple-light" 
                                type="text" name="Year" id="Year" v-model="(form.Year)" required > 
                        </div>
                        
                        <div class="md:flex md:items-center mb-6">    
                            <label class="block text-gray-500 font-regular md:text-right mb-1 md:mb-0 pr-4"  for="Telefono"> Owner: </label>
                            <input class="bg-grey-200 appearance-none border-1 border-grey-200 rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-purple-light" 
                                type="text" name="Owner" id="Owner" v-model="(form.Owner)" required > 
                        </div>
                        
                        <div class="md:flex md:items-center mb-6">
                            <label class="block text-gray-500 font-regular md:text-right mb-1 md:mb-0 pr-4"  for="Direccion"> Owner Email: </label>
                            <input class="bg-grey-200 appearance-none border-1 border-grey-200 rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-purple-light" 
                                type="text" name="OwnerEmail" id="OwnerEmail" v-model="(form.OwnerEmail)" required > 
                        </div>
                        
                        <div class="md:flex md:items-center mb-6">
                            <label class="block text-gray-500 font-regular md:text-right mb-1 md:mb-0 pr-4"  for="email"> Owner Tel: </label>
                            <input class="block text-gray-500 font-regular md:text-right mb-1 md:mb-0 pr-4"  
                                type="text" name="OwnerTel" id="OwnerTel" v-model="(form.OwnerTel)" required >
                        </div>

                        <div class="md:flex md:items-center mb-6">
                            <label class="block text-gray-500 font-regular md:text-right mb-1 md:mb-0 pr-4"  for="email"> It's active?: </label>
                            <select class="w-1/6 block text-gray-500 font-regular md:text-right mb-1 md:mb-0 pr-4"  
                                name="Active" id="Active" v-model="(form.Active)" required >
                                    <option value="1">True</option>
                                    <option value="0">False</option>
                            </select>
                        </div>                                                                                    
                        
                        <div class="flex flex-row justify-end">
                            
                            <Link class="bg-blue-500 hover:bg-blue-300 text-white font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded" 
                            :href="route('classrooms.index')" method="GET" type="button" >
                                Back
                            </link>
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
        classroom: Object,
        create: Boolean,    // If it's true, this will be an created form
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
                Active: null,           
            },          
        }
    },

    created() {    
        if(!this.create) {
            this.form = this.classroom        // If its a create form, the classroom array will be null        
        }           
        
    },

    methods: {
        submit() {            
            if(this.create){
                // Creating new classroom            
                this.$inertia.post(this.route('classrooms.store'), this.form )
            } else {                           
                // Updating classroom                        
                this.$inertia.put(this.route('classrooms.update',this.classroom.id),this.form)

            }
        },
        
    },    
   
}


</script>