// This file handles WebRTC functionalities for voice and video calls, including screen sharing.

let localStream;
let remoteStream;
let peerConnection;
const configuration = {
    iceServers: [
        { urls: 'stun:stun.l.google.com:19302' },
        { urls: 'stun:stun1.l.google.com:19302' }
    ]
};

function startLocalStream() {
    navigator.mediaDevices.getUserMedia({ video: true, audio: true })
        .then(stream => {
            localStream = stream;
            document.getElementById('localVideo').srcObject = stream;
        })
        .catch(error => {
            console.error('Error accessing media devices.', error);
        });
}

function createPeerConnection() {
    peerConnection = new RTCPeerConnection(configuration);

    peerConnection.onicecandidate = event => {
        if (event.candidate) {
            // Send the candidate to the remote peer
            sendMessage('candidate', event.candidate);
        }
    };

    peerConnection.ontrack = event => {
        remoteStream = event.streams[0];
        document.getElementById('remoteVideo').srcObject = remoteStream;
    };

    localStream.getTracks().forEach(track => {
        peerConnection.addTrack(track, localStream);
    });
}

function startCall() {
    createPeerConnection();
    peerConnection.createOffer()
        .then(offer => {
            return peerConnection.setLocalDescription(offer);
        })
        .then(() => {
            // Send the offer to the remote peer
            sendMessage('offer', peerConnection.localDescription);
        })
        .catch(error => {
            console.error('Error creating an offer.', error);
        });
}

function handleOffer(offer) {
    createPeerConnection();
    peerConnection.setRemoteDescription(new RTCSessionDescription(offer))
        .then(() => {
            localStream.getTracks().forEach(track => {
                peerConnection.addTrack(track, localStream);
            });
            return peerConnection.createAnswer();
        })
        .then(answer => {
            return peerConnection.setLocalDescription(answer);
        })
        .then(() => {
            // Send the answer to the remote peer
            sendMessage('answer', peerConnection.localDescription);
        })
        .catch(error => {
            console.error('Error handling offer.', error);
        });
}

function handleAnswer(answer) {
    peerConnection.setRemoteDescription(new RTCSessionDescription(answer))
        .catch(error => {
            console.error('Error handling answer.', error);
        });
}

function handleCandidate(candidate) {
    peerConnection.addIceCandidate(new RTCIceCandidate(candidate))
        .catch(error => {
            console.error('Error adding received ice candidate.', error);
        });
}

function sendMessage(type, payload) {
    // Implement WebSocket message sending logic here
}

// Add event listeners for call buttons and other UI elements as needed
// Example: document.getElementById('startCallButton').onclick = startCall;