// src/components/PostCard.js
import React from 'react';
import './PostCard.css';

const PostCard = ({ id, title, image, content, user, createdAt }) => {
  const formattedDate = new Date(createdAt).toLocaleDateString("en-EN", {
    year: "numeric",
    month: "long",
    day: "numeric",
  });

  return (
    <div className="post-card">
      <img src={image} alt={title} className="post-image" />
      <div className="post-content">
        <h3 className="post-title">{title}</h3>
        <p className="post-snippet">{content}</p>
        <div className="post-footer">
          <span className="post-author">By {user.lastname}</span>
          <span className="post-date">{formattedDate}</span>          
        </div>
      </div>
    </div>
  );
};

export default PostCard;
