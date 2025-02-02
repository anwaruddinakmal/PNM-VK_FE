const isHost = window.location.pathname.includes("host.html"); // Check if the page is host.html
const fixedId = "host-peer-id"; // Fixed Peer ID for the host
const peer = isHost
  ? new Peer(fixedId, {
      key: "peerjs", // Use your valid API key
      secure: true, // Use HTTPS
    })
  : new Peer({
      key: "peerjs", // Use your valid API key
      secure: true, // Use HTTPS
    });

const localVideo = document.getElementById("local-video");
const remoteVideo = document.getElementById("remote-video");
const answerButton = document.getElementById("btn-accept-host");
const endButton = document.getElementById("btn-end-host");

let localStream;
let incomingCall; // Store the incoming call object

// Display your Peer ID when connected to the server
peer.on("open", (id) => {
  console.log(`Your PeerJS ID: ${id}`);
});

// Get local media stream
if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
  navigator.mediaDevices
    .getUserMedia({ video: true, audio: true })
    .then((stream) => {
      localStream = stream;
      localVideo.srcObject = stream; // Assign the stream to the video element
      console.log("Local stream initialized.");
    })
    .catch((error) => {
      console.error("Error accessing media devices:", error);
      alert("Could not access webcam or microphone. Please check permissions.");
    });
} else {
  alert(
    "getUserMedia is not supported in this browser. Please use a modern browser like Chrome or Firefox."
  );
}

// Handle incoming calls (host-specific)
if (isHost) {
  const audio = new Audio("voice/soft_ringtone.mp3");

  peer.on("call", (call) => {
    incomingCall = call; // Store the call object
    if (answerButton) {
      answerButton.style.display = "block";

      // Play MP3 sound
      audio.play().catch((error) => {
        console.error("Error playing sound:", error);
      });
    }
  });

  // Answer the call when the "Answer" button is clicked
  if (answerButton) {
    answerButton.addEventListener("click", () => {
      if (incomingCall) {
        incomingCall.answer(localStream); // Answer the call with your local stream
        console.log("Call answered with local stream.");
        incomingCall.on("stream", (remoteStream) => {
          remoteVideo.srcObject = remoteStream; // Play remote stream
          console.log("Remote stream received.");
        });
        incomingCall.on("error", (err) => {
          console.error("Call error:", err);
          alert("An error occurred during the call.");
        });

        // Hide the "Answer" button after answering
        answerButton.style.display = "none";
        endButton.style.display = "block";
        incomingCall = null; // Reset the call object
        audio.pause();
      }
    });
  }
} else {
  // Automatically call the host if on user side (call.html)
  peer.on("open", () => {
    const hostPeerId = "host-peer-id"; // Replace with the host's Peer ID

    if (!localStream) {
      console.error("Local stream is not ready. Retrying in 500ms...");
      setTimeout(() => peer.call(hostPeerId, localStream), 500); // Retry after delay
      return;
    }

    const call = peer.call(hostPeerId, localStream);
    console.log("Calling host...");
    call.on("stream", (remoteStream) => {
      remoteVideo.srcObject = remoteStream; // Display the host's stream
      console.log("Remote stream received from host.");
    });
    call.on("error", (err) => {
      console.error("Call error:", err);
      alert("An error occurred during the call.");
    });
  });
}
