const form = document.querySelector('form'),
fileInput = form.querySelector('.file-input'),
progressArea = document.querySelector('.progress-area'),
uploadedArea = document.querySelector('.uploaded-area');

form.addEventListener('click', ()=>{
    fileInput.click();

});

fileInput.onchange = ({target}) =>{
    let file = target.files[0]; //getting files and [0] means if user has selected multiples files then get first one only

    if (file){//file is selected 
        let fileName = file.name; //getting selected file name
        if(fileName.length >= 18){
            let splitName = fileName.split('.');
            fileName = splitName[0].substring(0, 18) + "...." + splitName[1];
        }
        uploadFile(fileName);
    }
}

function uploadFile(name) {
    let xhr = new XMLHttpRequest(); //creating new xml object (AJAX)
    xhr.open("POST", "naft-nft_marketplace-master/php/upload.php"); //sending post request to the specified url/file
    xhr.upload.addEventListener('progress', ({loaded, total}) =>{
        let fileLoaded = Math.floor((loaded / total) * 100 ); //getting percentage of the loaded file size
        let fileTotal = Math.floor(total / 1000); //getting the file size in KB from bytes
        let fileSize;
        // If file size is less than 1024 then add only KB else convert size from KB to MB and MB
        (fileTotal < 1024) ? fileSize = fileTotal + " KB" : fileSize = (loaded / (1024 * 1024)).toFixed(2) + " MB";

        let progressHTMl = `<li class="row">
                              <i class="fas fa-file-alt"></i>
                              <div class="content">
                                <div class="details">
                                  <span class="name">${name} . Uploading</span>
                                  <span class="percent">${fileLoaded}</span>
                                 </div>
                                 <div class="progress-bar">
                                  <div class="progress" style="width: ${fileLoaded}%"></div>
                                 </div>
                               </div>
                            </li>`;
        progressArea.innerHTML = progressHTMl; 
        if(loaded == total){
            progressArea.innerHTML = '';
        }                  
        let uploadedHTMl = `<li class="row">
                              <div class="content">
                                 <i class="fas fa-file-alt"></i>
                                 <div class="details">
                                   <span class="name">${name} . Uploaded</span>
                                   <span class="size">${fileSize}</span>
                                 </div>
                               </div>
                              <i class="fas fa-check"></i>
                            </li> `;
        uploadedArea.insertAdjacentHTML('afterbegin', uploadedHTMl);
    });
    let formData = new FormData(form); //formData is an object to easily send form data
    xhr.send(formData); //sending form data to php

}
