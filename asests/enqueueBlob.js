    var requestOptions = {
    method: "GET",
    redirect: "follow"
};

    fetch(myLocalizedData.ajaxurl, requestOptions)
    .then(response => response.blob())
    .then(blob => {
    const audioElement = new Audio(); // create a new audio element
    const blobURL = URL.createObjectURL(blob); // create blob URL for the blob data

    audioElement.src = blobURL; // set the audio source to the blob URL
    audioElement.controls = true; // enable the audio controls

    // add the audio element to the HTML page
    const audioContainer =  document.getElementById("avasho-center");
    audioContainer.appendChild(audioElement);
}).catch((error)=>{
    console.log('error')
    });