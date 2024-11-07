const addImageBtn=document.getElementById("addImagebtn");
const removeImageBtn=document.getElementById("removeImagebtn");
const imagePlaceholder=document.getElementById("image-placeholder");
const inRemArea = document.getElementById('intentionally_removed');

let inputpath = document.querySelector("#image");


let file;

function toggleBrowse(){
    inputpath.click();
}

function removeImage(){
    addImageBtn.style.display = "block";
    removeImageBtn.style.display = "none";
    imagePlaceholder.style.display = "none";

    imagePlaceholder.setAttribute('src' , '');
    inputpath.value = null;

    inRemArea.value='removed';
}
inputpath.addEventListener("change" , function(){
    file=this.files[0];

    addImageBtn.style.display="none";
    removeImageBtn.style.display="block";
    imagePlaceholder.style.display="block";

    showImage();

});

function showImage(){
    let fileType =file.type;


    let validExtensions =["image/jpeg","image/jpg" ,"image/png"];

    if (validExtensions.includes(fileType)){
        let fileReader = new FileReader();

        fileReader.onload =()=>{
            let fileURL =fileReader.result;

            imagePlaceholder.setAttribute('src', fileURL);
        }

        fileReader.readAsDataURL(file);
    }

    else{
        alert("This is not an image file");

        removeImage();
    }
}