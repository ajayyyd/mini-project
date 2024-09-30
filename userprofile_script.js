function editProfile() {
    // Logic to edit profile details
    alert("Edit functionality to be implemented.");
}

function toggleStatus() {
    const statusElement = document.getElementById('status');
    statusElement.innerText = statusElement.innerText === 'Available' ? 'Not Available' : 'Available';
}

function deleteProfile() {
    // Logic to delete the profile
    if (confirm("Are you sure you want to delete your profile?")) {
        alert("Profile deleted.");
        // Add code to remove the profile from the database or application state
    }
}

function previewImage() {
    const file = document.getElementById('upload-pic').files[0];
    const reader = new FileReader();

    reader.onloadend = function() {
        document.getElementById('profilePic').src = reader.result;
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        document.getElementById('profilePic').src = "profile-pic.jpg"; // Default image
    }
}
