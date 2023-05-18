// 
// Most used functions in FAce-ID api 
//



export async function readPhotos(members){
    // members is an array that has to have a photo address


    // FaceID API libraries
    await faceapi.nets.ssdMobilenetv1.loadFromUri('./weights')
    await faceapi.nets.faceLandmark68TinyNet.loadFromUri('./weights')
    await faceapi.nets.faceRecognitionNet.loadFromUri('./weights')

    members.forEach(element => {
        members.Photo
    });


    
    //console.log('readPhotos')
}

export function createDescriptor(){

}