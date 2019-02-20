$("form").submit(()=>{

    recognizeSingle();
    return false;
});

let loadImage = (event)=>{
    $('#targetImg').attr('src',URL.createObjectURL(event.target.files[0]));
};

const recognizeSingle = ()=> {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $.ajax({
        type:"GET",
        url:"http://localhost:8000/getDescriptor",
        success: (data)=> {

            buildLabelledDescriptor(data);
        },
        error: (xhr,status,thrown)=>{
            console.log(xhr.responseText);
        }
    });
};

const buildLabelledDescriptor =async(data)=>{
    await faceapi.loadSsdMobilenetv1Model('/models');
    await faceapi.loadFaceLandmarkModel('/models');
    await faceapi.loadFaceLandmarkTinyModel('/models');
    await faceapi.loadFaceRecognitionModel('/models');
    await faceapi.loadFaceExpressionModel('/models');

    let labeledDescriptor = data.map(artis => {
        let artisName = Object.keys(artis)[0];


        // let floatArrays = artis[artisName].descriptor.map(
        //     descriptor => new Float32Array([descriptor])
        // );


        //let floatArrays = new Float32Array(artis[artisName].descriptor);

        let floatArrays = artis[artisName].descriptor.map(e => new Float32Array(e));



        return new faceapi.LabeledFaceDescriptors(
            artisName,
            floatArrays
        );
    });

    console.log(labeledDescriptor);
    let input = document.getElementById("targetImg");
    const fullFaceDescription = await faceapi.detectSingleFace(input).withFaceLandmarks().withFaceDescriptor();
    if(!fullFaceDescription)
    {
        console.log('no face detected');
    }

    // console.log(fullFaceDescription.descriptor);


    console.log(fullFaceDescription);

    const faceMatcher = new faceapi.FaceMatcher(labeledDescriptor,0.6);
    //const results = fullFaceDescription.descriptor.map(fd => faceMatcher.findBestMatch(fd.descriptor));
    const bestMatch = faceMatcher.findBestMatch(fullFaceDescription.descriptor);
    console.log(bestMatch);

    const boxSize = faceapi.resizeResults(fullFaceDescription, {width: input.width, height: input.height});
    const canvas = document.getElementById('detectionBox');
    canvas.width = input.width;
    canvas.height = input.height;
    let x = fullFaceDescription["detection"]["box"]["x"];
    let y = fullFaceDescription["detection"]["box"]["y"];;
    let width = fullFaceDescription["detection"]["box"]["width"];
    let height = fullFaceDescription["detection"]["box"]["height"];;
    const boxesWithText = [
        new faceapi.BoxWithText(new faceapi.Rect(x,y, height, width), bestMatch.label+"\n"+'Distance:'+bestMatch.distance.toFixed(2))
    ]
    faceapi.drawDetection(canvas, boxesWithText);
};