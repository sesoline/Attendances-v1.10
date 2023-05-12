<template>
    <div>
        <!-- Canvas -->
        <div class="border-solid border-gray-200 rounded border shadow-sm w-full">
            <div class="bg-gray-200 px-2 py-3 border-solid border-gray-200 border-b
                        text-gray-700 text-xs font-light">
                
                <!-- Search tool -->
                <div class="flex justify-end items-center ">                    
                    <div class="basis-2/4 text-m text-left"> 
                        
                    </div>

                    <!-- Search box -->
                    
                    <div class="" >
                        <input list="students" class="appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-0 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey" 
                        id="addStudent" type="text" placeholder="Search Student" v-bind:value="modal">
                        <datalist class=" appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-0 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey"
                        id="students">
                            <option v-for="student in students" :key="student.id" :id="'optionST-'+student.LastName+' '+student.FirstName" :data-id="student.id">{{student.LastName}} {{ student.FirstName }}</option>
                        </datalist>
                    </div>
                    <!--  Add button -->
                    <button class=" bg-teal-500 hover:bg-teal-dark-700 border-teal-500 hover:border-teal-dark text-sm border-0 text-white mx-2 py-0 px-4 rounded" 
                    type="button" @click="addStudent()">
                        Add
                    </button>
                                                      
                </div>
            </div>

            <div v-if="ClassroomStudents == null || ClassroomStudents.length == 0 " class="text-center text-gray-700 text-s font-light m-8">This classroom doesn't have students enrolled</div>

            <!-- Classrooms Students list -->
            <div class="p-3">
                <form class="w-full">
                    <div v-for="e,index in ClassroomStudents"  :key="e"  class="flex items-center py-1 hover:text-gray-600">
                        <label class="appearance-none bg-transparent border-none w-full text-gray-600 mr-3 py-1 px-2 lineHeight-tight focus:outline-none" >
                        {{ e.LastName }} {{ e.FirstName }}
                        </label>
        
                        <button class="flex-shrink-0 border-transparent border-4 text-teal text-sm py-1 px-2 rounded" 
                        type="button" @click="this.ClassroomStudents.splice(index,1)">
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
        students: Array,
        ClassroomStudents: Array, 
        modal: String, 
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

    //hacer un filtro del los estudiantes del salon, hacerlo antes de renderizar el html

    methods: {

        addStudent() {

            let isNew = true

            // Read selected student form the datalist
            let newStudent = document.getElementById('addStudent').value
            let newStudentID = document.getElementById('optionST-'+newStudent).dataset.id
            
            // Check if the student is currently enrolled
            this.ClassroomStudents.forEach(e => {
                if (e.id == parseInt(newStudentID)) {
                    isNew = false
                    console.log("Student already belongs to this classroom")
                    alert('Student already belongs to this classroom')                                                      
                }
            })

            // Adding Student 
            if (isNew){
                
                this.ClassroomStudents.push({id:newStudentID,  FirstName:newStudent, LastName:null ,classroom_id:null}) 
              
            } 
                            
        },

    },


}


</script>

