import React from 'react';
import './InnovationCard.css';

const InnovationCard = ({ id, title, image, content }) => {
  return (
    <div className="innovation-card">
      <img src={image} alt={title} className="innovation-image" />
      <h3 className="innovation-title">{title}</h3>
      <p className="innovation-description">{content}</p>
      <small><a href={`/innovation/${id}`}>Voir</a></small>
    </div>
  );
};

export default InnovationCard;
