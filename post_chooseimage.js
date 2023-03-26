document.querySelector("#upload").addEventListener("change", (e) => {
    if(window.File && window.FileReader && window.FileList && window.Blob){
    const image = e.target.files;
    const output = document.querySelector("#image")

    for(let i = 0; i < image.length; i++){
        if(!image[i].type.match("image")) continue;
        const picReader = new FileReader();
        picReader.addEventListener("load", function(event){
            const picFile = event.target;
            const div = document.createElement("div");
            div.innerHTML = '<img class="show" src="' + picFile.result + '"/>';
            output.appendChild(div);
        })
        picReader.readAsDataURL(image[i]);
    }
}else{
    alert("Browser does not support File API");
}
})