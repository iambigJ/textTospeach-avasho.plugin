const requestOptions = {
    method: "GET",
    redirect: "follow"
};

const boo = `https://panel.iavasho.ir/backend/download/${myLocalizedData.ajaxurl}`;

const audioElement = document.getElementById('avashoMp3');

function saveBlobDataToLocalStorage(blobData) {
    localStorage.setItem('savedBlobData', blobData);
}

function retrieveBlobDataFromLocalStorage() {
    return localStorage.getItem('savedBlobData');
}

function playAudioFromBlob(blobData) {
    const blob = new Blob([blobData], { type: 'audio/mpeg' });
    const blobURL = URL.createObjectURL(blob);

    audioElement.src = blobURL;
    audioElement.controls = true;
}

// Check if Blob data is stored in local storage and retrieve it
const savedBlobData = retrieveBlobDataFromLocalStorage();

if (savedBlobData) {
    playAudioFromBlob(savedBlobData);
} else {
    fetch(boo, requestOptions)
        .then(response => response.blob())
        .then(blob => {
            // Store the Blob data in local storage
            saveBlobDataToLocalStorage(blob);

            // Play the audio from the Blob
            playAudioFromBlob(blob);
        })
        .catch(error => {
            console.log('error');
        });
}

// Handle page refresh or closing event




    // const boo = `https://panel.iavasho.ir/backend/download/${myLocalizedData.ajaxurl}`
//     console.log(boo)
//     fetch(boo, requestOptions)
//     .then(response => response.blob())
//     .then(blob => {
//     //const audioElement = new Audio(); // create a new audio element
//     var audioElement = document.getElementById('avashoMp3')
//     var blobURL = URL.createObjectURL(blob); // create blob URL for the blob data
//     audioElement.src = blobURL; // set the audio source to the blob URL
//     audioElement.controls = true; // enable the audio controls
//     // add the audio element to the HTML page
//
// }).catch((error)=>{
//     console.log('error')
//     });

