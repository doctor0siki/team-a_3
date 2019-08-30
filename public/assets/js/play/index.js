function toPlayBack(time) {
    var video = document.getElementById('js-video');
    var t = time.textContent.split(":");
    var min = Number(t[0]) * 60;
    var sec = Number(t[1]);
    video.currentTime = min + sec;
}
