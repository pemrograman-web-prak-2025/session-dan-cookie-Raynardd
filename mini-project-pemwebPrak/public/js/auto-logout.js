let idleTime = 0;
const maxIdle = 300; // 5 menit

function resetTimer() {
    idleTime = 0;
}

window.onload = resetTimer;
document.onmousemove = resetTimer;
document.onkeypress = resetTimer;
document.onscroll = resetTimer;
document.onclick = resetTimer;

setInterval(() => {
    idleTime++;
    if (idleTime >= maxIdle) {
        window.location.href = "/logout";
    }
}, 1000);