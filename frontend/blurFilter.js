async function startVideoWithBlur() {
    const video = document.querySelector(".blur-filter"); // Select using class
    const canvas = document.createElement("canvas");
    const ctx = canvas.getContext("2d");

    // Load the BodyPix model
    const net = await bodyPix.load();

    // Access the webcam
    navigator.mediaDevices.getUserMedia({ video: true }).then((stream) => {
        video.srcObject = stream;
        video.play();

        // Process video frames
        async function processFrame() {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;

            // Get segmentation mask
            const segmentation = await net.segmentPerson(video);

            const mask = bodyPix.toMask(segmentation);
            
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
            
            ctx.globalCompositeOperation = "destination-over";
            ctx.filter = "blur(10px)"; // Apply blur to background
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
            ctx.globalCompositeOperation = "source-over";

            requestAnimationFrame(processFrame);
        }

        processFrame();
    });
}

// Start the video blur effect
startVideoWithBlur();
