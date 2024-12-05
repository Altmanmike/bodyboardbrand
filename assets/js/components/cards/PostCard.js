// src/components/PostCard.js
import React from 'react';
import './PostCard.css';

const PostCard = ({ title, image, content, author, date }) => {
  return (
    <div className="post-card">
      <img src={image} alt={title} className="post-image" />
      <div className="post-content">
        <h3 className="post-title">{title}</h3>
        <p className="post-snippet">{content}</p>
        <div className="post-footer">
          <span className="post-author">By {author}</span>
          <span className="post-date">{date}</span>
        </div>
      </div>
    </div>
  );
};

export default PostCard;
