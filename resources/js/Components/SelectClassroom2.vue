<template>
    <div>
        <!-- Select Classroom -->
        <div class="md:flex md:items-center mb-6 py-3 px-4 pr-8 ">
                        <div class="">
                            <label class="block text-gray-500 font-regular md:text-right mb-1 md:mb-0 pr-4" >
                                Please, select classroom: 
                            </label>
                        </div>
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <div class="relative">                                                                                                                           
                                <select  class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                id="SalonSelect" @change="on_change()" v-model="selected">
                                    <option></option>
                                    <option v-for="classroom in classrooms" :key="classroom.id" :value="classroom.id"> 
                                        {{ classroom.ClassName}} - {{classroom.Details}}
                                    </option>
                                </select>                            
                            </div>
                        </div>                        
                    </div>
        <!-- End Select Classroom -->
    </div>
</template>

<script>

export default {

    data() {
        return {
            selected: '',                 
        }
    },

    props: {
        classrooms: Array,
    },

    methods: {

        on_change(){
            
            this.$emit('on_change',this.selected)

        },
    }








}
</script>