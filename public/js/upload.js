

$("form").submit(()=>{

    uploadModel();
    return false;
});




const uploadModel = ()=>{


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    var formData = new FormData($('form')[0]);


    $.ajax({
        type:"POST",
        url:"http://localhost:8000/uploadModel",
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: (data)=>{

            if(!data["success"])
            {
                $("#errorContainer").css('display','block');
                console.log(data);
                $.each(data,(index,value)=>{
                    $(".errors").append('<li>'+value+'</li>');
                });

            }
            else
            {
                $("#errorContainer").css('display','none');
                $("#photoContainer").append('<img style="text-align: center" id="targetImg" src="images/'+data["path"]+'.'+data["format"]+'" />');

                getFaceDescriptor(data["path"],data["name"]);
            }
            return false;
        },

    })
};

const getFaceDescriptor = async(path,name)=>{
    await faceapi.loadSsdMobilenetv1Model('/models')
    await faceapi.loadFaceLandmarkModel('/models');
    await faceapi.loadFaceLandmarkTinyModel('/models');
    await faceapi.loadFaceRecognitionModel('/models')
    await faceapi.loadFaceExpressionModel('/models')
    const input = document.getElementById("targetImg");
    const results = await faceapi.detectSingleFace(input).withFaceLandmarks().withFaceDescriptor();
    console.log(path);
    const labeledDescriptor = [
        new faceapi.LabeledFaceDescriptors(
            name,
            [results.descriptor]
        )
    ]


    $("#test-descriptor").html((results.descriptor).toString());
    console.log(results.descriptor);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var datas = {
        [name] : {
            "descriptor" : results.descriptor,
            "path" : path,

        }
    }
    console.log(datas);
    $.ajax({
        type: "POST",
        url: "http://localhost:8000/saveModelDescriptor",
        data: datas,
        dataType: 'json',
        success: (data) => {
            console.log(data);
            $("#noticeContainer").css('display','block');
            $.each(data,(index,value)=>{
                $(".notices").append('<li>'+value+'</li>');
            });


        },
        error: (xhr,status,thrown)=>{
            console.log(xhr.responseText);
        }
    });


};