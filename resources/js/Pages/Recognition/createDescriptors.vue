<template>
    <div>
        <div>
            <div>
                <!-- Working box -->
                <div class="mb-2 border-solid border-gray-300 rounded border shadow-sm w-full m-2">

                    <!-- Box title -->
                    <div class="bg-gray-200 px-2 py-3 border-solid border-gray-300 border-b">
                        Getting Descriptors
                    </div>

                    <!-- Box content -->                    
                    <div>
                        <!-- Content No. 1 -->
                        <div v-if="state=='01'" class="p-3">
                            <div>
                                There is some students without face detections
                            </div>
                            <div class="flex justify-end">
                                <span
                                    class="bg-green-500 hover:bg-green-800 mt-2 text-white font-bold mr-2 py-2 px-4 rounded"
                                    type="button" @click="init()">
                                    Continue
                                </span>
                            </div>
                        </div>

                        <!-- Content No.2 -->
                        <div v-if="state=='02'" class="flex justify-center p-3">
                            <div>
                                <div>
                                    Please, take a picture to:
                                    <br><br>
                                    <div class="text-lg font-bold text-right">
                                        {{ membersOff[index].LastName }}  {{ membersOff[index].FirstName }}  
                                    </div>
                                    
                                </div>
                                <video  id="canvasVideo" width="240" height="240"></video>
                                <div class="flex justify-end">
                                    <span
                                        class="bg-gray-200 hover:bg-gray-400 mt-2 text-gray font-bold mr-2 py-2 px-4 rounded"
                                        type="button" @click="next(false)">
                                        skip
                                    </span>
                                    <span
                                        class="bg-green-500 hover:bg-green-800 mt-2 text-white font-bold mr-2 py-2 px-4 rounded"
                                        type="button" @click="next(true)">
                                        Take Photo
                                    </span>
                                </div>

                            </div>
                            
                            

                        </div>



                    </div>
                </div>
            </div> 
            
            <!-- Modal -->
            <modalCentered>
                <div></div>
            </modalCentered>
        </div>
    </div>
</template>
<script>

import modalCentered from "@/Components/ModalCentered.vue";

export default {
    components: { modalCentered },

    props: {
        membersOff: Array,

    },

    data() {
        return {
            state: "01",
            index: 0,
            length: [],
            video: null,
            
        };
    },

    methods: {

        mounted(){


        },

        init(){

            // Initialization
            this.state='02'
            this.index=0,
            this.lenght = this.membersOff             
                        
        },

       
        next(value){
            if(this.index < this.membersOff.length-1){
                

                // Getting descriptor
                if(value){
                    console.log('empezo esta damier',this.index)


                }
                this.index++

            } else {
                // Finish: All descriptors was goten


            }
            
             
        }
    },
};
</script>
