import React from 'react';
import './InnovationCard.css';

const InnovationCard = ({ id, title, image, content, user, createdAt }) => {
  const formattedDate = new Date(createdAt).toLocaleDateString("en-EN", {
    year: "numeric",
    month: "long",
    day: "numeric",
  });

  return (
    <div className="innovation-card">
      <img src={image} alt={title} className="innovation-image" />
      <h3 className="innovation-title">{title}</h3>
      <p className="innovation-description">{content}</p>
      <div className="innovation-footer">
          <span className="innovation-author">By {user.lastname}</span>
          <span className="innovation-date">{formattedDate}</span>          
        </div>
    </div>
  );
};

export default InnovationCard;