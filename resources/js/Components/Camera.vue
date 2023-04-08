<template>
    <div>
        <div class="" id="main__main-container">

            <canvas v-show="false" id="myCanvas" width="0" height="0"></canvas>
            <video v-show="videShow" id="streamingVideo" playsinline autoplay loop>Can't load video :(</video>
            <img v-show="imgShow" id="photo" alt="The screen capture will appear in this box."> 
            <div class="mx-auto m-2 w-28 bg-blue-500 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-full text-center"
            id="takeButton">{{recordButton}}</div>
            <div v-show="continueShow" class="mx-auto m-2 w-28 bg-blue-500 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-full text-center"
            id="continueButton">Continue</div>
            
            <textarea class="block mx-auto m-2 " v-if="errorMsg" v-model="errorMsg"></textarea>


        </div>
        
    </div>
</template>

<script>

import '@/face-api.js'


export default {

    data() {
        return {
            errorMsg: '',
            imgShow: false,
            continueShow: false,
            videShow: true,
            recordButton: 'Take',
            //canvads: null,
        }
    },

    mounted() {

        var takeButton = document.getElementById('takeButton')
        var continueButton = document.getElementById('continueButton')
        var video = document.getElementById('streamingVideo') 
        var photo = document.getElementById('photo') 
        var canvas = document.getElementById('myCanvas')                               

        let mediaRecorder;


//////////////////////////////___________________________//////////////////////////////

        // Main camera function
        async function init() {

            try {
                var stream = await navigator.mediaDevices.getUserMedia({
                    audio: false,
                    video:  {
                        facingMode: 'environment'           // Enviroment is the rear phone camera, front camera is called user
                    },
                });
                startWebcam(stream);
            } catch (err) {
                console.log('Error retrieving a media device.');
                console.log(err);
                errorMsg = err;

            }
            
        }    

        function startWebcam(stream) {
            window.stream = stream;
            video.srcObject = stream;       //  It means the live camera is gonna be showed on videoCanvas
        }

//////////////////////////////__________  On clicks_________________//////////////////////////////

        // Action Button
        takeButton.onclick = () => {   
            if(!this.imgShow){
                this.videShow = false 
                this.recordButton  = "Re-take"
                this.imgShow = true  
                this,this.continueShow = true   
                takepicture()
            } else {
                this.imgShow=false
                this.videShow=true
                this.recordButton  = "take"
            }
            
                
            //startRecording();
            //setTimeout(() => { mediaRecorder.stop(); }, 3000)           // Save 3 seconds of video 
            
        }

        continueButton.onclick = () => {
            faceID()
        }

//////////////////////////////___________________________//////////////////////////////

        function takepicture() {
            console.log(canvas)
            var context = canvas.getContext('2d');
            
            canvas.width = stream.getVideoTracks()[0].getSettings().width;
            canvas.height = stream.getVideoTracks()[0].getSettings().height;
            //console.log(x,y)
                
            context.drawImage(video, 0, 0, canvas.width , canvas.height);
            
            var data = canvas.toDataURL('image/png');
            console.log(data)
            photo.setAttribute('src', data);

            //FaceID recognition
            

           
        }

//////////////////////////////____________  FACEID API  _______________//////////////////////////////

        async function faceID() {

            // Loading libraries
            await faceapi.nets.ssdMobilenetv1.loadFromUri('../weights')
            await faceapi.nets.faceLandmark68TinyNet.loadFromUri('../weights')
            await faceapi.nets.faceLandmark68Net.loadFromUri('../weights')
            await faceapi.nets.faceRecognitionNet.loadFromUri('../weights')

            // Save the classrooms descriptors in a vector


            // // Compare faces            
            // let input = "myCanvas"
            // let inputDescriptors = await faceapi.detectAllFaces(input).withFaceLandmarks().withFaceDescriptors()
            // inputDescriptors.forEach(e => {

                
            //});




            






        }


//////////////////////////////____________  VIDEO RECORDING _______________//////////////////////////////

        // Recrding functions
        function startRecording() {
            if (video.srcObject === null) {
                video.srcObject = window.stream;
            }
            mediaRecorder = new MediaRecorder(window.stream, {mimeType: 'video/webm;codecs=vp9,opus'});
            mediaRecorder.start();
            mediaRecorder.ondataavailable = recordVideo;
        }

        function recordVideo(event) {
            console.log('evento')
            console.log(event)
            if (event.data && event.data.size > 0) {
                video.srcObject = null;     // It means the live camera wont be showed on videoCanvas
                let videoUrl = URL.createObjectURL(event.data);
                savedVideo = event.data;    // Video saved in a blob format
                video.src = videoUrl;        // It means the recorded video is gonna be showed on videoCanvas
            }
        }

        function stopRecording() {
            mediaRecorder.stop();
        }

        init();
    },
}

</script>
