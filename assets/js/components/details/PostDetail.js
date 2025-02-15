import React from "react";

const PostDetail = ({ id, title, image, content, user, createdAt, onBack }) => {
  return (
    <div className="post-card post-card-detail">
      <button onClick={onBack} className="back-button">⬅ Retour</button>
      <img src={image} alt={title} className="post-image" />
      <div className="post-content">
        <h3 className="post-title">{title}</h3>
        <p className="post-snippet">{content}</p>
        <div className="post-footer">
          <span className="post-author">Par {user.lastname}</span>
          <span className="post-date">Publié le{createdAt}</span>
        </div>
      </div>
    </div>
  );
};

export default PostDetail;