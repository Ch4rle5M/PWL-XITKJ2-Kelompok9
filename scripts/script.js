let currentChallengeId = ""; 

const modal = document.getElementById("modal");
const modalTitle = document.getElementById("modal-title");
const modalImg = document.getElementById("modal-img");
const modalDesc = document.getElementById("modal-desc");
const modalAttachment = document.getElementById("modal-attachment");
const flagForm = document.getElementById("modal-flag-form");
const flagInput = document.getElementById("modal-flag-input");
const submitButton = flagForm.querySelector("button[type='submit']");

function openModal(title, description, imageSrc, attachmentUrl, challengeId) {

  modalTitle.innerText = title;
  modalImg.src = imageSrc;
  modalDesc.innerHTML = description;
  
  if (attachmentUrl) {
    modalAttachment.href = attachmentUrl;
    modalAttachment.style.display = "inline-block";
  } else {
    modalAttachment.style.display = "none";
  }


  currentChallengeId = challengeId;

  modal.style.display = "flex";
}

function closeModal() {
  modal.style.display = "none";
  flagInput.value = "";
  currentChallengeId = "";
  submitButton.disabled = false;
  submitButton.innerText = "Submit";
}


async function handleFlagSubmit(event) {
  event.preventDefault();

  const submittedFlag = flagInput.value.trim();

  if (!submittedFlag) {
    alert("Flag-nya jangan dikosongin dong!");
    return;
  }


  submitButton.disabled = true;
  submitButton.innerText = "Mengecek...";

  const dataToSend = {
    challengeId: currentChallengeId,
    flag: submittedFlag
  };

  try {
    const response = await fetch('/action/secret/flag.php', { 
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(dataToSend)
    });

    const result = await response.json();

    alert(result.message);

    if (result.status === 'correct') {
      closeModal();
    }

  } catch (error) {
    console.error('Error:', error);
    alert('ngebug.');
  } finally {

    if (modal.style.display !== 'none') {
        submitButton.disabled = false;
        submitButton.innerText = "Submit";
    }
  }
}


flagForm.addEventListener("submit", handleFlagSubmit);



      document.getElementById('modal-flag-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const flagInput = document.getElementById('modal-flag-input').value;

        fetch('/secret/flag.php', { 
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ challengeId: currentChallengeId, flag: flagInput })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Server Error: " + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            if (data.status === 'correct') {
                alert("🎉 " + data.message); closeModal(); location.reload(); 
            } else if (data.status === 'already') {
                alert("⚠️ " + data.message);
            } else {
                alert("❌ " + data.message);
            }
        })
        .catch(error => { 
            console.error('Error:', error); 
            alert("Terjadi kesalahan sistem! Cek Console (F12) untuk detail."); 
        });
      });