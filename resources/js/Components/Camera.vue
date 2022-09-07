<template>
    <div>
        <div class="" id="main__main-container">

            <canvas v-show="false" id="canvasVideo" width="0" height="0"></canvas>
            <video id="streamingVideo" playsinline autoplay loop>Can't load video :(</video>
            
            <div class="mx-auto m-2 w-28 bg-blue-500 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-full text-center"
            id="stopButton">{{recordButton}}</div>
            
            <textarea class="block mx-auto m-2 " v-if="errorMsg" v-model="errorMsg"></textarea>

            <img id="photo" alt="The screen capture will appear in this box."> 

        </div>
        
    </div>
</template>

<script>

import '@/face-api.js'


export default {

    data() {
        return {
            errorMsg: '',
            recordButton: 'Record',
            //canvads: null,
        }
    },

    mounted() {

        var videoButton = document.getElementById('stopButton')
        var video = document.getElementById('streamingVideo') 
        var photo = document.getElementById('photo') 
        var canvas = document.getElementById('canvasVideo')                               

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

//////////////////////////////___________________________//////////////////////////////

        // Action Button
        videoButton.onclick = () => {            
            takepicture()
            
            
            //startRecording();
            //setTimeout(() => { mediaRecorder.stop(); }, 3000)           // Save 3 seconds of video 
            
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
           
        }


//////////////////////////////___________________________//////////////////////////////

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
