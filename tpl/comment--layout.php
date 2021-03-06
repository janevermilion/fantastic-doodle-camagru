<div class="photo__description-container--comment comment">
    <div class="comment__container">
        <img src="../img/avatars/{user_avatar}" alt="avatar" class="comment__author-avatar" width="48" height="auto" style="align-self: center;">
        <div class="comment__info-author">
            <p class="comment__author"> <a href="">{comment-author}</a></p>
            <p class="comment__date">{comment-date}</p>
        </div>
    </div>
    <p class="comment__description">{comment-text}</p>
    <form method="post" enctype="multipart/form-data" class="delete-comment">
        <input type="hidden" name="act" value="delete">
        <input type="hidden" name="comment-date" value="{comment-date}">
        <input type="hidden" name="comment-text" value="{comment-text}">
        <button type="submit" class="comment__delete-comment"><img src="../img/system_img/cross.png" alt="delete comment" width="14" height="14" aria-label="delete comment"></button>
    </form>
</div>
