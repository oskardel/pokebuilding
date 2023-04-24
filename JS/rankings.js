const teamItem = document.querySelectorAll('.team-item');
const teamOptions = document.getElementById('team-option');

function addVote(teamId, userId) {    
    window.location.href = "rankings.php?t="+teamId+"&v="+userId;
}

teamOptions.addEventListener('input', () => {
    window.location.href = "rankings.php?range="+teamOptions.value;
})