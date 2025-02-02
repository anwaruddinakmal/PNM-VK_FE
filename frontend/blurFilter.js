async function startVideoWithBlur() {
    const video = document.querySelector(".blur-filter"); // Select video element

    if (!video) {
        console.error("Video element with class 'blur-filter' not found.");
        return;
    }

    try {
        const stream = await navigator.mediaDevices.getUserMedia({ video: true });
        video.srcObject = stream;

        video.onloadedmetadata = async () => {
            await video.play();

            while (video.videoWidth === 0 || video.videoHeight === 0) {
                console.log("Waiting for video dimensions...");
                await new Promise((resolve) => setTimeout(resolve, 100));
            }

            console.log("Video ready:", video.videoWidth, video.videoHeight);

            // Create a canvas and position it over the video
            const canvas = document.createElement("canvas");
            const ctx = canvas.getContext("2d");

            // Make sure canvas matches video size
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;

            // Style canvas to overlay perfectly
            canvas.style.position = "absolute";
            canvas.style.top = "0";
            canvas.style.left = "0";
            canvas.style.width = "100%";
            canvas.style.height = "100%";
            canvas.style.pointerEvents = "none"; // Allow interaction with the video

            // Append canvas inside the same parent container as video
            video.parentElement.appendChild(canvas);

            // Load BodyPix model
            const net = await bodyPix.load();
            console.log("BodyPix model loaded.");

            async function processFrame() {
                if (video.videoWidth === 0 || video.videoHeight === 0) {
                    requestAnimationFrame(processFrame);
                    return;
                }

                // Ensure canvas size updates
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;

                // Get segmentation mask
                const segmentation = await net.segmentPerson(video, {
                    internalResolution: "medium",
                    segmentationThreshold: 0.7,
                });

                if (!segmentation || !segmentation.data) {
                    console.warn("BodyPix did not detect a person.");
                    requestAnimationFrame(processFrame);
                    return;
                }

                // Create a mask
                const mask = bodyPix.toMask(
                    segmentation,
                    { r: 0, g: 0, b: 0, a: 0 }, // Transparent background
                    { r: 255, g: 255, b: 255, a: 255 } // Person visible
                );

                // Draw blurred background
                ctx.filter = "blur(10px)";
                ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

                // Overlay the segmentation mask
                ctx.filter = "none";
                bodyPix.drawMask(canvas, video, mask, 1, 5);

                requestAnimationFrame(processFrame);
            }

            processFrame();
        };
    } catch (err) {
        console.error("Error accessing webcam:", err);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    startVideoWithBlur();
});
