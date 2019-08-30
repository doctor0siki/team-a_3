function onButtonClick1() {
        var shout_time = document.getElementById('postVideo_shout_time').value;
        var shout_text = document.getElementById('postVideo_shout_value').value;

        var item = document.createElement("div");
        item.classList.add("post_video-list-item");

        var time_text = document.createElement("span");
        time_text.classList.add("post_video-list-item-time");
        time_text.textContent = shout_time;
        item.appendChild(time_text);

        var text = document.createElement("span");
        text.classList.add("post_video-list-item-text");
        text.textContent = shout_text;
        item.appendChild(text);

        var image = document.createElement("img");
        image.classList.add("post_video-list-item-image");
        image.setAttribute("src", "/assets/images/public/delete.svg");
        item.appendChild(image);

        var shout_item = document.getElementById('js-postVideo-shout');
        shout_item.appendChild(item);
    }
function onButtonClick2() {
    var shout_time = document.getElementById('postVideo_hand_time').value;
    var shout_text = document.getElementById('postVideo_hand_value').value;

    var item = document.createElement("div");
    item.classList.add("post_video-list-item");

    var time_text = document.createElement("span");
    time_text.classList.add("post_video-list-item-time");
    time_text.textContent = shout_time;
    item.appendChild(time_text);

    var text = document.createElement("span");
    text.classList.add("post_video-list-item-text");
    text.textContent = shout_text;
    item.appendChild(text);

    var image = document.createElement("img");
    image.classList.add("post_video-list-item-image");
    image.setAttribute("src", "/assets/images/public/delete.svg");
    item.appendChild(image);

    var shout_item = document.getElementById('js-postVideo-hand');
    shout_item.appendChild(item);
}
