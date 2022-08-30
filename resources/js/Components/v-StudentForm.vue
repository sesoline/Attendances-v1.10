<template>
    <div>
        <div class=" place-content-center">
            <div class="md:flex md:items-center mb-6">
                <label class="block text-gray-500 font-regular md:text-right mb-1 md:mb-0 pr-4" for="Nombres"> Nombres: </label>
                <input class="bg-grey-200 appearance-none border-1 border-grey-200 rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-purple-light" 
                       type="text" name="Name" id="Name" value="" >
            </div>
            
            <div class="md:flex md:items-center mb-6">
                <label class="block text-gray-500 font-regular md:text-right mb-1 md:mb-0 pr-4" for="PrimerApellido"> PrimerApellido: </label>
                <input class="bg-grey-200 appearance-none border-1 border-grey-200 rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-purple-light" 
                       type="text" name="LastName" id="LastName" :value="fillable(data.LastName)" >
            </div>
            
            <div class="md:flex md:items-center mb-6">
                <label class="block text-gray-500 font-regular md:text-right mb-1 md:mb-0 pr-4"  for="Salon"> Salon: </label>
                <input class="bg-grey-200 appearance-none border-1 border-grey-200 rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-purple-light" 
                       type="text" name="ClassName" id="ClassName" value="fillable(data.ClassName)" >
            </div>
            
            <div class="md:flex md:items-center mb-6">    
                <label class="block text-gray-500 font-regular md:text-right mb-1 md:mb-0 pr-4"  for="Telefono"> Telefono: </label>
                <input class="bg-grey-200 appearance-none border-1 border-grey-200 rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-purple-light" 
                       type="number" name="Telephone" id="Telephone" value="fillable(data.Telephone)" >
            </div>
            
            <div class="md:flex md:items-center mb-6">
                <label class="block text-gray-500 font-regular md:text-right mb-1 md:mb-0 pr-4"  for="Direccion"> Direccion: </label>
                <input class="bg-grey-200 appearance-none border-1 border-grey-200 rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-purple-light" 
                       type="text" name="Address" id="Address" value="fillable(data.Address)" >
            </div>
            
            <div class="md:flex md:items-center mb-6">
                <label class="block text-gray-500 font-regular md:text-right mb-1 md:mb-0 pr-4"  for="email"> e-mail: </label>
                <input class="block text-gray-500 font-regular md:text-right mb-1 md:mb-0 pr-4"  
                       type="email" name="email" id="email" value="fillable(data.email)" >
            </div>
            
            <div class="md:flex md:items-center mb-6">
                <label class="block text-gray-500 font-regular md:text-right mb-1 md:mb-0 pr-4" for="Foto"> Foto: </label>
            </div>
            
            <!-- @if(isset($gato->Foto))
            @endif -->
            <div v-if="() => typeof $gato !== 'undefined' ? true : false" >
                <img src="storage/$data.Photo" width="300" alt=""> 
                <br>
            </div>

            <input  class="bg-transparent hover:bg-blue-500 text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded" 
                    type="file" name="Foto" id="Foto" value="" >
            <br><br>
            <div class="flex justify-end">
                <input class="bg-transparent hover:bg-blue-500 text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded" 
                       type="submit" value="() => create ? 'Create' : 'Update' ">
            </div>
            
            
        </div>
    </div>
</template>

<script>

// variable $gato llega de afuera

import { objectToString } from '@vue/shared';

export default {
    data() {
        return {
            data: {'LastName': "carlos"},
        }
    },
    
    props: {
        //data: Object,
        //create: Object,
    },
    methods: {
       fillable: function(data) {
            if (typeof data == 'undefined'){
                return ""
            } else {
                return data
            }
        } 
    },
}
// function fillable(data){
//     if (typeof data == 'undefined'){
//         return ""
//     } else {
//         return data
//     }
// }

</script>