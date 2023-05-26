
export async function createDescriptors(canvasVideo){

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

