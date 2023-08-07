const requestOptions = {
    method: "GET",
    redirect: "follow"
};
var audioElement
function saveBlobDataToLocalStorage(blobURL) {
    localStorage.setItem('savedBlobData', blobURL);
}
document.addEventListener('DOMContentLoaded', function () {
     audioElement = document.getElementById('avashoMp3');
    })
console.log(audioElement)
function retrieveBlobDataFromLocalStorage() {
    const savedBlobDataString = localStorage.getItem('savedBlobData');
    return savedBlobDataString;
}

document.addEventListener('DOMContentLoaded', function () {
    // Check if Blob data is stored in local storage and retrieve it
    const savedBlobData = retrieveBlobDataFromLocalStorage();

    // if (savedBlobData != null) {
    //     audioElement.src = savedBlobData; // Use the saved Blob URL directly
    // } else {
        const boo = `https://panel.iavasho.ir/backend/download/${myLocalizedData.ajaxurl}`;
        fetch(boo, requestOptions)
            .then(response => response.blob())
            .then(blob => {
                // Store the Blob data in local storage
                const blobURL = URL.createObjectURL(blob);
                audioElement.src = blobURL;
                audioElement.controls = true;
                saveBlobDataToLocalStorage(blobURL);
                // Play the audio from the Blob
            })
            .catch(error => {
                console.log('error');
            });
    // }
});