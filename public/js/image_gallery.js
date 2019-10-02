thumbs.onclick = function(event) {
    document.getElementById('largeImg').style.display="block";
    let thumbnail = event.target.closest('a');
    if (!thumbnail) return;
    showThumbnail(thumbnail.href, thumbnail.title);
    event.preventDefault();
  }

  function showThumbnail(href, title) {
    largeImg.src = href;
    largeImg.alt = title;
  }