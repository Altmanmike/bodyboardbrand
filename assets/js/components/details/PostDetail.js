import React from "react";
import './PostDetail.css';

const PostDetail = ({ id, title, image, content, user, createdAt, onBack }) => {
  const formattedDate = new Date(createdAt).toLocaleDateString("en-EN", {
    year: "numeric",
    month: "long",
    day: "numeric",
  });

  return (
    <div className="post-detail-card post-detail-card-details">  
      <h3 className="post-detail-title">{title}</h3>    
      <img src={image} alt={title} className="post-detail-image" />
      <div className="post-detail-content">        
        <p className="post-detail-snippet">{content}</p>
        <div className="post-detail-footer">
          <span className="post-detail-author">By {user.lastname}</span>
          <span className="post-detail-date">{formattedDate}</span>
        </div>
      </div>
      <button onClick={onBack} className="button-back">Back</button>
    </div>
  );
};

export default PostDetail;