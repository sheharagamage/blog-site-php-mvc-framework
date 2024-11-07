// Profile image drag and drop
const dropArea = document.querySelector(".form-drag-area");
let dropText = document.querySelector(".description");
const browseBtn = document.querySelector(".form-upload");
let inputpath = document.querySelector("#profile_image");

let file;

// Browse
browseBtn.onclick = () => {
    inputpath.click();
};

inputpath.addEventListener("change", function () {
    file = this.files[0];
    showImage(file); // Pass file as an argument
});

dropArea.addEventListener("dragover", (event) => {
    event.preventDefault();
    dropArea.classList.add("active");
    dropText.textContent = "Release to Upload the File";
});

dropArea.addEventListener("dragleave", () => {
    dropArea.classList.remove("active");
    dropText.textContent = "Drag & Drop to Upload File";
});

dropArea.addEventListener("drop", (event) => {
    event.preventDefault();
    file = event.dataTransfer.files[0];
    
    // Set file to inputpath for consistency
    let list = new DataTransfer();
    list.items.add(file);
    inputpath.files = list.files;
    
    showImage(file); // Pass file as an argument
    
    dropArea.classList.remove("active");
});

function showImage(file) {
    let fileType = file.type;
    let validExtensions = ["image/jpeg", "image/jpg", "image/png"];

    if (validExtensions.includes(fileType)) {
        let fileReader = new FileReader();
        fileReader.onload = () => {
            let fileURL = fileReader.result;
            document.querySelector("#profile_image_placeholder").setAttribute('src', fileURL);
        };
        fileReader.readAsDataURL(file);

        let validate = document.querySelector(".profile-image-validation");
        validate.classList.add("active");
    } else {
        alert("This is not an Image File");
        dropArea.classList.remove("active");
    }
}
