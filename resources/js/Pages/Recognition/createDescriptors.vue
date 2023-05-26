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
                        <div v-show="state=='02'" class="flex justify-center p-3">
                            <div >
                                <div>
                                    Please, take a picture to:
                                    <br>
                                    <div class="text-lg font-bold text-right">
                                        {{ membersOff[index].LastName }}  {{ membersOff[index].FirstName }}  
                                    </div>
                                    
                                </div>
                                <video v-show="switchVideo" class="m-3" id="videoRecognition" width="320" autoplay >Can't load video :(</video>
                                <canvas v-show="switchVideo" id="canvasRecognition" width="0" height="0" ></canvas>
                                <div id="resizedPhoto"></div>

                                <!-- NEXT STUDENT -->
                                <div v-if="switchPhoto==false" class="flex justify-end">
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

                                <!-- REPEAT PHOTO -->
                                <div v-if="switchPhoto" class="flex justify-center">
                                    <span
                                        class="bg-gray-200 hover:bg-gray-400 mt-2 text-gray font-bold mr-2 py-2 px-4 rounded"
                                        type="button" @click="retake()">
                                        Re-take
                                    </span>
                                    <span
                                        class="bg-green-500 hover:bg-green-800 mt-2 text-white font-bold mr-2 py-2 px-4 rounded"
                                        type="button" @click="nextd(true)">
                                        Continue
                                    </span>
                                </div>

                            </div>                                                        
                        </div>

                        <!-- <camera2></camera2> -->


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
import camera2 from "@/Components/camera2.vue";

export default {
    components: { modalCentered, camera2 },

    props: {
        membersOff: Array,

    },

    data() {
        return {
            state: "01",
            index: 0,
            length: [],
            switchVideo: true,
            switchPhoto: false,
            
            
        };
    },

    mounted(){

        // Get object from DOM
        const video = document.getElementById('videoRecognition')

        async function readCam(){

            try {
                var stream = await navigator.mediaDevices.getUserMedia({
                    audio: false,
                    video:  {
                        facingMode: 'environment'               // eviroment is the backside camera in phones
                    },
                });                
                startWebcam(stream);
            } catch (err) {
                console.log('Error retrieving a media device.');
                console.log(err);
            }
        }

        function startWebcam(stream) {
            window.stream = stream;
            video.srcObject = stream;       //  It means the live camera is gonna be showed on videoCanvas
        }

        readCam()

    },

    methods: {



        init(){

            // Variable Initialization
            this.state='02'
            this.index=0,
            this.lenght = this.membersOff    
            

            
                        
        },

       
        next(value){

            const canvas = document.getElementById('canvasRecognition')
            const video = document.getElementById('videoRecognition')
            const resizedPhoto = document.getElementById('resizedPhoto')
            const context = canvas.getContext('2d');
            
            


            if(this.index < this.membersOff.length-1){
                

                // Getting descriptor
                if(value){
                    console.log('empezo esta damier',this.index)                    

                    // Set canvas
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;

                    console.log(canvas)
                
                    // Draw photo
                    context.drawImage(video, 0, 0, canvas.width, canvas.height);
                    
                    // // Resizing image                                
                    
                    // Create new element with Tailwind Class
                    const resizedCanvas = document.createElement('canvas');
                    resizedCanvas.id = 'resizedCanvas'
                    resizedCanvas.classList.add('m-3', 'text-white');

                    // create the resized context
                    const resizedContext = resizedCanvas.getContext('2d');
                    const aspectRatio = canvas.width / canvas.height;
                    const targetWidth = 320;
                    const targetHeight = targetWidth / aspectRatio;

                    //Drawing in a new canvas
                    resizedCanvas.width = targetWidth;
                    resizedCanvas.height = targetHeight;
                    resizedContext.drawImage(canvas, 0, 0, canvas.width, canvas.height, 0, 0, targetWidth, targetHeight);

                    //insert canvas befoe old canvas
                    resizedPhoto.insertBefore(resizedCanvas, null);

  

                    this.switchPhoto=true
                    this.switchVideo=false
                    


                }
                
                this.index++

            } else {                
                    this.state="01"  // there is a new stage to develop

                // Finish: All descriptors was goten


            }       
             
        },

        retake(){
            const resizedCanvas = document.getElementById('resizedCanvas')
            resizedCanvas.remove()


        },
               

        

    },
};
</script>
