<template>
    <div>
        <div id="main__main-container">

            <video id="canvasVideo" playsinline autoplay loop>Can't load video :(</video>

            <div id="stopButton">Record</div>

            <div id="stopEverything">STOOOOP</div>



        </div>
        
    </div>
</template>

<script>

export default {
    mounted() {

        var videoButton = document.getElementById('stopButton')
        var stopButton = document.getElementById('stopEverything')
        var video = document.getElementById('canvasVideo')        

        let mediaRecorder;


//////////////////////////////___________________________//////////////////////////////

        // Main camera function
        async function init() {

            try {
                var stream = await navigator.mediaDevices.getUserMedia({
                    audio: false,
                    video:  {
                        facingMode: 'environment'
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

//////////////////////////////___________________________//////////////////////////////

        // Buttons action
        videoButton.onclick = () => {

            switch (videoButton.textContent) {
                case 'Record':
                    startRecording();
                    videoButton.textContent = 'Stop';
                    break;
                case 'Stop':
                    videoButton.textContent = 'Record';
                    mediaRecorder.stop();
                    break;
            }

            
        }


        stopButton.onclick = () => {
            try {
                window.stream = null;
                video.srcObject = null;
            } catch (err) {
                console.log('Error retrieving a media device.');
                console.log(err);
            }
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
