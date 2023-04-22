<template>
    <div>
        <!-- Canvas -->
        <div class="border-solid border-gray-200 rounded border shadow-sm w-full">
            <div class="bg-gray-200 px-2 py-3 border-solid border-gray-200 border-b
                        text-gray-700 text-xs font-light">
                
                <!-- Search tool -->
                <div class="flex justify-end items-center ">                    
                    <div class="basis-2/4 text-m text-left"> 
                        CLASSROOMS
                    </div>

                    <!-- Search box -->
                    <div class="" >
                        <input list="classrooms" class="appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-0 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey" 
                        id="addClassroom" type="text" placeholder="Search" v-bind:value="modal">
                        <datalist class=" appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-0 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey"
                        id="classrooms">
                            <option v-for="classroom in classrooms" :key="classroom.id" :id="'optionCR-'+classroom.ClassName" :data-id="classroom.id">{{classroom.ClassName}}</option>
                        </datalist>
                    </div>
                    <!--  Add button -->
                    <button class=" bg-teal-500 hover:bg-teal-dark-700 border-teal-500 hover:border-teal-dark text-sm border-0 text-white mx-2 py-0 px-4 rounded" 
                    type="button" @click="addClassroom()">
                        Add
                    </button>
                                                      
                </div>
            </div>

            <div v-if="student_classrooms == null || student_classrooms.length == 0 " class="text-center text-gray-700 text-s font-light m-8">Student doesn't have Classroom enrolled</div>

            <!-- Student's classrooms list -->
            <div class="p-3">
                <form class="w-full">
                    <div v-for="e,index in student_classrooms"  :key="e"  class="flex items-center border-b border-b-1 border-teal-500 py-2">
                        <label class="appearance-none bg-transparent border-none w-full text-gray-600 mr-3 py-1 px-2 lineHeight-tight focus:outline-none" >
                        {{ e.ClassName }}
                        </label>
        
                        <button class="flex-shrink-0 border-transparent border-4 text-teal hover:text-teal-darker text-sm py-1 px-2 rounded" 
                        type="button" @click="this.student_classrooms.splice(index,1)">
                            Delete
                        </button>
                    </div>                                    
                </form>
            </div>
        
            
        </div>
    </div>
</template>

<script>

export default {

    props: {
        classrooms: Array,
        student_classrooms:Array, 
        modal:String,    
    },

    data() {
        return {
            errorMsg: '',
            imgShow: false,
            continueShow: false,
            videShow: true,
            recordButton: 'Take',
            //newClassrooms:[],
            

        }
    },

    methods: {

        addClassroom() {
        
            let newClass = true 

            // Read selected classroom form datalist
            let selectClassroom = document.getElementById('addClassroom').value

            // Check if classroom was already taken
            this.student_classrooms.forEach(e => {
                if (e.ClassName == selectClassroom) {
                    newClass = false
                    console.log("Classroom already selected")
                    alert('Classroom already selected') 
                    //this.modal = ''           // error: props are readonly                            
                }
            })

            // Adding classroom 
            if (newClass){
                let idClassroom = document.getElementById('optionCR-'+selectClassroom).dataset.id
                //console.log(this.student_classrooms,'before')
                this.student_classrooms.push({id:null,  classroom_id:idClassroom, ClassName:selectClassroom}) 
                //console.log(this.student_classrooms,'after')
            }                    
        },

    },



}


</script>

